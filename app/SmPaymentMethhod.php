<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SmPaymentMethhod extends Model
{
    public function incomeAmounts(){
    	return $this->hasMany('App\SmAddIncome','payment_method_id');
    }

    public function getIncomeAmountAttribute()
    {
        return $this->incomeAmounts->sum('amount');
    }

    public function expenseAmounts(){
    	return $this->hasMany('App\SmAddExpense','payment_method_id');
    }

    public function getExpenseAmountAttribute()
    {
        return $this->expenseAmounts->sum('amount');
    }
}
