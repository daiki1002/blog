<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function editPassword()
    {
        $user = $this->user->findOrFail(Auth::user()->id);

        return view('users.password')->with('user', $user);
    }

    public function updatePassword(Request $request)
    {   
        $user = $this->user->findOrFail(Auth::user()->id);

        if(!password_verify($request->current_password, $user->password)){
            return redirect()
                        ->back()
                        ->with('warning', 'Unable to change your password.')
                        ->with('error_current_password', "That's not your current password. Try again."); 
        };

        if($request->current_password === $request->new_password){
            return redirect()
                        ->back()
                        ->with('warning', 'Unable to change your password.')
                        ->with('error_new_password', 'New password cannot be the same as your current password. Try again.');
        }

        $request->validate([
            'new_password' => ['required', Password::min(8)->numbers()->letters(), 'confirmed',]
        ]);

        $user->password = Hash::make($request->new_password);
        $user->save();

        return redirect()->back()->with('success', 'Password changed successfully.');
    }
}
