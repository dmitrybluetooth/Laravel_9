<?php

namespace App\Services\Auth;

use App\Services\Interfaces\Auth\LoginInterface;
use Illuminate\Support\Facades\Auth;

class LoginService implements LoginInterface
{
    /**
     * @param string $email
     * @param string $password
     * @param bool $remember
     * @return bool|array
     */
    public function login(string $email, string $password, bool $remember = false): bool|array
    {
        if (Auth::attempt(['email' => $email, 'password' => $password], $remember)) {
            $user = Auth::user();
            $success['token'] =  $user->createToken(config('app.name'))->plainTextToken;
            $success['userId'] = $user->id;

            return $success;
        }

        return false;
    }

    public function logout(): bool
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return true;
    }
}
