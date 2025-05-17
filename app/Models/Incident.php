<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Incident extends Model
{
    protected $table = 'incident_type';

    public $timestamps = false;

    protected $fillable = [
        'incident',
        'description'
    ];

}
