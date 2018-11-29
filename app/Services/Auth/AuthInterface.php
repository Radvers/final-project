<?php
/**
 * Created by PhpStorm.
 * User: Vitaliy
 * Date: 29.11.2018
 * Time: 10:46
 */

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