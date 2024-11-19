<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Currency extends Model
{
    use SoftDeletes;
    protected $guarded = [];
    public function currencyAmount(){
        return $this->hasMany(CurrencyAmount::class ,'currency_id');
    }
    public function users(){
        return $this->belongsTo(User::class ,'user_id');
    }
}
