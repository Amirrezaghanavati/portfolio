@extends('layouts.app')

@section('title', $title)

@section('content')
    <section class="space-y-8">
        <div>
            <h1 class="text-3xl font-semibold tracking-tight sm:text-4xl">{{ $heading }}</h1>
            <p class="mt-3 max-w-2xl text-zinc-600 dark:text-zinc-300">{{ $description }}</p>
        </div>

        <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
            <article class="rounded-2xl border border-zinc-900/10 bg-white p-5 shadow-sm dark:border-zinc-100/10 dark:bg-zinc-900">
                <h2 class="text-lg font-semibold">{{ __('site.services.cards.website.title') }}</h2>
                <p class="mt-2 text-sm text-zinc-600 dark:text-zinc-300">{{ __('site.services.cards.website.description') }}</p>
            </article>
            <article class="rounded-2xl border border-zinc-900/10 bg-white p-5 shadow-sm dark:border-zinc-100/10 dark:bg-zinc-900">
                <h2 class="text-lg font-semibold">{{ __('site.services.cards.webapp.title') }}</h2>
                <p class="mt-2 text-sm text-zinc-600 dark:text-zinc-300">{{ __('site.services.cards.webapp.description') }}</p>
            </article>
            <article class="rounded-2xl border border-zinc-900/10 bg-white p-5 shadow-sm dark:border-zinc-100/10 dark:bg-zinc-900">
                <h2 class="text-lg font-semibold">{{ __('site.services.cards.support.title') }}</h2>
                <p class="mt-2 text-sm text-zinc-600 dark:text-zinc-300">{{ __('site.services.cards.support.description') }}</p>
            </article>
        </div>
    </section>
@endsection
