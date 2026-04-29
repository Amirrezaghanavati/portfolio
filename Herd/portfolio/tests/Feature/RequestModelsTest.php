<?php

use App\Enums\ContactRequestStatus;
use App\Enums\ServiceRequestBudgetRange;
use App\Enums\ServiceRequestProjectType;
use App\Enums\ServiceRequestStatus;
use App\Models\ContactRequest;
use App\Models\ServiceRequest;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('service request defaults to new status', function () {
    $request = ServiceRequest::factory()->create();

    expect($request->status)->toBe(ServiceRequestStatus::New);
});

test('service request casts string columns to enums', function () {
    $request = ServiceRequest::factory()->create();

    expect($request->status)->toBeInstanceOf(ServiceRequestStatus::class);
    expect($request->project_type)->toBeInstanceOf(ServiceRequestProjectType::class);
    expect($request->budget_range)->toBeInstanceOf(ServiceRequestBudgetRange::class);
});

test('contact request defaults to new status', function () {
    $request = ContactRequest::factory()->create();

    expect($request->status)->toBe(ContactRequestStatus::New);
});

test('contact request casts status to enum', function () {
    $request = ContactRequest::factory()->create();

    expect($request->status)->toBeInstanceOf(ContactRequestStatus::class);
});
