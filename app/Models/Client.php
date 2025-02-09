<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use SoftDeletes;
    protected $guarded = [];
    //
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id'); // Specify the foreign key if it's not the default
    }
    public function exchange_clients(){
        return $this->hasMany(CurrencyAmount::class ,'client_id');
    }
}
