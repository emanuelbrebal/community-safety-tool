<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $table = 'addresses';

    public $timestamps = false;

    protected $fillable = [
        'community_id',
        'zip_code',
        'state',
        'municipality',
        'public_place',
        'street',
        'number',
        'complement',
        'user_id',
        'housing_profile'
    ];

    public function community(): HasOne
    {
        return $this->hasOne(Community::class, 'id', 'community_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function housing_profile(): HasOne
    {
        return $this->hasOne(HousingProfile::class, 'id', 'community_id');
    }
}
