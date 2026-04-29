@extends('layouts.app')

@section('title', $title)

@section('content')
    <section class="space-y-8" x-data="{ openProjectId: null }">
        <div>
            <h1 class="text-3xl font-semibold tracking-tight sm:text-4xl">{{ $heading }}</h1>
            <p class="mt-3 max-w-2xl text-zinc-600 dark:text-zinc-300">{{ $description }}</p>
        </div>

        <form method="GET" action="{{ route('portfolio') }}" class="space-y-4 rounded-2xl border border-zinc-900/10 bg-white p-5 dark:border-zinc-100/10 dark:bg-zinc-900">
            <div class="grid gap-3 md:grid-cols-[2fr,1fr]">
                <input
                    type="text"
                    name="search"
                    value="{{ $search }}"
                    placeholder="{{ __('site.portfolio.search_placeholder') }}"
                    class="w-full rounded-xl border border-zinc-900/15 bg-white px-3 py-2 text-sm text-zinc-900 outline-none ring-0 transition placeholder:text-zinc-400 focus:border-zinc-900/40 dark:border-zinc-100/20 dark:bg-zinc-950 dark:text-zinc-100 dark:placeholder:text-zinc-500 dark:focus:border-zinc-100/40"
                />
                <button type="submit" class="rounded-xl bg-zinc-900 px-4 py-2 text-sm font-semibold text-zinc-100 transition hover:bg-zinc-700 dark:bg-zinc-100 dark:text-zinc-900 dark:hover:bg-zinc-300">
                    {{ __('site.portfolio.apply_filters') }}
                </button>
            </div>

            @if ($availableTags->isNotEmpty())
                <div class="flex flex-wrap gap-2">
                    @foreach ($availableTags as $tag)
                        <label class="inline-flex items-center gap-2 rounded-full border px-3 py-1.5 text-xs font-medium transition {{ in_array($tag->name, $selectedTags, true) ? 'border-zinc-900 bg-zinc-900 text-zinc-100 dark:border-zinc-100 dark:bg-zinc-100 dark:text-zinc-900' : 'border-zinc-900/20 text-zinc-600 hover:border-zinc-900/40 dark:border-zinc-100/20 dark:text-zinc-300 dark:hover:border-zinc-100/40' }}">
                            <input type="checkbox" name="tags[]" value="{{ $tag->name }}" @checked(in_array($tag->name, $selectedTags, true)) class="sr-only" />
                            <span>{{ $tag->name }}</span>
                        </label>
                    @endforeach
                </div>
            @endif

            @if ($search !== '' || $selectedTags !== [])
                <a href="{{ route('portfolio') }}" wire:navigate class="inline-flex text-sm font-medium text-zinc-600 hover:text-zinc-900 dark:text-zinc-300 dark:hover:text-zinc-100">
                    {{ __('site.portfolio.clear_filters') }}
                </a>
            @endif
        </form>

        @if ($projects->isEmpty())
            <div class="rounded-2xl border border-dashed border-zinc-900/20 bg-white p-8 text-center dark:border-zinc-100/20 dark:bg-zinc-900">
                <p class="text-base font-medium">{{ __('site.portfolio.empty_title') }}</p>
                <p class="mt-2 text-sm text-zinc-600 dark:text-zinc-300">{{ __('site.portfolio.empty_description') }}</p>
            </div>
        @else
            <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3">
                @foreach ($projects as $project)
                    <article class="rounded-2xl border border-zinc-900/10 bg-white p-5 shadow-sm transition hover:-translate-y-0.5 hover:shadow-md dark:border-zinc-100/10 dark:bg-zinc-900">
                        <h2 class="text-lg font-semibold">{{ $project->title }}</h2>
                        <p class="mt-2 text-sm text-zinc-600 dark:text-zinc-300">{{ $project->summary }}</p>
                        @if ($project->tags->isNotEmpty())
                            <div class="mt-3 flex flex-wrap gap-1.5">
                                @foreach ($project->tags as $tag)
                                    <span class="rounded-full border border-zinc-900/20 px-2 py-0.5 text-xs text-zinc-600 dark:border-zinc-100/20 dark:text-zinc-300">{{ $tag->name }}</span>
                                @endforeach
                            </div>
                        @endif
                        <button
                            type="button"
                            class="mt-4 text-sm font-medium text-zinc-700 underline decoration-zinc-400 underline-offset-4 transition hover:text-zinc-900 dark:text-zinc-300 dark:decoration-zinc-600 dark:hover:text-zinc-100"
                            @click="openProjectId = {{ $project->id }}"
                        >
                            {{ __('site.portfolio.view_details') }}
                        </button>
                    </article>
                @endforeach
            </div>

            <div class="pt-2">
                {{ $projects->links() }}
            </div>

            @foreach ($projects as $project)
                <div
                    x-show="openProjectId === {{ $project->id }}"
                    x-cloak
                    @keydown.escape.window="openProjectId = null"
                    class="fixed inset-0 z-50 flex items-center justify-center bg-zinc-950/70 p-4"
                    role="dialog"
                    aria-modal="true"
                    aria-labelledby="project-modal-title-{{ $project->id }}"
                    @click.self="openProjectId = null"
                >
                    <div class="w-full max-w-2xl rounded-2xl border border-zinc-900/10 bg-white p-6 shadow-xl dark:border-zinc-100/10 dark:bg-zinc-900">
                        <div class="flex items-start justify-between gap-4">
                            <h3 id="project-modal-title-{{ $project->id }}" class="text-xl font-semibold">{{ $project->title }}</h3>
                            <button type="button" class="rounded-full px-2 py-1 text-sm text-zinc-500 transition hover:bg-zinc-900/5 hover:text-zinc-900 dark:text-zinc-400 dark:hover:bg-zinc-100/10 dark:hover:text-zinc-100" @click="openProjectId = null">{{ __('site.portfolio.close') }}</button>
                        </div>
                        <p class="mt-4 text-sm leading-relaxed text-zinc-600 dark:text-zinc-300">{{ $project->description }}</p>
                        <div class="mt-5 flex flex-wrap gap-2">
                            @if ($project->live_url)
                                <a href="{{ $project->live_url }}" target="_blank" rel="noreferrer noopener" class="rounded-full bg-zinc-900 px-4 py-2 text-sm font-semibold text-zinc-100 dark:bg-zinc-100 dark:text-zinc-900">{{ __('site.portfolio.live_preview') }}</a>
                            @endif
                            @if ($project->repo_url)
                                <a href="{{ $project->repo_url }}" target="_blank" rel="noreferrer noopener" class="rounded-full border border-zinc-900/20 px-4 py-2 text-sm font-semibold text-zinc-700 dark:border-zinc-100/20 dark:text-zinc-200">{{ __('site.portfolio.source_code') }}</a>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </section>
@endsection
