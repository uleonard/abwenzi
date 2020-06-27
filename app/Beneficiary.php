<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Beneficiary extends Model
{
    /**
     * Get the user who entered this beneficiary.
     */
    public function entered_by()
    {
        return $this->belongsTo('App\User', 'entered_by');

    }

    /**
     * Get the shareholder that owns this beneficiary.
     */
    public function shareholder()
    {
        return $this->belongsTo('App\Shareholder', 'shareholder');

    }
}
