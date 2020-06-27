<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Commission extends Model
{
    /**
     * Get the user (agent) for this commission.
     */
    public function agent()
    {
        return $this->belongsTo('App\User', 'agent');

    }

    /**
     * Get the loan that owns this commission.
     */
    public function loan()
    {
        return $this->belongsTo('App\Loan', 'loan');

    }
}
