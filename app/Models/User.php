<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone_number',
        'image',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function userCurrencies(){
        return $this->hasMany(Currency::class, 'user_id');
    }
    public function currencyAmounts()
    {
        return $this->hasMany(CurrencyAmount::class, 'user_id');
    }
    public function clients()
    {
        return $this->hasMany(Client::class, 'user_id');
    }
    public function exchanges_user() {
        return $this->hasMany(CurrencyExchange::class, 'user_id');
        
    }
    public function withdraw_user() {
        return $this->hasMany(Withdraw::class, 'user_id');
        
    }
}
