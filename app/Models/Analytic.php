<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Analytic extends Model
{
    protected $table = 'analytics';

    protected $fillable = [
        'template_id',
        'start_date',
        'end_date',
        'send',
        'delivery',
        'read',
        'replied',
        'amount_spent',
        'cost_per_delivered',
        'cost_url_button_click',
    ];

    public function template()
    {
        return $this->belongsTo(Template::class, 'template_id');
    }
}
