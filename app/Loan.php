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
     * Get the client that owns the loan.
     */
    public function client()
    {
        return $this->belongsTo('App\Client', 'client');

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
    public function entered_by()
    {
        return $this->belongsTo('App\User', 'entered_by');

    }

    /**
     * Get the repayments owned by this loan.
     */
    public function repayments()
    {
        return $this->hasMany('App\Repayment', 'loan');

    }

    /**
     * Get the commissions owned by this loan.
     */
    public function commission()
    {
        return $this->hasOne('App\Commission', 'loan');

    }

    /**
     * Get the attachments owned by this loan.
     */
    public function attachments()
    {
        return $this->hasMany('App\LoanAttachment', 'loan');

    }

}

