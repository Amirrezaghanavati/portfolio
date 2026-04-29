<?php

namespace App\Enums;

enum ServiceRequestBudgetRange: string
{
    case Under2k = 'under-2k';
    case Between2kAnd5k = '2k-5k';
    case Between5kAnd10k = '5k-10k';
    case Plus10k = '10k-plus';
}
