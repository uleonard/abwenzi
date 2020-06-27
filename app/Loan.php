<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    
    /**
     * Get the loan type that owns the loan.
     */
    public function loan_type()
    {
        return $this->belongsTo('App\LoanType', 'loan_type');

    }

    /**
     * Get the user who processed this loan.
     */
    public function processor()
    {
        return $this->belongsTo('App\User', 'processed_by');

    }

     /**
     * Get the user who authorized this loan.
     */
    public function authorizer()
    {
        return $this->belongsTo('App\User', 'authorized_by');

    }

     /**
     * Get the user who entered this loan.
     */
    public function eentered_by()
    {
        return $this->belongsTo('App\User', 'entered_by');

    }

}

