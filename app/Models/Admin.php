<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    protected $table = 'admin';
    
    protected $fillable = [
        'cpf',
        'first_name',
        'email',
        'mobile_number',
        'password',
        'community_id',
        'active'
    ];

    public function community () {
        return $this->hasOne(Community::class, 'id', 'community_id'); 
    }
}
