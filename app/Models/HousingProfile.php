<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HousingProfile extends Model
{
    protected $table = 'housing_profiles_questions';

    public $timestamps = false;

    protected $fillable = [
        'question',
        'check',
        'section_id',
    ];

    public function address(): BelongsTo
    {
        return $this->belongsTo(Address::class, 'housing_profile_id', 'id'); 
    }
    
    public function section(): BelongsTo
    {
        return $this->belongsTo(SectionTitle::class, 'section_id');
    }
}


