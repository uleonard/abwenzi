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

     /**
     * Get the clients entered by this user.
     */
    public function clients()
    {
        return $this->hasMany('App\Client', 'entered_by');

    }
     /**
     * Get the repayments entered by this user.
     */
    public function repayments()
    {
        return $this->hasMany('App\Repayment', 'entered_by');

    }
     /**
     * Get the repayments entered by this user.
     */
    public function commissions()
    {
        return $this->hasMany('App\Commission', 'agent');

    }

    /**
     * Get the repaymeents entered by this user.
     */
    public function cashes()
    {
        return $this->hasMany('App\Cash', 'entered_by');

    }

    /**
     * Get the equities entered by this user.
     */
    public function equities()
    {
        return $this->hasMany('App\Equity', 'entered_by');

    }

    /**
     * Get the savings entered by this user.
     */
    public function savings()
    {
        return $this->hasMany('App\Savings', 'entered_by');

    }
    /**
     * Get the savings withdrawals entered by this user.
     */
    public function savings_withdrawals()
    {
        return $this->hasMany('App\SavingsWithdrawal', 'entered_by');

    }

    /**
     * Get the beneficiaries entered by this user.
     */
    public function beneficiaries()
    {
        return $this->hasMany('App\Beneficiary', 'entered_by');

    }

    /**
     * Get the expenses entered by this user.
     */
    public function expenses()
    {
        return $this->hasMany('App\Expense', 'entered_by');

    }
}
