<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() === 'fa' ? 'rtl' : 'ltr' }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield('title', config('app.name'))</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewireStyles
        <script>
            (function () {
                const savedTheme = localStorage.getItem('theme');
                const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
                const shouldUseDark = savedTheme ? savedTheme === 'dark' : prefersDark;

                if (shouldUseDark) {
                    document.documentElement.classList.add('dark');
                } else {
                    document.documentElement.classList.remove('dark');
                }
            })();
        </script>
    </head>
    <body class="min-h-screen bg-stone-100 text-zinc-900 antialiased transition-colors dark:bg-zinc-950 dark:text-zinc-100">
        <header class="border-b border-zinc-900/10 bg-stone-100/80 backdrop-blur dark:border-zinc-100/10 dark:bg-zinc-950/80">
            <div class="mx-auto flex w-full max-w-6xl items-center justify-between gap-4 px-4 py-4 sm:px-6 lg:px-8">
                <a href="{{ route('home') }}" wire:navigate class="text-base font-semibold tracking-tight">{{ __('site.brand') }}</a>

                <nav class="flex flex-wrap items-center gap-2 text-sm">
                    <a href="{{ route('home') }}" wire:navigate @class([
                        'rounded-full px-3 py-1.5 transition',
                        'bg-zinc-900 text-white dark:bg-zinc-100 dark:text-zinc-900' => request()->routeIs('home'),
                        'text-zinc-700 hover:bg-zinc-900/5 dark:text-zinc-300 dark:hover:bg-zinc-100/10' => ! request()->routeIs('home'),
                    ]) @if (request()->routeIs('home')) aria-current="page" @endif>{{ __('site.nav.home') }}</a>
                    <a href="{{ route('portfolio') }}" wire:navigate @class([
                        'rounded-full px-3 py-1.5 transition',
                        'bg-zinc-900 text-white dark:bg-zinc-100 dark:text-zinc-900' => request()->routeIs('portfolio'),
                        'text-zinc-700 hover:bg-zinc-900/5 dark:text-zinc-300 dark:hover:bg-zinc-100/10' => ! request()->routeIs('portfolio'),
                    ]) @if (request()->routeIs('portfolio')) aria-current="page" @endif>{{ __('site.nav.portfolio') }}</a>
                    <a href="{{ route('about') }}" wire:navigate @class([
                        'rounded-full px-3 py-1.5 transition',
                        'bg-zinc-900 text-white dark:bg-zinc-100 dark:text-zinc-900' => request()->routeIs('about'),
                        'text-zinc-700 hover:bg-zinc-900/5 dark:text-zinc-300 dark:hover:bg-zinc-100/10' => ! request()->routeIs('about'),
                    ]) @if (request()->routeIs('about')) aria-current="page" @endif>{{ __('site.nav.about') }}</a>
                    <a href="{{ route('resume') }}" wire:navigate @class([
                        'rounded-full px-3 py-1.5 transition',
                        'bg-zinc-900 text-white dark:bg-zinc-100 dark:text-zinc-900' => request()->routeIs('resume'),
                        'text-zinc-700 hover:bg-zinc-900/5 dark:text-zinc-300 dark:hover:bg-zinc-100/10' => ! request()->routeIs('resume'),
                    ]) @if (request()->routeIs('resume')) aria-current="page" @endif>{{ __('site.nav.resume') }}</a>
                    <a href="{{ route('services') }}" wire:navigate @class([
                        'rounded-full px-3 py-1.5 transition',
                        'bg-zinc-900 text-white dark:bg-zinc-100 dark:text-zinc-900' => request()->routeIs('services'),
                        'text-zinc-700 hover:bg-zinc-900/5 dark:text-zinc-300 dark:hover:bg-zinc-100/10' => ! request()->routeIs('services'),
                    ]) @if (request()->routeIs('services')) aria-current="page" @endif>{{ __('site.nav.services') }}</a>
                    <a href="{{ route('contact') }}" wire:navigate @class([
                        'rounded-full px-3 py-1.5 transition',
                        'bg-zinc-900 text-white dark:bg-zinc-100 dark:text-zinc-900' => request()->routeIs('contact'),
                        'text-zinc-700 hover:bg-zinc-900/5 dark:text-zinc-300 dark:hover:bg-zinc-100/10' => ! request()->routeIs('contact'),
                    ]) @if (request()->routeIs('contact')) aria-current="page" @endif>{{ __('site.nav.contact') }}</a>
                </nav>

                <div class="flex items-center gap-2">
                    <a
                        href="{{ route('locale.switch', app()->getLocale() === 'en' ? 'fa' : 'en') }}"
                        class="rounded-full border border-zinc-900/15 px-3 py-1.5 text-sm font-medium transition hover:border-zinc-900/30 dark:border-zinc-100/20 dark:hover:border-zinc-100/40"
                    >
                        {{ app()->getLocale() === 'en' ? __('site.language.fa') : __('site.language.en') }}
                    </a>
                    <button
                        type="button"
                        data-theme-toggle
                        class="rounded-full border border-zinc-900/15 px-3 py-1.5 text-sm font-medium transition hover:border-zinc-900/30 dark:border-zinc-100/20 dark:hover:border-zinc-100/40"
                    >
                        {{ __('site.theme') }}
                    </button>
                </div>
            </div>
        </header>

        <main class="mx-auto w-full max-w-6xl px-4 py-12 sm:px-6 lg:px-8">
            @yield('content')
        </main>

        <footer class="border-t border-zinc-900/10 py-8 dark:border-zinc-100/10">
            <div class="mx-auto flex w-full max-w-6xl flex-col gap-2 px-4 text-sm text-zinc-600 sm:px-6 lg:px-8 dark:text-zinc-400">
                <p>{{ __('site.footer.line1') }}</p>
                <p>{{ __('site.footer.line2') }}</p>
            </div>
        </footer>

        @livewireScripts
    </body>
</html>
