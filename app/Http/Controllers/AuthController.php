<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function show(): View
    {
        return view('auth/login');
    }

    public function authenticate(Request $request) : RedirectResponse
    {
        $data = $request->validate(
            [
                'email' => 'required|email',
                'password' => 'required'
            ]
        );

        if (Auth::attempt($data, $request->get('remember'))) {
            $request->session()->regenerate();

            return redirect(route('home'));
        }

        return back()->withErrors(['email' => 'Invalid data provided']);
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect(route('home'));
    }

    public function showCreate() : View
    {
        return view('auth/registration');
    }

    public function create(Request $request)
    {

        $data = $request->validate(
            [
                'email' => 'required|email|unique:users',
                'password' => ['required', Password::min(6)],
                'name' => 'min:3|max:255',
                'auth' => 'required',
                ]
        );
        
        $data['password'] = Hash::make($data['password']);
        User::create($data);

        return redirect('login');
    }
}