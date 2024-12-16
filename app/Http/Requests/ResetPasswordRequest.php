<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class ResetPasswordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'token' => ['required'],
            'email' => ['required','string','email'],
            'password' => ['required','string','confirmed'],
        ];
    }
    public function reset(): bool
    {
        $credential = $this->only('email', 'password', 'password_confirmation', 'token');

        $status = Password::reset($credential, function (User $user, $password) {
            $user->forceFill(['password' => $password])->setRememberToken(str::random(60));
            $user->save();
        });
        return $status === Password::PASSWORD_RESET;
    }
}
