<?php

namespace App\Models;

use Barryvdh\LaravelIdeHelper\Eloquent;
use Database\Factories\AppointmentFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\Appointment
 *
 * @property int $id
 * @property int $vcard_id
 * @property int $day_of_week
 * @property string $start_time
 * @property string $end_time
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @method static AppointmentFactory factory(...$parameters)
 * @method static Builder|Appointment newModelQuery()
 * @method static Builder|Appointment newQuery()
 * @method static Builder|Appointment query()
 * @method static Builder|Appointment whereCreatedAt($value)
 * @method static Builder|Appointment whereDayOfWeek($value)
 * @method static Builder|Appointment whereEndTime($value)
 * @method static Builder|Appointment whereId($value)
 * @method static Builder|Appointment whereStartTime($value)
 * @method static Builder|Appointment whereUpdatedAt($value)
 * @method static Builder|Appointment whereVcardId($value)
 *
 * @mixin Eloquent
 */
class Appointment extends Model
{
    use HasFactory;

    protected $table = 'appointments';

    protected $fillable = [
        'vcard_id',
        'day_of_week',
        'start_time',
        'end_time',
    ];

    protected $casts = [
        'vcard_id' => 'integer',
        'day_of_week' => 'integer',
        'start_time' => 'string',
        'end_time' => 'string',
    ];

    const ALL = 0;

    const BOOKED = 1;

    const CHECK_IN = 2;

    const CHECK_OUT = 3;

    const CANCELLED = 4;

    const STATUS = [
        self::BOOKED => 'Booked',
        self::CHECK_IN => 'Check In',
        self::CHECK_OUT => 'Check Out',
        self::CANCELLED => 'Cancelled',
    ];

    const STRIPE = 1;

    const PAYPAL = 2;

    const PAYSTACK = 3;

    const PHONEPE = 4;

    const MANUALLY = 7;

    const FLUTTERWAVE = 8;

    const APPROVED = 5;

    const REJECT = 6;

    const PAYMENT_METHOD = [
        self::STRIPE => 'Stripe',
        self::PAYPAL => 'Paypal',
        self::PAYSTACK => 'Paystack',
        self::PHONEPE => 'PhonePe',
        self::MANUALLY => 'Manually',
        self::FLUTTERWAVE => 'Flutterwave',
    ];
}
