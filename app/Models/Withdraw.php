<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Withdraw extends Model
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
    public function currencies(){
        return $this->belongsTo(Currency::class ,'client_id');
    }
}
