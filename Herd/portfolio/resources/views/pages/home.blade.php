@extends('layouts.app')

@section('title', $title)

@section('content')
    <section class="rounded-3xl bg-[#e8ddcf] p-8 shadow-sm ring-1 ring-zinc-900/5 sm:p-12 dark:bg-zinc-900 dark:ring-zinc-100/10">
        <p class="text-sm font-semibold uppercase tracking-[0.16em] text-zinc-600 dark:text-zinc-300">{{ __('site.home.kicker') }}</p>
        <h1 class="mt-4 max-w-3xl text-3xl font-semibold tracking-tight text-zinc-900 sm:text-5xl dark:text-zinc-100">{{ $heading }}</h1>
        <p class="mt-4 max-w-2xl text-lg leading-relaxed text-zinc-700 dark:text-zinc-300">{{ $description }}</p>
        <div class="mt-8 flex flex-wrap items-center gap-3">
            <a href="{{ route('services') }}" wire:navigate class="inline-flex items-center gap-2 rounded-full bg-amber-400 px-6 py-3 text-base font-semibold text-zinc-900 transition hover:bg-amber-300">
                {{ __('site.home.cta_primary') }}
                <span class="inline-flex h-7 w-7 items-center justify-center rounded-full bg-zinc-900 text-zinc-100">→</span>
            </a>
            <a href="{{ route('contact') }}" wire:navigate class="inline-flex items-center gap-2 rounded-full bg-fuchsia-200 px-6 py-3 text-base font-medium text-zinc-900 transition hover:bg-fuchsia-300 dark:bg-fuchsia-300 dark:hover:bg-fuchsia-200">
                {{ __('site.home.cta_secondary') }} →
            </a>
        </div>
    </section>

    <section class="mt-8 rounded-2xl border border-zinc-900/10 bg-white p-6 dark:border-zinc-100/10 dark:bg-zinc-900">
        <h2 class="text-lg font-semibold">{{ __('site.home.stack_title') }}</h2>
        <div class="mt-4 flex flex-wrap gap-2">
            <span class="rounded-full bg-zinc-900 px-3 py-1 text-xs font-medium text-white dark:bg-zinc-100 dark:text-zinc-900">Laravel 13</span>
            <span class="rounded-full bg-zinc-900 px-3 py-1 text-xs font-medium text-white dark:bg-zinc-100 dark:text-zinc-900">Livewire 4</span>
            <span class="rounded-full bg-zinc-900 px-3 py-1 text-xs font-medium text-white dark:bg-zinc-100 dark:text-zinc-900">Filament 5</span>
            <span class="rounded-full bg-zinc-900 px-3 py-1 text-xs font-medium text-white dark:bg-zinc-100 dark:text-zinc-900">Tailwind CSS v4</span>
            <span class="rounded-full bg-zinc-900 px-3 py-1 text-xs font-medium text-white dark:bg-zinc-100 dark:text-zinc-900">Product UX</span>
        </div>
    </section>

    @if ($featuredProjects->isNotEmpty())
        <section class="mt-8 space-y-4">
            <div class="flex items-center justify-between">
                <h2 class="text-2xl font-semibold tracking-tight">{{ __('site.home.featured_title') }}</h2>
                <a href="{{ route('portfolio') }}" wire:navigate class="text-sm font-medium text-zinc-600 hover:text-zinc-900 dark:text-zinc-300 dark:hover:text-zinc-100">{{ __('site.home.view_all_projects') }} →</a>
            </div>
            <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3">
                @foreach ($featuredProjects as $project)
                    <article class="rounded-2xl border border-zinc-900/10 bg-white p-5 shadow-sm dark:border-zinc-100/10 dark:bg-zinc-900">
                        <h3 class="text-lg font-semibold">{{ $project->title }}</h3>
                        <p class="mt-2 text-sm text-zinc-600 dark:text-zinc-300">{{ $project->summary }}</p>
                    </article>
                @endforeach
            </div>
        </section>
    @endif

    <section class="mt-8">
        <h2 class="text-2xl font-semibold tracking-tight">{{ __('site.home.services_snapshot') }}</h2>
        <div class="mt-4 grid grid-cols-1 gap-4 md:grid-cols-3">
            <a href="{{ route('services') }}" wire:navigate class="rounded-2xl border border-zinc-900/10 bg-white p-5 shadow-sm transition hover:-translate-y-0.5 dark:border-zinc-100/10 dark:bg-zinc-900">
                <h3 class="font-semibold">{{ __('site.services.cards.website.title') }}</h3>
                <p class="mt-2 text-sm text-zinc-600 dark:text-zinc-300">{{ __('site.home.services.website_desc') }}</p>
            </a>
            <a href="{{ route('services') }}" wire:navigate class="rounded-2xl border border-zinc-900/10 bg-white p-5 shadow-sm transition hover:-translate-y-0.5 dark:border-zinc-100/10 dark:bg-zinc-900">
                <h3 class="font-semibold">{{ __('site.services.cards.webapp.title') }}</h3>
                <p class="mt-2 text-sm text-zinc-600 dark:text-zinc-300">{{ __('site.home.services.webapp_desc') }}</p>
            </a>
            <a href="{{ route('contact') }}" wire:navigate class="rounded-2xl border border-zinc-900/10 bg-white p-5 shadow-sm transition hover:-translate-y-0.5 dark:border-zinc-100/10 dark:bg-zinc-900">
                <h3 class="font-semibold">{{ __('site.services.cards.support.title') }}</h3>
                <p class="mt-2 text-sm text-zinc-600 dark:text-zinc-300">{{ __('site.home.services.support_desc') }}</p>
            </a>
        </div>
    </section>

    <section class="mt-8 rounded-2xl border border-zinc-900/10 bg-zinc-900 p-8 text-zinc-100 dark:border-zinc-100/10 dark:bg-zinc-100 dark:text-zinc-900">
        <h2 class="text-2xl font-semibold">{{ __('site.home.bottom_cta_title') }}</h2>
        <p class="mt-3 max-w-2xl text-sm sm:text-base">{{ __('site.home.bottom_cta_description') }}</p>
        <div class="mt-5 flex flex-wrap gap-3">
            <a href="{{ route('contact') }}" wire:navigate class="rounded-full bg-white px-5 py-2.5 text-sm font-semibold text-zinc-900 dark:bg-zinc-900 dark:text-zinc-100">{{ __('site.home.start_project') }}</a>
            <a href="{{ route('portfolio') }}" wire:navigate class="rounded-full border border-zinc-100/30 px-5 py-2.5 text-sm font-semibold dark:border-zinc-900/30">{{ __('site.home.see_portfolio') }}</a>
        </div>
    </section>
@endsection
