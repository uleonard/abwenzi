<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LoanType extends Model
{
    
     /**
     * Get the loans for the loan category.
     */
    public function loans()
    {
        return $this->hasMany('App\Loan', 'loan_type');

    }
}
