<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PublicationMedia extends Model
{
    protected $table = 'publication_media';

    public $timestamps = false;

    protected $fillable = [
        'path',
    ];

}
