<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class HousingProfileAnswer extends Model
{
    protected $fillable = [
        'user_id',
        'address_id',
        'question_id',
        'check'
    ];

    public $timestamps = false;

    public function address(): BelongsTo
    {
        return $this->belongsTo(Address::class);
    }

    public function question(): BelongsTo
    {
        return $this->belongsTo(HousingProfile::class, 'question_id');
    }
}

