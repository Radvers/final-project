<?php

namespace App\Services\Auth;

use Illuminate\Support\Facades\Auth;

/**
 * Class Authenticate
 * @package App\Services\Auth
 */
class Authenticate implements AuthInterface
{
    /**
     * @return mixed
     */
    public function getUser()
    {
        return Auth::user();
    }

    /**
     * @return mixed
     */
    public function check()
    {
        return Auth::check();
    }
}