<?php

namespace App\Services\Interfaces\Auth;

interface LoginInterface
{
    /**
     * @param string $email
     * @param string $password
     * @param bool $remember
     * @return bool|array
     */
    public function login(string $email, string $password, bool $remember = false): bool|array;
}
