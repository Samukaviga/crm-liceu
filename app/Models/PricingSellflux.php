<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PricingSellflux extends Model
{
    protected $table = 'pricing_sellflux';

    protected $fillable = [
        'value',
        'project_id',
        'description',
        'type',
        'created_at_sellflux',
        'canceled',
    ];
}
