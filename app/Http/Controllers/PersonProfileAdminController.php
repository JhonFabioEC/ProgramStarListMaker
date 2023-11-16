<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Person;
use App\Models\Department;
use App\Models\DocumentType;
use App\Models\Municipality;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Database\QueryException;
use Illuminate\Validation\Rules\Password;

class PersonProfileAdminController extends Controller
{
    public function index()
    {
        $departments = Department::get();
        $municipalities = Municipality::get();
        $document_types = DocumentType::get();
        $user = User::where('id', '=', Auth::user()->id)->get();
        $person = Person::where('user_id', '=', Auth::user()->id)->get();

        return view('admin.person.PersonProfileAdminView', [
            'departments' => $departments,
            'municipalities' => $municipalities,
            'document_types' => $document_types,
            'user' => $user[0],
            'person' => $person[0]
        ]);
    }

    public function edit()
    {
        $departments = Department::get();
        $municipalities = Municipality::get();
        $document_types = DocumentType::get();
        $user = User::where('id', '=', Auth::user()->id)->get();
        $person = Person::where('user_id', '=', Auth::user()->id)->get();

        return view('admin.person.EditPersonProfileAdminView', [
            'departments' => $departments,
            'municipalities' => $municipalities,
            'document_types' => $document_types,
            'user' => $user[0],
            'person' => $person[0]
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'image' => 'image|mimes:jpg,png,jpeg|max:2040',
            'email_address' => 'required|string|email|max:255|min:8|unique:users,email_address,' . Auth::user()->id,
            'password' => ['nullable', Password::default()],
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'phone_number' => 'required|integer|unique:users,phone_number,' . Auth::user()->id,
            'zone_type' => 'required',
            'address' => 'required|string',
            'department_id' => 'required',
            'municipality_id' => 'required',
        ]);

        try {
            $user = User::where('id', '=', Auth::user()->id)->get();
            $person = Person::where('user_id', '=', Auth::user()->id)->get();

            if ($request->hasFile('image')) {
                $imageName = time() . '.' . $request->image->extension();

                if ($user[0]->image && $user[0]->image != 'default.svg' && File::exists(public_path('storage/users/persons/' . $user[0]->image))) {
                    File::delete(public_path('storage/users/persons/' . $user[0]->image));
                }

                $request->image->move(public_path('storage/users/persons'), $imageName);

                $user[0]->update(['image' => $imageName]);
            }

            if ($request->filled('password') && $request->password !== $user[0]->password) {
                $user[0]->update(['password' => bcrypt($request->password)]);
            }

            $user[0]->update(['email_address' => $request->email_address]);

            $person[0]->update([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'phone_number' => $request->phone_number,
                'zone_type' => $request->zone_type,
                'address' => $request->address,
                'municipality_id' => $request->municipality_id,
            ]);

            $message = 'usuario actualizado';
            return redirect()->route('admin_profile')->with('success', $message);
        } catch (QueryException $e) {
            $message = 'no se pudo actualizar el usuario';
            return redirect()->route('admin_edit_profile')->with('error', $message);
        }
    }

    public function destroy($id)
    {
        $user = User::find($id);

        try {
            if ($user->image && $user->image != 'default.svg' && File::exists(public_path('storage/users/persons/' . $user->image))) {
                File::delete(public_path('storage/users/persons/' . $user->image));
            }

            $user->delete();
            $message = 'usuario eliminado';
            return redirect()->route('login')->with('success', $message);
        } catch (QueryException $e) {
            $message = 'el usuario no puede ser eliminado';
            return redirect()->route('admin_profile')->with('error', $message);
        }
    }
}
