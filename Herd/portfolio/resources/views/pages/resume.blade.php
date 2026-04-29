@extends('layouts.app')

@section('title', $title)

@section('content')
    <section class="space-y-6">
        <div>
            <h1 class="text-3xl font-semibold tracking-tight sm:text-4xl">{{ __('site.page.resume.title') }}</h1>
            <p class="mt-3 max-w-2xl text-zinc-600 dark:text-zinc-300">{{ $description }}</p>
        </div>

        @if ($resumeUrl)
            <div class="overflow-hidden rounded-2xl border border-zinc-900/10 bg-white shadow-sm dark:border-zinc-100/10 dark:bg-zinc-900">
                <iframe
                    src="{{ $resumeUrl }}"
                    title="{{ __('site.page.resume.pdf_title') }}"
                    class="h-[720px] w-full"
                ></iframe>
            </div>
        @else
            <div class="rounded-2xl border border-dashed border-zinc-900/20 bg-white p-8 text-center dark:border-zinc-100/20 dark:bg-zinc-900">
                <p class="text-zinc-600 dark:text-zinc-300">{{ __('site.page.resume.unavailable') }}</p>
            </div>
        @endif

        <a href="{{ route('resume.download') }}" class="inline-flex rounded-full bg-zinc-900 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-zinc-700 dark:bg-zinc-100 dark:text-zinc-900 dark:hover:bg-zinc-300">
            {{ __('site.page.resume.download') }}
        </a>
    </section>
@endsection
