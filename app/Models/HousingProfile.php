<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HousingProfile extends Model
{
    protected $table = 'housing_profiles';

    public $timestamps = false;

    protected $fillable = [
        'question',
        'check'
    ];

    public function address(): BelongsTo
    {
        return $this->belongsTo(Address::class, 'housing_profile', 'id');
    }
}
