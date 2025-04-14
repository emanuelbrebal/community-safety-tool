<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Gender extends Model
{
    //
    protected $table = 'genders';

    public $timestamps = false;

    protected $fillable = [
        'gender'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'gender_id', 'id');
    }
}
