<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UpdateAccountRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $user = $this->route('user');

        $userLogin = Auth::user()->username;

        return $user->username === $userLogin;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'avatar' => ['nullable', 'mimes:png,jpg', 'max:2048'],
            'name' => ['required', 'string', 'min:3', 'max:50'],
            'username' => ['required', 'string', 'min:3', 'max:30', 'regex:/^_?[a-zA-Z0-9](?!.*\.\.)[a-zA-Z0-9._]*[a-zA-Z0-9._]$/', Rule::unique('users')->ignore($this->route('user')->id)],
            'email' => ['required', 'string', 'email:rfc,dns', Rule::unique('users')->ignore($this->route('user')->id)],
            'current_password' => ['nullable'],
            'password' => ['nullable', 'string', 'min:8', 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*(_|[^\w])).+$/'],
            'confirm_password' => ['same:password'],
        ];
    }
}
