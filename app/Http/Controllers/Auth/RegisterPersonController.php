<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Department;
use App\Models\DocumentType;
use App\Models\Municipality;
use Illuminate\Validation\Rules\Password;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Person;

class RegisterPersonController extends Controller
{
    public function create()
    {
        $departments = Department::get();
        $municipalities = Municipality::get();
        $document_types = DocumentType::get();

        return view('auth.RegisterPerson', [
            'departments' => $departments,
            'municipalities' => $municipalities,
            'document_types' => $document_types,
            'user' => null,
            'person' => null
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255|min:5',
            'email_address' => 'required|string|email|max:255|min:8|unique:users',
            'password' => ['required', 'confirmed', Password::default()],
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'birth_date' => 'required|date',
            'document_number' => 'required|integer',
            'phone_number' => 'required|integer',
            'zone_type' => 'required',
            'address' => 'required|string',
            'document_type_id' => 'required',
            'municipality_id' => 'required'
        ]);

        $user = User::create(
            [
                'image' => 'https://picsum.photos/640/480?random=38147',
                'username' => $request->username,
                'email_address' => $request->email_address,
                'password' => bcrypt($request->password),
                'account_status' => true,
                'role_type_id' => 3
            ]
        );

        $user_id = $user->id;

        Person::create(
            [
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'birth_date' => $request->birth_date,
                'sex' => $request->sex,
                'document_number' => $request->document_number,
                'phone_number' => $request->phone_number,
                'zone_type' => $request->zone_type,
                'address' => $request->address,
                'user_id' => $user_id,
                'document_type_id' => $request->document_type_id,
                'municipality_id' => $request->municipality_id,
            ]
        );

        return redirect()->route('login');
    }
}
