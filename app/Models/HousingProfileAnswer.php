<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HousingProfileAnswer extends Model
{
    protected $fillable = [
        'user_id',
        'address_id',
        'question_id',
        'check'
    ];

    public function address()
    {
        return $this->belongsTo(Address::class);
    }
}

