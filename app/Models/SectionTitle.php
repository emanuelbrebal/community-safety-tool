<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SectionTitle extends Model
{
    protected $table = 'section_title';

    protected $fillable = [
        'section_title'
    ];

    public function housingProfiles(): HasMany
    {
        return $this->hasMany(HousingProfile::class, 'section_id');
    }
}

