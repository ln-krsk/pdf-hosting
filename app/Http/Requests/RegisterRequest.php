<?php declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RegisterRequest extends FormRequest
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
            'email' => [
                'required','email', Rule::unique('users', 'email'),
                function ($attribute, $value, $fail) {
                    $allowedProviderCompany = 'company.com'; // Replace with your desired email provider
                    $allowedProviderCompany2 = 'company2.com'; // Replace with your desired email provider

                    $emailParts = explode('@', $value);
                    $domain = end($emailParts);

                    if ($domain !== $allowedProviderCompany && $domain !== $allowedProviderCompany2) {
                        $fail('Bitte verwende deine Firmen-E-Mail-Adresse.');
                    }
                },
            ],
            'password' => 'required|min:8|required_with:password_confirmation|same:password_confirmation',
        ];
        return $rulesArray;
    }

    public function messages() :array
    {
        return [
            'email.required' => 'Bitte gib eine E-Mail-Adresse ein.',
            'email.email' => 'Bitte gib eine gültige E-Mail-Adresse ein.',
            'email.unique' => 'Unter dieser E-Mail-Adresse ist bereits ein Account angelegt.',
            'password.required' => 'Bitte gib ein Passwort ein.',
            'password.min' => 'Das Passwort muss mindestens 8 Zeichen lang sein.',
            'password.same' => 'Passworteingaben stimmen nicht überein.',
        ];
    }
}
