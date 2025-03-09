<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Amount extends Model
{
    
    protected $guarded = [];
    public function exchange_amounts(){
        return $this->hasMany(CurrencyAmount::class ,'amount_id');
    }
    public function withdraw_amounts(){
        return $this->hasMany(Withdraw::class ,'amount_id');
    }
}
