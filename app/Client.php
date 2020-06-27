<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    /**
     * Get the user who entered this client.
     */
    public function entered_by()
    {
        return $this->belongsTo('App\User', 'entered_by');

    }
}
