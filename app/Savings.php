<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Savings extends Model
{
      /**
     * Get the shareholder that owns this savings.
     */
    public function shareholder()
    {
        return $this->belongsTo('App\Savings', 'shareholder');

    }

    /**
     * Get the user who entered this savings.
     */
    public function entered_by()
    {
        return $this->belongsTo('App\User', 'entered_by');

    }
}
