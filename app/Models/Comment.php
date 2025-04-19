<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Comment extends Model
{
    protected $table = 'comments';

    public $timestamps = true;

    protected $fillable = [
        'message',
        'image',
        'publication_id',
        'user_id'
    ];

    public function publication_id(): BelongsTo
    {
        return $this->belongsTo(Publication::class, 'id', 'publication_id');
    }

    public function user_id(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id', 'user_id');
    }
}
