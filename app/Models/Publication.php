<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Publication extends Model
{
    protected $table = 'publications';

    public $timestamps = true;

    protected $fillable = [
        'title',
        'user_id',
        'message',
        'incident_id',
        'urgency_id',
        'incident_date',
        'incident_time',
        'anonymous',
        'active',
        'solved',
        'community_id'
    ];


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function incident(): HasOne
    {
        return $this->hasOne(Incident::class, 'id', 'incident_id');
    }

    public function urgency(): HasOne
    {
        return $this->hasOne(Urgency::class, 'id', 'urgency_id');
    }

    public function media(): HasMany
    {
        return $this->hasMany(PublicationMedia::class);
    }

    public function address(): HasOne
    {
        return $this->hasOne(PublicationAddress::class);
    }

    public function community(): BelongsTo
    {
        return $this->belongsTo(Community::class, 'community_id', 'id');
    }
}
