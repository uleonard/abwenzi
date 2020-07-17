<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Equity extends Model
{
    /**
     * Get the shareholder that owns this equity.
     */
    public function owned_by()
    {
        return $this->belongsTo('App\Shareholder', 'shareholder');

    }

    /**
     * Get the user who entered this equity.
     */
    public function entered_by()
    {
        return $this->belongsTo('App\User', 'entered_by');

    }
}
