<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClientCommunication extends Model
{
    

    /**
     * Get the client that owns the client communication.
     */
    public function client()
    {
        return $this->belongsTo('App\Client', 'client');
    }
}
