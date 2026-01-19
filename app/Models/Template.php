<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
    protected $table = 'templates';
    protected $fillable = ['school_id', 'name', 'number', 'type', 'campaign', 'category'];

    public function school()
    {
        return $this->belongsTo(School::class, 'school_id');
    }

}
