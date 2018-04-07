<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    const ADMIN_ROLE = 'admin';
    const AGENT_ROLE = 'agent';
    const DEFAULT_ROLE = 'customer';

    protected $fillable = [
        'name', 'email', 'password',
    ];


    public function isAdmin()    {        
    return $this->role === self::ADMIN_ROLE;    
    }
    
    
    
    public function isAgent()    {        
    return $this->role === self::AGENT_ROLE;    
    }
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
