<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    private $formatted_amount;
    private $formatted_interest;
    private $formatted_balance;

    protected $dates = ['due_date','date_processed','date_authorized','date_applied'];
    
    /**
     * Get formatted amount
     */
    public function getFormattedAmountAttribute(){
        return number_format($this->attributes['amount'],2);
    }
    /**
     * Get formatted Interest
     */
    public function getFormattedInterestAttribute(){
        return number_format($this->attributes['interest'],2);
    }
    /**
     * Get formatted Interest
     */
    public function getFormattedBalanceAttribute(){
        return number_format($this->attributes['balance'],2);
    }

    /**
     * Get the loan type that owns the loan.
     */
    public function type()
    {
        return $this->belongsTo('App\LoanType', 'loan_type');

    }

    /**
     * Get the client that owns the loan.
     */
    public function owner()
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

