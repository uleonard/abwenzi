<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shareholder extends Model
{
    /**
     * Get the equities owned by this shareholder.
     */
    public function equities()
    {
        return $this->hasMany('App\Equity', 'shareholder');

    }

    /**
     * Get the savings owned by this shareholder.
     */
    public function savings()
    {
        return $this->hasMany('App\Savings', 'shareholder');

    }

    /**
     * Get the savings withdrawals owned by this shareholder.
     */
    public function savings_withdrawals()
    {
        return $this->hasMany('App\SavingsWithdrawal', 'shareholder');

    }

    /**
     * Get the beneficiaries owned by this shareholder.
     */
    public function beneficiaries()
    {
        return $this->hasMany('App\Beneficiary', 'shareholder');

    }
}
