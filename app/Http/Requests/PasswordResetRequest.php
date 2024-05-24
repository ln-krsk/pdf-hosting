<?php declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PasswordResetRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() :bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules() :array
    {
        $rulesArray = [
            'email' => ['required', 'email', 'exists:users,email'],

        ];
        return $rulesArray;
    }
    public function messages() :array
    {
        return [
            'email.required' => 'Bitte gib eine E-Mail-Adresse ein.',
            'email.email' => 'Bitte gib eine gültige E-Mail-Adresse ein.',
            'email.exists' => 'Diese E-Mailadresse ist uns nicht bekannt.',
        ];
    }
}
