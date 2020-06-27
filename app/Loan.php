<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    
    /**
     * Get the loan type that owns the loan.
     */
    public function loan_types()
    {
        return $this->belongsTo('App\LoanType', 'loan_type');

    }

}

