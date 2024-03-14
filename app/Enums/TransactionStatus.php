<?php

namespace App\Enums;

enum TransactionStatus: string
{
    // For previous maintenances
    case NEW = 'NEW';
    case PROCESSING = 'PROCESSING';
    case COMPLETED = 'COMPLETED';
    case FAILED = 'FAILED';
}
