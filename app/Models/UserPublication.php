<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class UserPublication extends Model
{
    protected $table = 'users_publications';

    protected $fillable = [
        'user_id',
        'publication_id'
    ];

    public function user(): HasOne{
        return $this->hasOne(User::class, 'id', 'user_id');
    }
    public function publication(): HasOne{
        return $this->hasOne(Publication::class, 'id', 'publication_id');
    }
}
