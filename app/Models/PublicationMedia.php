<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PublicationMedia extends Model
{
    protected $table = 'publication_media';

    public $timestamps = false;

    protected $fillable = [
        'publication_id',
        'path',
    ];

    public function publication()
    {
        $this->belongsTo(Publication::class);
    }
}
