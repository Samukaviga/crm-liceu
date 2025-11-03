<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StatisticService extends Model
{
    protected $table = 'statistics_services';

    protected $fillable = [
        'start_of_service',
        'end_of_service',
        'person_start_service',
        'name_client',
        'phone',
        'email',
        'grade',
        'comment',
        'matter',
        'resume',
        'person_finished_service',
        'total_service_time',
        'total_after_person_start',
        'total_time_queue',
        'total_time_department',
        'time_between_responses',
        'during_working_hours',
        'unique_sellflux',
        'school',
    ];

}
