<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class AppointmentExtraService extends Pivot
{
    protected $table = 'appointment_extra_services';

    protected $fillable = [
        'appointment_id',
        'extra_service_id',
        'price_at_booking',
    ];
}