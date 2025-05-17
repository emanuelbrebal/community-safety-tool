<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Incident extends Model
{
    protected $table = 'incident_type';

    public $timestamps = false;

    protected $fillable = [
        'incident',
        'description',
        'urgency_id'
    ];

    public function urgency(): HasOne
    {
        return $this->hasOne(Urgency::class, 'id', 'urgency_id');
    }
}
