<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function user_index(){
        $users = User::all();
        return view('user', compact('users'));
    }
}
