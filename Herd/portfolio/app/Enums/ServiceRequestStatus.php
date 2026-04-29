<?php

namespace App\Enums;

enum ServiceRequestStatus: string
{
    case New = 'new';
    case InReview = 'in_review';
    case Replied = 'replied';
    case Closed = 'closed';
}
