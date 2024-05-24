<?php declare(strict_types=1);

namespace App\Http\Controllers;


use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class SessionsController extends Controller
{
    public function create() :View
    {
            return view('sessions.create');
    }

    public function store() : RedirectResponse
    {
        $attributes = request()->validate([
            'email' => ['required', 'email',  Rule::exists('users', 'email')],
            'password' => 'required',
        ]);

        if (auth()->attempt($attributes)) {
            return redirect('entries')->with('success', 'Login erfolgreich!');
        }
        return back()
            ->withInput()
            ->withErrors(['Login' => 'Diese Kombination aus E-Mail-Adresse und Passwort ist uns nicht bekannt.']);
    }

    public function destroy() :RedirectResponse
    {
        auth()->logout();
        return redirect('/')->with('success', 'Logout erfolgreich!');
    }
}
