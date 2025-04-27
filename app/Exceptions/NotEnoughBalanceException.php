<?php

namespace App\Exceptions;

use Exception;

class NotEnoughBalanceException extends Exception
{
    public function __construct()
    {
        parent::__construct('Not enough balance', 400);
    }
}
