<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RegisterEstablishmentController extends Controller
{
    public function create() {
        return view('auth.RegisterEstablishment');
    }
}
