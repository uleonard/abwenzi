<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LoanAttachment extends Model
{
    /**
     * Get the loan that owns the attachment.
     */
    public function loan()
    {
        return $this->belongsTo('App\Loan', 'loan');

    }
}
