<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use App\Models\AkademikStaff;
use App\Models\Ortu;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\User;
use App\Support\PanelResolver;
use Illuminate\Support\Facades\Auth;

class LoginPage extends Component
{
    public string $identifier = '';
    public string $password = '';

    public function mount()
    {
        if (auth()->check()) {
            return redirect()->to(PanelResolver::redirectUrl(auth()->user()));
        }
    }

    public function login()
    {
        $passwordRules = ['required'];

        // Di local: super_admin boleh login tanpa password
        if (app()->environment('local') && $this->isSuperAdminIdentifier()) {
            $passwordRules = [];
        }

        $this->validate([
            'identifier' => ['required', 'string'],
            'password'   => $passwordRules,
        ]);

        $identifier = $this->identifier;
        $user       = null;

        if (filter_var($identifier, FILTER_VALIDATE_EMAIL)) {
            $user = User::where('email', $identifier)->first();
        } elseif (str_starts_with(strtoupper($identifier), 'NIG-')) {
            $user = Teacher::where('nig', $identifier)->first()?->user
                ?? User::where('username', $identifier)->first();
        } elseif (str_starts_with(strtoupper($identifier), 'NIS-')) {
            $user = Student::where('nis', $identifier)->first()?->user
                ?? User::where('username', $identifier)->first();
        } elseif (str_starts_with(strtoupper($identifier), 'NIO-')) {
            $user = Ortu::where('nio', $identifier)->first()?->user
                ?? User::where('username', $identifier)->first();
        } elseif (str_starts_with(strtoupper($identifier), 'NIA-')) {
            $user = AkademikStaff::where('nia', $identifier)->first()?->user
                ?? User::where('username', $identifier)->first();
        } else {
            $user = User::where('username', $identifier)->first();
        }

        if (! $user) {
            $this->addError('identifier', 'Identitas atau password salah.');
            return;
        }

        // Bypass password untuk super_admin di local
        if (app()->environment('local') && $user->hasRole('super_admin')) {
            Auth::login($user);
        } elseif (! Auth::attempt(['email' => $user->email, 'password' => $this->password])) {
            $this->addError('identifier', 'Identitas atau password salah.');
            return;
        }

        session()->regenerate();

        return redirect()->to(PanelResolver::redirectUrl(auth()->user()));
    }

    protected function isSuperAdminIdentifier(): bool
    {
        $identifier = trim($this->identifier);
        if (! filter_var($identifier, FILTER_VALIDATE_EMAIL)) {
            return false;
        }
        $user = User::where('email', $identifier)->first();
        return $user?->hasRole('super_admin') ?? false;
    }

    public function render()
    {
        return view('livewire.auth.login-page')
            ->layout('welcome');
    }
}