<?php

use App\Enums\ContactRequestStatus;
use App\Enums\ServiceRequestStatus;
use App\Models\ContactRequest;
use App\Models\Project;
use App\Models\ServiceRequest;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('project factory creates a persisted record', function () {
    $project = Project::factory()->create();

    expect($project->exists)->toBeTrue();
    expect(Project::query()->whereKey($project->getKey())->exists())->toBeTrue();
});

test('service request factory creates records with expected status states', function () {
    $newRequest = ServiceRequest::factory()->create();
    $inReviewRequest = ServiceRequest::factory()->inReview()->create();
    $repliedRequest = ServiceRequest::factory()->replied()->create();
    $closedRequest = ServiceRequest::factory()->closed()->create();

    expect($newRequest->status)->toBe(ServiceRequestStatus::New);
    expect($inReviewRequest->status)->toBe(ServiceRequestStatus::InReview);
    expect($repliedRequest->status)->toBe(ServiceRequestStatus::Replied);
    expect($closedRequest->status)->toBe(ServiceRequestStatus::Closed);
});

test('contact request factory creates records with expected status states', function () {
    $newRequest = ContactRequest::factory()->create();
    $readRequest = ContactRequest::factory()->read()->create();
    $repliedRequest = ContactRequest::factory()->replied()->create();

    expect($newRequest->status)->toBe(ContactRequestStatus::New);
    expect($readRequest->status)->toBe(ContactRequestStatus::Read);
    expect($repliedRequest->status)->toBe(ContactRequestStatus::Replied);
});
