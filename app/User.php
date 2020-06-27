<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role',
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


    /**
     * Get the loans processed by this user.
     */
    public function loans_processed()
    {
        return $this->hasMany('App\Loan', 'processed_by');

    }

     /**
     * Get the loans authorized by this user.
     */
    public function loans_authorized()
    {
        return $this->hasMany('App\Loan', 'authorized_by');

    }

     /**
     * Get the loans entered by this user.
     */
    public function loans_entered()
    {
        return $this->hasMany('App\Loan', 'entered_by');

    }
}
