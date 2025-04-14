<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class Community extends Model
{
    protected $table = 'community';

    public $timestamps = false;

    protected $fillable = [
        'community'
    ];

    public function address(): BelongsTo
    {
        return $this->belongsTo(Address::class, 'community_id', 'id');
    }
}
