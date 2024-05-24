<?php declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\PasswordResetRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Password;
use Illuminate\Contracts\View\View;

class PasswordResetController extends Controller
{
    public function create() :View
    {
        return view('auth.forgot-password');
    }

    public function store(PasswordResetRequest $rulesArray) :RedirectResponse
    {
        $status = Password::sendResetLink(
            $rulesArray->only('email'));

        return $status === Password::RESET_LINK_SENT
            ? back()->with(['status' => __($status)])->with('success', 'Ein Link zum Zurücksetzen des Passworts wurde versandt.')
            : back()->withErrors(['email' => __($status)]);
    }
}




