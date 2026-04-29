@extends('layouts.app')

@section('title', $title)

@section('content')
    <section class="grid grid-cols-1 gap-8 lg:grid-cols-3">
        <div class="lg:col-span-2 space-y-6">
            <div>
                <h1 class="text-3xl font-semibold tracking-tight sm:text-4xl">{{ $heading }}</h1>
                <p class="mt-4 max-w-2xl text-zinc-600 dark:text-zinc-300">{{ $description }}</p>
            </div>
            <article class="rounded-2xl border border-zinc-900/10 bg-white p-6 shadow-sm dark:border-zinc-100/10 dark:bg-zinc-900">
                <h2 class="text-xl font-semibold">{{ __('site.about.bio_title') }}</h2>
                <p class="mt-3 text-sm leading-relaxed text-zinc-600 dark:text-zinc-300">
                    {{ __('site.about.bio_text') }}
                </p>
            </article>
        </div>

        <aside class="space-y-4">
            <div class="rounded-2xl border border-zinc-900/10 bg-white p-5 shadow-sm dark:border-zinc-100/10 dark:bg-zinc-900">
                <h2 class="text-sm font-semibold uppercase tracking-wider text-zinc-500 dark:text-zinc-400">{{ __('site.about.avatar') }}</h2>
                <div class="mt-4 flex h-28 w-28 items-center justify-center rounded-full bg-[#e8ddcf] text-2xl font-semibold text-zinc-900 dark:bg-zinc-800 dark:text-zinc-100">
                    AR
                </div>
            </div>
            <div class="rounded-2xl border border-zinc-900/10 bg-white p-5 shadow-sm dark:border-zinc-100/10 dark:bg-zinc-900">
                <h2 class="text-sm font-semibold uppercase tracking-wider text-zinc-500 dark:text-zinc-400">{{ __('site.about.skills') }}</h2>
                <div class="mt-3 space-y-3 text-sm">
                    <div>
                        <p class="font-medium">{{ __('site.about.backend') }}</p>
                        <p class="text-zinc-600 dark:text-zinc-300">{{ __('site.about.backend_text') }}</p>
                    </div>
                    <div>
                        <p class="font-medium">{{ __('site.about.frontend') }}</p>
                        <p class="text-zinc-600 dark:text-zinc-300">{{ __('site.about.frontend_text') }}</p>
                    </div>
                    <div>
                        <p class="font-medium">{{ __('site.about.tooling') }}</p>
                        <p class="text-zinc-600 dark:text-zinc-300">{{ __('site.about.tooling_text') }}</p>
                    </div>
                </div>
            </div>
        </aside>
    </section>

    <section class="mt-8 rounded-2xl border border-zinc-900/10 bg-white p-6 shadow-sm dark:border-zinc-100/10 dark:bg-zinc-900">
        <h2 class="text-xl font-semibold">{{ __('site.about.timeline_title') }}</h2>
        <ol class="mt-5 space-y-4 text-sm">
            <li class="border-l-2 border-amber-400 pl-4">
                <p class="font-medium">{{ __('site.about.timeline.0.title') }}</p>
                <p class="text-zinc-600 dark:text-zinc-300">{{ __('site.about.timeline.0.text') }}</p>
            </li>
            <li class="border-l-2 border-fuchsia-300 pl-4">
                <p class="font-medium">{{ __('site.about.timeline.1.title') }}</p>
                <p class="text-zinc-600 dark:text-zinc-300">{{ __('site.about.timeline.1.text') }}</p>
            </li>
            <li class="border-l-2 border-zinc-300 pl-4 dark:border-zinc-700">
                <p class="font-medium">{{ __('site.about.timeline.2.title') }}</p>
                <p class="text-zinc-600 dark:text-zinc-300">{{ __('site.about.timeline.2.text') }}</p>
            </li>
        </ol>
    </section>
@endsection
