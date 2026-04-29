<?php

namespace App\Enums;

enum ContactRequestStatus: string
{
    case New = 'new';
    case Read = 'read';
    case Replied = 'replied';
}
