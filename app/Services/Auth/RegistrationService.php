<?php

namespace App\Services\Auth;

use App\Models\User;
use App\Services\Interfaces\Auth\RegistrationInterface;
use Illuminate\Support\Facades\Hash;

class RegistrationService implements RegistrationInterface
{
    /**
     * @param string $name
     * @param string $email
     * @param string $password
     * @return array
     */
    public function register(string $name, string $email, string $password): array
    {
        $user = User::create([
            'name'      => $name,
            'email'     => $email,
            'password'  => Hash::make($password),
        ]);

        $success['token'] = $user->createToken(config('app.name'))->plainTextToken;
        $success['name'] = $user->name;

        return $success;
    }
}
