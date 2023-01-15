<?php

namespace App\Repositories\Auth;

use LaravelEasyRepository\Repository;

interface AuthRepository extends Repository
{

    public function loginFunction($request);
    public function logOutFunction();
}
