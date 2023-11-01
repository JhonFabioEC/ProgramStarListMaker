<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Department;
use App\Models\Municipality;
use Illuminate\Http\Request;
use App\Models\Establishment;
use App\Models\EstablishmentType;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rules\Password;

class RegisterEstablishmentController extends Controller
{
    public function create()
    {
        $departments = Department::get();
        $municipalities = Municipality::get();
        $establishment_types = EstablishmentType::get();

        return view('auth.RegisterEstablishment', [
            'departments' => $departments,
            'municipalities' => $municipalities,
            'establishment_types' => $establishment_types,
            'user' => null,
            'establishment' => null
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255|min:5',
            'email_address' => 'required|string|email|max:255|min:8|unique:users',
            'password' => ['required', 'confirmed', Password::default()],
            'name' => 'required|string',
            'phone_number' => 'required|integer',
            'zone_type' => 'required',
            'address' => 'required|string',
            'establishment_type_id' => 'required',
            'municipality_id' => 'required'
        ]);

        $user = User::create(
            [
                'image' => 'https://picsum.photos/640/480?random=38147',
                'username' => $request->username,
                'email_address' => $request->email_address,
                'password' => bcrypt($request->password),
                'account_status' => true,
                'role_type_id' => 2
            ]
        );

        $user_id = $user->id;

        Establishment::create(
            [
                'name' => $request->name,
                'phone_number' => $request->phone_number,
                'zone_type' => $request->zone_type,
                'address' => $request->address,
                'user_id' => $user_id,
                'establishment_type_id' => $request->establishment_type_id,
                'municipality_id' => $request->municipality_id,
            ]
        );

        return redirect()->route('login');
    }
}
