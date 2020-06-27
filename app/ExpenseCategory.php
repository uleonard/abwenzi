<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExpenseCategory extends Model
{
    /**
     * Get the expenses entered owned by this category.
     */
    public function expenses()
    {
        return $this->hasMany('App\Expense', 'category');

    }
}
