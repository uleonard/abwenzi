<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    /**
     * Get the user who entered this client.
     */
    public function user_entered()
    {
        return $this->belongsTo('App\User', 'entered_by');
    }

     /**
     * Get the loans for the client.
     */
    public function loans()
    {
        return $this->hasMany('App\Loan', 'client');
    }

     /**
     * Get the communications for the client.
     */
    public function communications()
    {
        return $this->hasMany('App\ClientCommunication', 'client');
    }

}
