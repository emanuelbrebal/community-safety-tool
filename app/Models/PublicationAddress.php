<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class PublicationAddress extends Model
{
    protected $table = 'publication_address';

    public $timestamps = false;

    protected $fillable = [
        'public_place',
        'number',
        'complement',
        'publication_id'
    ];

    public function publication()
    {    
        $this->belongsTo(Publication::class);
    }
}
