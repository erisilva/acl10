<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;

use App\Models\User;
use App\Models\Theme;

class ProfileController extends Controller
{
    /**
     * Show the user profile.
     */
    public function show() : View
    {
        return view('profile.show', [
            'user' => User::findOrFail(auth()->id()),
            'themes' => Theme::all(),
        ]);
    }

    /**
     * Update the user password.
     */
    public function updatePassword(Request $request) : RedirectResponse
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|confirmed|min:6',
        ]);

        $user = User::findOrFail(auth()->id());

        if (Hash::check($request->current_password, $user->password)) {
            $user->password = Hash::make($request->password);
            $user->save();
            return redirect()->route('profile')->with('success', __('Password changed successfully!'));
        } else {
            return redirect()->route('profile')->with('error', __('Current password is incorrect!'));
        }
    }

    /**
     * Update the user theme.
     */
    public function updateTheme(Request $request) : RedirectResponse
    {
        $request->validate([
            'theme' => 'required',
        ]);

        $user = User::findOrFail(auth()->id());

        $user->theme_id = $request->theme;

        $user->save();

        return redirect()->route('profile')->with('success', 'Tema alterado com sucesso!');
    }



}
