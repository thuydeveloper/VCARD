<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\AppBaseController;
use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\ScheduleAppointment;
use App\Models\Vcard;
use Illuminate\Http\Request;

class AppointmentAPIController extends AppBaseController
{
    public function appointmentsData()
    {
        $vcardIds = Vcard::whereTenantId(getLogInTenantId())->pluck('id')->toArray();

        $scheduleAppointments = ScheduleAppointment::with('vcard')->whereIn('vcard_id', $vcardIds)->get();

        $data = [];

        foreach ($scheduleAppointments as $appointment) {
            $data[] = [
                'id' => $appointment->id,
                'vcard_name' => $appointment->vcard->name,
                'name' => $appointment->name,
                'date' => $appointment->date,
                'from_time' => $appointment->from_time,
                'to_time' => $appointment->to_time,
                'status' => $appointment->status,
                'paid_amount' => $appointment->paid_amount,
            ];
        }

        return $this->sendResponse($data, 'Appointment data retrieved successfully.');
    }

    public function appointment($scheduleAppointmentsId)
    {
        $scheduleAppointments = ScheduleAppointment::with('vcard')->whereId($scheduleAppointmentsId)->first();

        if(empty($scheduleAppointments)){
            return $this->sendError('Appointment not found', 404);
        }

        $data[] = [
            'id' => $scheduleAppointments->id,
            'vcard_name' => $scheduleAppointments->vcard->name,
            'name' => $scheduleAppointments->name,
            'email' => $scheduleAppointments->email,
            'phone' => $scheduleAppointments->phone,
            'date' => $scheduleAppointments->date,
            'from_time' => $scheduleAppointments->from_time,
            'to_time' => $scheduleAppointments->to_time,
            'status' => $scheduleAppointments->status,
            'paid_amount' => $scheduleAppointments->paid_amount,
        ];

        return $this->sendResponse($data, 'Appointment data retrieved successfully.');
    }

    public function deleteAppointment($scheduleAppointmentsId)
    {
        $appointment = ScheduleAppointment::find($scheduleAppointmentsId);

        if (empty($appointment)) {
            return $this->sendSuccess('Appointment not found');
        }

        $appointment->delete();

        return $this->sendSuccess('Appointment deleted successfully.');
    }

    public function appointmentCompleted(ScheduleAppointment $scheduleAppointmentsId)
    {
        $appointments = ScheduleAppointment::find($scheduleAppointmentsId->id);

        $appointments->update([
            'status' => ScheduleAppointment::COMPLETED,
        ]);

        return $this->sendSuccess('Appointment completed successfully;');
    }
}
