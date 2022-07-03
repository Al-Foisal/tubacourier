<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    protected $guarded = [];
    public function expenseCategory()
    {
        return $this->belongsTo(ExpenseCategory::class);
    }
}
