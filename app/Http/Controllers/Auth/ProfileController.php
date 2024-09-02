<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\UpdateAccountRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function profile()
    {
        $statusOwner = Auth::user()->hasRole('owner');
        $statusWriter = Auth::user()->hasRole('writer');

        if ($statusOwner) {
            $status = 'Owner';
        } else if ($statusWriter) {
            $status = 'Writer';
        } else {
            $status = 'Visitor';
        }

        return view('auth.my_profile', compact('status'));
    }

    public function settings()
    {
        $user = Auth::user();
        return view('auth.settings', compact('user'));
    }

    public function update_profile(UpdateAccountRequest $request, User $user)
    {
        $userLogin = Auth::user();

        $validated = $request->validated();

        if ($request->filled('password')) {
            if (!Hash::check($request->current_password, $userLogin->password)) {
                return redirect()->back()
                    ->withErrors(['current_password' => 'Your current password does not match our records'])
                    ->withInput();
            }

            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        unset($validated['current_password']);
        unset($validated['confirm_password']);

        DB::transaction(function () use ($request, $validated, $user, $userLogin) {
            if ($request->hasFile('avatar')) {
                if ($userLogin->avatar) {
                    Storage::delete('avatars/' . $userLogin->avatar);
                }

                $avatarPath = $request->file('avatar')->store('avatars', 'public');
                $validated['avatar'] = $avatarPath;
            }

            $user->update($validated);
        });

        return redirect()->route('settings', [
            'user' => $user->username,
        ])->with('UpdatedSuccessProfile', 'Profile updated successfully');

    }
}
