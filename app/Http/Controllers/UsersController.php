<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $response = User::where('id', Auth::user()->id)
        ->first();
        return view('pages.profile', compact('response'));
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
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        if ($request->changeType == 0) {
            $this->validate($request, [
                'name' => ['required', 'string', 'max:255'],
            ]);

            User::where('id', Auth::user()->id)
            ->update([
                'name' => $request->name,
            ]);

            return back()->with('success', 'Profile updated successfully!');
        }

        if ($request->changeType == 1) {
            $this->validate($request, [
                'password' => ['required', 'string', 'min:8', 'confirmed'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users']
            ]);

            User::where('id', Auth::user()->id)
            ->update([
                'password' => Hash::make($request->password),
                'email' => $request->email
            ]);

            return back()->with('success', 'Profile updated successfully!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
