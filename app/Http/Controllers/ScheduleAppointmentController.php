<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateScheduleAppointmentRequest;
use App\Mail\AppointmentApproveMail;
use App\Models\Appointment;
use App\Models\ScheduleAppointment;
use App\Models\UserSetting;
use App\Models\Vcard;
use App\Models\AppointmentTransaction;
use App\Models\Transaction;
use App\Models\Currency;
use App\Repositories\AppointmentRepository;
use Carbon\Carbon;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Unicodeveloper\Paystack\Facades\Paystack;

class ScheduleAppointmentController extends AppBaseController
{
    /**
     * @return mixed
     */
    public function store(CreateScheduleAppointmentRequest $request)
    {
        $input = $request->all();
        $endDate = $request->date;
        $format = getSuperAdminSettingValue('datetime_method');
        $input['date'] = ($format == 1)
            ? Carbon::createFromFormat('d M, Y', $endDate)->format('Y-m-d H:i:s')
            : (($format == 2)
                ? Carbon::createFromFormat('M d, Y', $endDate)->format('Y-m-d H:i:s')
                : (($format == 3)
                    ? Carbon::createFromFormat('d/m/Y', $endDate)->format('Y-m-d H:i:s')
                    : (($format == 4)
                        ? Carbon::createFromFormat('Y/m/d', $endDate)->format('Y-m-d H:i:s')
                        : (($format == 5)
                            ? Carbon::createFromFormat('m/d/Y', $endDate)->format('Y-m-d H:i:s')
                            : (($format == 6)
                                ? Carbon::createFromFormat('Y-m-d', $endDate)->format('Y-m-d H:i:s')
                                : Carbon::parse($endDate)->format('Y-m-d H:i:s')
                                )
                            )
                        )
                    )
                );
        try {
            DB::beginTransaction();
            /** @var Vcard $vcard */
            $vcard = Vcard::with('tenant.user')->where('id', $input['vcard_id'])->first();
            $input['toName'] = $vcard->fullName > 1 ? $vcard->fullName : $vcard->tenant->user->fullName;
            $input['vcard_name'] = $vcard->name;
            $userId = $vcard->tenant->user->id;

            if (isset($input['payment_method'])) {
                //Stripe
                if ($input['payment_method'] == Appointment::STRIPE) {
                    /** @var AppointmentRepository $repo */
                    $repo = App::make(AppointmentRepository::class);

                    $result = $repo->userCreateSession($userId, $vcard, $input);

                    DB::commit();

                    return $this->sendResponse([
                        'payment_method' => $input['payment_method'],
                        $result,
                    ], __('messages.placeholder.stripe_created'));
                }
                //Phonepe
                if ($input['payment_method'] == Appointment::PHONEPE) {
                    $currency  = $input['currency_code'];
                    if($currency != "INR") {
                        return $this->sendError(__('messages.placeholder.this_currency_is_not_supported_phonepe'));
                    }

                    /** @var UserPhonepeController $phonepe */
                    $phonepe = App::make(UserPhonepeController::class);
                    $result = $phonepe->appointmentBook($userId, $vcard, $input);

                    DB::commit();

                    return $this->sendResponse([
                        'payment_method' => $input['payment_method'],
                        $result,
                    ], __('messages.placeholder.phonepe_created'));
                }
                // PAYSTACK
                if ($input['payment_method'] == Appointment::PAYSTACK) {

                    if (isset($input['currency_code']) && ! in_array(strtoupper($input['currency_code']),
                    getPayStackSupportedCurrencies())) {
                    return $this->sendError(__('messages.placeholder.this_currency_is_not_supported_paystack'));
                    }

                    $currency  = $input['currency_code'];
                    $amount = $input['amount'];
                    $currencyCode = $input['currency_code'];
                    $clientId = getUserSettingValue('paystack_key',$userId);
                    $clientSecret = getUserSettingValue('paystack_secret',$userId);
                    config([
                        'paystack.publicKey' => $clientId,
                        'paystack.secretKey' => $clientSecret,
                        'paystack.paymentUrl' => "https://api.paystack.co",
                    ]);
                    $data = [
                        'email' => $input['email'],
                        'orderID' => $vcard->id,
                        'amount' => $amount * 100,
                        'quantity' => 1,
                        'currency' => $currency,
                        'reference' => Paystack::genTranxRef(),
                        'metadata' => json_encode(['vcard_id' => $vcard->id]),
                    ];
                    $result = Paystack::getAuthorizationUrl($data)->redirectNow();
                    session()->put(['appointment_details' => $input]);
                    session(['vcard_user_id' => $userId, 'tenant_id' => $vcard->tenant->id, 'vcard_id' => $vcard->id]);
                    $targetUrl = $result->getTargetUrl();
                    DB::commit();
                    return $this->sendResponse(['payment_method' => $input['payment_method'], $targetUrl], __('messages.placeholder.paystack_created'));
                }

                //flutterwave
                if ($input['payment_method'] == Appointment::FLUTTERWAVE) {
                    $supportedCurrency = ['GBP', 'CAD', 'XAF', 'CLP', 'COP', 'EGP', 'EUR', 'GHS', 'GNF', 'KES', 'MWK', 'MAD', 'NGN', 'RWF', 'SLL', 'STD', 'ZAR', 'TZS', 'UGX', 'USD', 'XOF', 'ZMW'];
                    if (isset($input['currency_code']) && ! in_array(strtoupper($input['currency_code']),
                    $supportedCurrency)) {
                        return $this->sendError(__('messages.placeholder.this_currency_is_not_supported_flutterwave'));
                    }

                    /** @var UserFlutterwaveController $flutterwave */
                    $flutterwave = App::make(UserFlutterwaveController::class);

                    $result = $flutterwave->userOnBoard($userId, $vcard, $input);

                    DB::commit();

                    return $this->sendResponse([
                        'payment_method' => $input['payment_method'],
                        $result,
                    ], __('messages.placeholder.flutterwave_created'));
                }

                //PayPal
                if ($input['payment_method'] == Appointment::PAYPAL) {
                    if (isset($input['currency_code']) && ! in_array(strtoupper($input['currency_code']),
                        getPayPalSupportedCurrencies())) {
                        return $this->sendError(__('messages.placeholder.this_currency_is_not_supported'));
                    }

                    /** @var PaypalController $payPalCont */
                    $payPalCont = App::make(PaypalController::class);

                    $result = $payPalCont->userOnBoard($userId, $vcard, $input);

                    DB::commit();

                    return $this->sendResponse([
                        'payment_method' => $input['payment_method'],
                        $result,
                    ], __('messages.placeholder.paypal_created'));
                }
                //Manually
                if ($input['payment_method'] == Appointment::MANUALLY) {
                    $currencyCode = $input['currency_code'];
                    $currency = Currency::where('currency_code', $currencyCode)->first();

                    $appointmentTransaction =  AppointmentTransaction::create([
                        'vcard_id' => $input['vcard_id'],
                        'transaction_id' => null,
                        'currency_id' => $currency->id,
                        'amount' => $input['amount'],
                        'tenant_id' => $vcard->tenant->id,
                        'type' => Appointment::MANUALLY,
                        'status' => 0,
                        'meta' => json_encode([]),
                    ]);
                    $appointmentTransactionId = $appointmentTransaction->id;

                    DB::commit();
                        $inputDate = Carbon::parse($input['date'])->format('Y-m-d');

                        ScheduleAppointment::create([
                        'vcard_id' => $input['vcard_id'],
                        'name' => $input['name'],
                        'email' => $input['email'],
                        'phone' => $input['phone'],
                        'date' =>  $inputDate,
                        'from_time' => $input['from_time'],
                        'to_time' => $input['to_time'],
                        'remarks' => null,
                        'person_count' => null,
                        'payment_type' => Appointment::MANUALLY,
                        'status' => 0,
                        'appointment_tran_id' => $appointmentTransactionId,
                        'meta' => json_encode([]),
                    ]);

                    DB::commit();

                    return $this->sendResponse([
                        'payment_method' => $input['payment_method'],
                    ], __('messages.placeholder.manual_payment'));
                }
            }

            /** @var AppointmentRepository $appointmentRepo */
            $appointmentRepo = App::make(AppointmentRepository::class);
            $vcardEmail = is_null($vcard->email) ? $vcard->tenant->user->email : $vcard->email;
            $appointmentRepo->appointmentStoreOrEmail($input, $vcardEmail);

            DB::commit();
            setLocalLang(getLocalLanguage());

            return $this->sendSuccess(__('messages.placeholder.appointment_created'));
        } catch (Exception $e) {
            DB::rollBack();

            return $this->sendError($e->getMessage());
        }
    }
    public function paymentStatus(Request $request): JsonResponse
{

    try {
        $appointmentStatus = $request->status;

        $appointmentTransaction = ScheduleAppointment::find($request->id);

        $appointmentTranId = $appointmentTransaction->appointment_tran_id;

        AppointmentTransaction::where('id', $appointmentTranId)->update([
                        'type' => $appointmentStatus,
                    ]);

        return $this->sendSuccess(__('messages.placeholder.payment_status'));

    } catch (\Exception $e) {
        return $this->sendError($e->getMessage());
    }
}
    /**
     * @return Application|Factory|View
     */
    public function appointmentsList(): \Illuminate\View\View
    {
        return view('appointment.list');
    }

    /**
     * @return Application|Factory|View
     */
    public function appointmentCalendar(Request $request)
    {
        if ($request->ajax()) {
            $data = $this->getCalendar();

            return $this->sendResponse($data, 'Appointment calendar data retrieved successfully.');
        }

        return view('appointment.appointment-calendar');
    }

    /**
     * @return array
     */
    public function getCalendar()
    {
        /** @var ScheduleAppointment $appointment */
        $appointments = ScheduleAppointment::whereHas('vcard', function ($q) {
            $q->where('tenant_id', getLogInTenantId());
        })->get();

        $data = [];
        foreach ($appointments as $key => $appointment) {
            if (getUserSettingValue('time_format', getLogInUserId()) == UserSetting::HOUR_24) {
                $startTime = date('H:i', strtotime($appointment->from_time));
                $endTime = date('H:i', strtotime($appointment->to_time));
                $start = Carbon::createFromFormat('Y-m-d H:i',
                    date('Y-m-d', strtotime($appointment->date)).' '.$startTime);
                $end = Carbon::createFromFormat('Y-m-d H:i',
                    date('Y-m-d', strtotime($appointment->date)).' '.$endTime);
            } else {
                $startTime = date('h:i A', strtotime($appointment->from_time));
                $endTime = date('h:i A', strtotime($appointment->to_time));
                $start = Carbon::createFromFormat('Y-m-d h:i A',
                    date('Y-m-d', strtotime($appointment->date)).' '.$startTime);
                $end = Carbon::createFromFormat('Y-m-d h:i A',
                    date('Y-m-d', strtotime($appointment->date)).' '.$endTime);
            }

            $data[$key]['id'] = $appointment->id;
            if (getUserSettingValue('time_format', getLogInUserId()) == UserSetting::HOUR_24) {
                $data[$key]['startDateTime'] = $start->format('jS M, Y - H:i');
                $data[$key]['endDateTime'] = $end->format('jS M, Y - H:i');
                $data[$key]['title'] = date('H:i', strtotime($appointment->from_time)).'-'.date('H:i',
                    strtotime($appointment->to_time));
            } else {
                $data[$key]['startDateTime'] = $start->format('jS M, Y - h:i A');
                $data[$key]['endDateTime'] = $end->format('jS M, Y - h:i A');
                $data[$key]['title'] = date('h:i A', strtotime($startTime)).'-'.date('h:i A', strtotime($endTime));
            }
            $data[$key]['name'] = $appointment->name;
            $data[$key]['email'] = $appointment->email;
            $data[$key]['phone'] = is_null($appointment->phone) ? 'N/A' : $appointment->phone;
            $data[$key]['vcardName'] = $appointment->vcard->name;
            $data[$key]['start'] = $start->toDateTimeString();
            $data[$key]['description'] = $appointment->vcard->description;
            $data[$key]['status'] = $appointment->vcard->status;
            $data[$key]['end'] = $end->toDateTimeString();
            $data[$key]['color'] = '#FFF';
            $data[$key]['className'] = [getStatusClassName($appointment->vcard->status)];
        }

        return $data;
    }

    /**
     * @return mixed
     */
    public function appointmentsUpdate(ScheduleAppointment $appointment)
    {
        $appointments = ScheduleAppointment::findOrFail($appointment->id);

        $appointments->update([
            'status' => ScheduleAppointment::COMPLETED,
        ]);
        $data['name'] = $appointment->name;
        $data['date'] = $appointment->date;
        $data['from_time'] = $appointment->from_time;
        $data['to_time'] = $appointment->to_time;
        Mail::to($appointment->email)
            ->send(new AppointmentApproveMail($data));

        return $this->sendSuccess(__('messages.flash.plan_status'));
    }

    public function destroy(ScheduleAppointment $appointment): JsonResponse
    {
        if ($appointment->appointment_tran_id == null) {
            $appointment->delete();

            return $this->sendSuccess('Appointment deleted successfully.');
        }

        return $this->sendError(__('messages.placeholder.paid_appointment_cant_delete'));
    }
}
