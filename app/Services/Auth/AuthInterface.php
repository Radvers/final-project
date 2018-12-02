<?php

namespace App\Services\Auth;

interface AuthInterface
{
    /**
     * @return mixed
     */
    public function getUser();

    /**
     * @return mixed
     */
    public function check();
}