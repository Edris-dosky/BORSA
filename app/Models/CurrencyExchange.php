<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CurrencyExchange extends Model
{
    use SoftDeletes;
    protected $guarded = [];
    public function users(){
        return $this->belongsTo(User::class ,'user_id');
    }
    public function amounts(){
        return $this->belongsTo(Amount::class ,'amount_id');
    }
    public function clients(){
        return $this->belongsTo(Client::class ,'client_id');
    }

}
