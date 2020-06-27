<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SavingsWithdrawal extends Model
{
    /**
     * Get the user who entered this withdrawal.
     */
    public function entered_by()
    {
        return $this->belongsTo('App\User', 'entered_by');

    }

    /**
     * Get the shareholder that owns this withdrawal.
     */
    public function shareholder()
    {
        return $this->belongsTo('App\Shareholder', 'shareholder');

    }
}
