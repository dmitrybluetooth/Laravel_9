<?php

namespace App\Services\Interfaces\Auth;

interface RegistrationInterface
{
    /**
     * @param string $name
     * @param string $email
     * @param string $password
     * @return array
     */
    public function register(string $name, string $email, string $password): array;
}
