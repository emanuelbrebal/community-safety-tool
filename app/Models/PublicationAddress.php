<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PublicationAddress extends Model
{
    protected $table = 'publication_address';

    public $timestamps = false;

    protected $fillable = [
        'public_place',
        'number',
        'complement',
    ];


}
