<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    const ACCESS_LEVEL_MASTER_ADMIN = 'master_admin';
    const ACCESS_LEVEL_DEPARTMENT_ADMIN = 'department_admin';
    const ACCESS_LEVEL_AGENT = 'agent';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function isMasterAdmin()
    {
        return in_array($this->access_level, [self::ACCESS_LEVEL_MASTER_ADMIN]);
    }
    public function canModarateTickets()
    {
        return in_array($this->access_level, [self::ACCESS_LEVEL_MASTER_ADMIN, self::ACCESS_LEVEL_AGENT]);
    }
    public function canDepartmentAdmin()
    {
        return in_array($this->access_level, [self::ACCESS_LEVEL_DEPARTMENT_ADMIN]);
    }
    public function canModifyTickets()
    {
        return in_array($this->access_level, [self::ACCESS_LEVEL_MASTER_ADMIN, self::ACCESS_LEVEL_DEPARTMENT_ADMIN]);
    }
}
