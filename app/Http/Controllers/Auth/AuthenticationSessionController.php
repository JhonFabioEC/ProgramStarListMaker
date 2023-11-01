<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;

class AuthenticationSessionController extends Controller
{
    public function create() {
        return view('auth.Login');
    }

    public function store(Request $request) {
        $credentials = $request->validate([
            'email_address' => 'required|string|email|max:255|min:8',
            'password' => 'required|string'
        ]);

        // Incorrecto, genera exención y retorna al formulario de login
        if(!Auth::attempt($credentials)){
            throw ValidationException::withMessages([
                'password' => 'Autenticación incorrecta'
            ]);
        }

        // Crear el archivo de la sesión
        // Almacenando datos mientras esta en la sesión

        $request->session()->regenerate();

        if(Auth::user()->role_type_id == 1){
            return redirect()->route('welcome_admin');
        }elseif(Auth::user()->role_type_id == 2){
            return redirect()->route('welcome_establishment');
        }elseif(Auth::user()->role_type_id == 3){
            return redirect()->route('welcome_user');
        }

        return redirect()->route('login');
    }

    public function destroy(Request $request) {
        // Destruir el archivo de sesión
        $request->session()->invalidate();

        // Obtener un nuevo token
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
