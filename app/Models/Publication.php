<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Publication extends Model
{
    protected $table = 'publications';

    public $timestamps = true;

    protected $fillable = [
        'title',
        'image',
        'user_id',
        'message',
        'comment_id'
    ];

  
    public function comment_id(): HasMany
    {
        return $this->hasMany(Comment::class, 'id', 'comment_id');
    }

    public function user_id(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
     

