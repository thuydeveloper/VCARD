<?php

use App\Http\Controllers\API\Admin\AppointmentAPIController;
use App\Http\Controllers\API\Admin\BusinessAPIController as AdminBusinessAPIController;
use App\Http\Controllers\API\Admin\DashboardAPIController as AdminDashboardAPIController;
use App\Http\Controllers\API\Admin\EnquiryAPIController;
use App\Http\Controllers\API\Admin\GroupAPIController;
use App\Http\Controllers\API\Admin\SettingAPIController;
use App\Http\Controllers\API\Admin\SubscriptionPlanAPIController;
use App\Http\Controllers\API\AuthAPIController;
use App\Http\Controllers\API\SuperAdmin\ProfileAPIController;
use App\Http\Controllers\API\RegistrationAPIController;
use App\Http\Controllers\API\SuperAdmin\DashboardAPIController;
use App\Http\Controllers\API\Admin\VcardAPIController;
use App\Http\Controllers\API\SuperAdmin\BusinessAPIController as SuperAdminBusinessAPIController;
use App\Http\Controllers\API\SuperAdmin\GroupsAPIController as SuperAdminGroupsAPIController;
use App\Http\Controllers\API\SuperAdmin\VcardsAPIController as SuperAdminVcardsAPIController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/register', [RegistrationAPIController::class, 'register']);
Route::post('login', [AuthAPIController::class, 'login']);
Route::post('/forgot-password',
    [AuthAPIController::class, 'sendPasswordResetLinkEmail'])->middleware('throttle:5,1')->name('password.email');
Route::post('/password',
    [AuthAPIController::class, 'resetPassword'])->middleware('throttle:5,1')->name('set.password');
Route::post('/reset-password', [AuthAPIController::class, 'changePassword'])->name('password.reset');

Route::middleware('auth:sanctum')->group(function () {
    Route::post('logout', [AuthAPIController::class, 'logout']);

    Route::middleware('role:super_admin')->group(function () {

        //Super Admin Dashboard
        Route::get('dashboard',[DashboardAPIController::class,'index']);
         Route::get('income-chart', [DashboardAPIController::class, 'incomeChartData']);
    });

    Route::prefix('admin')->middleware('role:admin')->group(function () {

    //Admin Dashboard
    Route::get('dashboard',[AdminDashboardAPIController::class,'index']);
    Route::get('today-appointment',[AdminDashboardAPIController::class,'todayAppointment']);
    Route::get('income-chart', [AdminDashboardAPIController::class, 'incomeChartData']);

    //Appointments
    Route::get('appointment', [AppointmentAPIController::class, 'appointmentsData']);
    Route::get('appointment/{scheduleAppointments}', [AppointmentAPIController::class, 'appointment']);
    Route::post('appointment-completed/{scheduleAppointmentsId}', [AppointmentAPIController::class, 'appointmentCompleted']);
    Route::delete('appointment-delete/{scheduleAppointments}', [AppointmentAPIController::class, 'deleteAppointment']);

    //Setting
    Route::get('settings-edit', [SettingAPIController::class, 'editSettings']);
    Route::post('settings-update', [SettingAPIController::class, 'updateSettings']);

    //Enquiry
    Route::get('enquiries', [EnquiryAPIController::class, 'enquiryData']);
    Route::get('enquiries/{enquiry}', [EnquiryAPIController::class, 'enquiry']);
    Route::delete('enquiries-delete/{enquiry}', [EnquiryAPIController::class, 'deleteEnquiry']);

    //Vcard
    Route::get('vcard', [VcardAPIController::class, 'vcardData']);
    Route::get('vcard/{vcard}', [VcardAPIController::class, 'vcard']);
    Route::delete('vcard-delete/{vcard}', [VcardAPIController::class, 'deleteVcard']);
    Route::get('vcard-appointment/{vcard}', [VcardAPIController::class, 'appointmentVcard']);
    Route::get('vcard-enquires/{vcard}', [VcardAPIController::class, 'enquiresVcard']);

    //Groups
    Route::post('groups-create', [GroupAPIController::class, 'groupCreate']);
    Route::get('groups', [GroupAPIController::class, 'groupData']);
    Route::delete('group-delete/{groupId}', [GroupAPIController::class, 'deleteGroup']);

    //BusinessCard
    Route::post('business-cards-create', [AdminBusinessAPIController::class, 'creatBusinessCard']);
    Route::get('business-cards', [AdminBusinessAPIController::class, 'businessCardData']);

    //Subscription Plan
    Route::get('subscription-plan', [SubscriptionPlanAPIController::class, 'subscriptionPlan']);
    Route::get('payment-is-pending',[SubscriptionPlanAPIController::class,'paymentStatus']);
    Route::post('plans-buy/{plan}',[SubscriptionPlanAPIController::class,'buyPlan']);

    //User Delete
    Route::delete('/delete-user/{user}', [AuthAPIController::class, 'userDelete']);
    });

    //Vcards
    Route::get('vcard', [SuperAdminVcardsAPIController::class, 'vcardsData']);
    Route::get('vcard/{vcard}', [SuperAdminVcardsAPIController::class, 'vcard']);
    Route::get('vcard-qrcode/{vcard}', [SuperAdminVcardsAPIController::class, 'qrcodeVcard']);

    //Profile
    Route::get('profile-edit', [ProfileAPIController::class, 'editProfile']);
    Route::post('profile-update', [ProfileAPIController::class, 'updateProfile']);
    Route::post('language-update', [ProfileAPIController::class, 'updateLanguage']);

    //Groups
    Route::post('groups-create', [SuperAdminGroupsAPIController::class, 'groupCreate']);
    Route::get('groups', [SuperAdminGroupsAPIController::class, 'groupData']);
    Route::delete('group-delete/{groupId}', [SuperAdminGroupsAPIController::class, 'deleteGroup']);

    //BusinessCard
    Route::post('business-cards-create', [SuperAdminBusinessAPIController::class, 'createBusinessCard']);
    Route::get('business-cards', [SuperAdminBusinessAPIController::class, 'businessCardData']);
});
