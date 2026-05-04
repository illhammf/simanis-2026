<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use App\Support\PanelResolver;
use Illuminate\Support\Facades\Auth;

class LoginPage extends Component
{
    public string $email = '';
    public string $password = '';

    public function mount()
    {
        if (auth()->check()) {
            return redirect()->to(PanelResolver::redirectUrl(auth()->user()));
        }
    }

    public function login()
    {
        $credentials = $this->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (!Auth::attempt($credentials)) {
            $this->addError('email', 'Email atau password salah');
            return;
        }

        session()->regenerate();

        return redirect()->to(PanelResolver::redirectUrl(auth()->user()));
    }

    public function render()
    {
        return view('livewire.auth.login-page')
            ->layout('welcome');
    }
}