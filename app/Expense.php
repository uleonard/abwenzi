<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    /**
     * Get the expense category that owns this expense.
     */
    public function category()
    {
        return $this->belongsTo('App\ExpenseCategory', 'category');

    }
}
