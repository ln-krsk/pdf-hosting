<?php declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class RegisterController extends Controller
{
    public function create() :View
    {
        return view('register.create');
    }

    public function store(RegisterRequest $request) :RedirectResponse
    {
        User::create([
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);

        return redirect('/')->with('success', 'Die Registrierung war erfolgreich. Du kannst dich jetzt einloggen.');
    }
}
