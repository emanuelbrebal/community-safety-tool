<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Urgency extends Model
{
    protected $table = 'urgency';

    public $timestamps = false;

    protected $fillable = [
        'urgency',
    ];

}
