@extends('layouts.app')

@section('title', $title)

@section('content')
    <section class="space-y-6">
        <div>
            <h1 class="text-3xl font-semibold tracking-tight sm:text-4xl">{{ $heading }}</h1>
            <p class="mt-3 max-w-2xl text-zinc-600 dark:text-zinc-300">{{ $description }}</p>
        </div>

        <div class="rounded-2xl border border-zinc-900/10 bg-white p-6 shadow-sm dark:border-zinc-100/10 dark:bg-zinc-900">
            <p class="text-sm text-zinc-600 dark:text-zinc-300">{{ __('site.page.contact.phase5_note') }}</p>
            <a href="mailto:hello@example.com" class="mt-4 inline-flex rounded-full border border-zinc-900/20 px-5 py-2.5 text-sm font-semibold transition hover:bg-zinc-900 hover:text-white dark:border-zinc-100/20 dark:hover:bg-zinc-100 dark:hover:text-zinc-900">
                hello@example.com
            </a>
        </div>
    </section>
@endsection
