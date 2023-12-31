<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::where('id', '!=', Auth::user()->id)->get();
        return view('admin.userAccount.ManagementUserAccountsView', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }

    public function setAccountStatus($id)
    {
        $user = User::find($id);

        try {
            $user->update(
                [
                    'account_status' => !$user->account_status
                ]
            );

            $message = 'cuenta de usuario actualizada';
            return redirect()->route('user_accounts.index')->with('success', $message);
        } catch (QueryException $e) {
            $message = 'no pudo actualizar la cuenta de usuario';
            return redirect()->route('user_accounts.index')->with('error', $message);
        }
    }
}
