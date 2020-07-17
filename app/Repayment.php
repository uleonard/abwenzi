<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Repayment extends Model
{
    protected $dates = ['date_paid'];
    /**
     * Get the user who entered this repayment.
     */
    public function entered_by()
    {
        return $this->belongsTo('App\User', 'entered_by');

    }

    /**
     * Get the loan that owns this repayment.
     */
    public function loan()
    {
        return $this->belongsTo('App\Loan', 'loan');

    }
}
