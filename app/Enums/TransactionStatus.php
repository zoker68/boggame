<?php

namespace App\Enums;

enum TransactionStatus: string
{
    case PROCESSED = 'processed';
    case FAILED = 'failed';
}
