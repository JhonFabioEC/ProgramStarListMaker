<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use App\Models\Department;
use App\Models\Municipality;
use Illuminate\Http\Request;
use App\Models\Establishment;
use App\Models\EstablishmentType;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Database\QueryException;
use Illuminate\Validation\Rules\Password;

class EstablishmentProfileController extends Controller
{
    public function index()
    {
        $departments = Department::get();
        $municipalities = Municipality::get();
        $establishment_types = EstablishmentType::get();
        $user = User::where('id', '=', Auth::user()->id)->get();
        $establishment = Establishment::where('user_id', '=', Auth::user()->id)->get();

        return view('admin.establishment.EstablishmentView', [
            'departments' => $departments,
            'municipalities' => $municipalities,
            'establishment_types' => $establishment_types,
            'user' => $user[0],
            'establishment' => $establishment[0]
        ]);
    }

    public function edit()
    {
        $departments = Department::get();
        $municipalities = Municipality::get();
        $establishment_types = EstablishmentType::get();
        $user = User::where('id', '=', Auth::user()->id)->get();
        $establishment = Establishment::where('user_id', '=', Auth::user()->id)->get();

        return view('admin.establishment.EditEstablishmentView', [
            'departments' => $departments,
            'municipalities' => $municipalities,
            'establishment_types' => $establishment_types,
            'user' => $user[0],
            'establishment' => $establishment[0]
        ]);
    }

    public function update(Request $request)
    {
        $user = User::where('id', '=', Auth::user()->id)->get();
        $establishment = Establishment::where('user_id', '=', Auth::user()->id)->get();

        $request->validate([
            'image' => 'image|mimes:jpg,png,jpeg|max:2040',
            'email_address' => 'required|string|email|max:255|min:8|unique:users,email_address,' . Auth::user()->id,
            'password' => ['nullable', Password::default()],
            'name' => 'required|string',
            'phone_number' => 'required|integer|unique:people|unique:establishments,phone_number,' . $establishment[0]->id,
            'zone_type' => 'required',
            'address' => 'required|string',
            'department_id' => 'required',
            'municipality_id' => 'required',
            'establishment_type_id' => 'required',
        ]);

        try {
            if ($request->hasFile('image')) {
                $imageName = time() . '.' . $request->image->extension();

                if ($user[0]->image && $user[0]->image != 'default.svg' && File::exists(public_path('storage/users/establishments/' . $user[0]->image))) {
                    File::delete(public_path('storage/users/establishments/' . $user[0]->image));
                }

                $request->image->move(public_path('storage/users/establishments'), $imageName);

                $user[0]->update(['image' => $imageName]);
            }

            if ($request->filled('password') && $request->password !== $user[0]->password) {
                $user[0]->update(['password' => bcrypt($request->password)]);
            }

            $user[0]->update(['email_address' => $request->email_address]);

            $establishment[0]->update([
                'name' => $request->name,
                'phone_number' => $request->phone_number,
                'zone_type' => $request->zone_type,
                'address' => $request->address,
                'municipality_id' => $request->municipality_id,
                'establishment_type_id' => $request->establishment_type_id,
            ]);

            $message = 'establecimiento actualizado';
            return redirect()->route('establishment_profile')->with('success', $message);
        } catch (QueryException $e) {
            $message = 'no se pudo actualizar el establecimiento';
            return redirect()->route('establishment_edit_profile')->with('error', $message);
        }
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $establishment = Establishment::where('user_id', '=', $user->id)->get();
        $products = Product::where('establishment_id', '=', $establishment[0]->id)->get();

        try {
            foreach ($products as $product) {
                if ($product->image && $product->image != 'default.svg' && File::exists(public_path('storage/products/' . $product->image))) {
                    File::delete(public_path('storage/products/' . $product->image));
                }
            }

            if ($user->image && $user->image != 'default.svg' && File::exists(public_path('storage/users/establishments/' . $user->image))) {
                File::delete(public_path('storage/users/establishments/' . $user->image));
            }

            $user->delete();
            $message = 'establecimiento eliminado';
            return redirect()->route('login')->with('success', $message);
        } catch (QueryException $e) {
            $message = 'el establecimiento no puede ser eliminado';
            return redirect()->route('establishment_edit_profile')->with('error', $message);
        }
    }
}
