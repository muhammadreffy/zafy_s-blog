<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\StoreRegistrationRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;

class RegistrationController extends Controller
{
    public function index()
    {
        return view('auth.registration');
    }

    public function store(StoreRegistrationRequest $request): RedirectResponse
    {

        $validated = $request->validated();

        if ($request->hasFile('avatar')) {
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
            $validated['avatar'] = $avatarPath;
        }

        $validated['password'] = Hash::make($validated['password']);
        unset($validated['confirm_password']);

        User::create($validated);

        return redirect()->route('auth.login')
            ->with('registrationSuccessful', 'Account registration successful, please log in!');
    }
}
