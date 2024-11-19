<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CurrencyAmount extends Model
{
    protected $guarded = [];
    public function currency(){
        return $this->belongsTo(Currency::class,'currency_id');
    }
    
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id'); // Specify the foreign key if it's not the default
    }
}
