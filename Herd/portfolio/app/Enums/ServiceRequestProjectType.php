<?php

namespace App\Enums;

enum ServiceRequestProjectType: string
{
    case WebsiteDesignDevelopment = 'website-design-development';
    case CustomWebApp = 'custom-web-app';
    case MaintenanceSupport = 'maintenance-support';
}
