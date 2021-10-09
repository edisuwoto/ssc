<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SmBankStatement extends Model
{
    public function bankName()
    {
        return $this->belongsTo('App\SmBankAccount', 'bank_id', 'id');
    }

    public function paymentMethod(){
        return $this->belongsTo('App\SmPaymentMethhod','payment_method','id');
    }
    
}
