<?php

namespace App\Exceptions;

use Exception;

class TransactionDuplicateException extends Exception
{
    public function __construct(protected string $transactionId)
    {
        parent::__construct();
    }

    public function getTransactionId(): string
    {
        return $this->transactionId;
    }
}
