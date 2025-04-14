<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HousingProfile extends Model
{
    protected $table = 'housing_profile';

    public $timestamps = false;

    protected $fillable = [
        //definir quantas e quais perguntas de checkbox irão ser feitas a respeito do perfil de moradia
    ];

    public function address(): BelongsTo
    {
        return $this->belongsTo(Address::class, 'housing_profile', 'id');
    }
}
