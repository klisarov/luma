@props(['title' => null])

<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" class="h-full">
<head>
    <meta charset="utf-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1"
    >

    <meta
        name="csrf-token"
        content="{{ csrf_token() }}"
    >

    {{-- Luma browser / PWA branding --}}
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}">
    <link rel="manifest" href="{{ asset('site.webmanifest') }}">

    <meta name="theme-color" content="#0B0F1A">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="apple-mobile-web-app-title" content="Luma">

    <title>{{ $title ?? 'Luma' }} — Luma</title>

    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])

    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
</head>

<body class="min-h-full bg-ink-950 text-paper">

    <div
        x-data="{ mobileMenuOpen: false }"
        @keydown.escape.window="mobileMenuOpen = false"
        class="min-h-screen"
    >

        {{-- ============================================================ --}}
        {{-- MOBILE HEADER --}}
        {{-- ============================================================ --}}

        <header
            class="
                sticky top-0 z-40
                flex h-16 items-center justify-between
                border-b border-ink-700
                bg-ink-950/95 px-4
                backdrop-blur
                md:hidden
            "
        >

            {{-- Logo --}}
            <a
                href="{{ route('dashboard') }}"
                class="inline-flex items-center"
                aria-label="{{ __('luma.nav.home') }}"
            >
                <img
                    src="{{ asset('images/luma-logo.png') }}"
                    alt="Luma"
                    class="h-9 w-auto max-w-[150px] object-contain"
                >
            </a>


            {{-- Hamburger --}}
            <button
                type="button"
                @click="mobileMenuOpen = true"
                class="
                    flex h-10 w-10
                    items-center justify-center
                    rounded-lg
                    border border-ink-700
                    bg-ink-900
                    text-paper
                    transition
                    hover:border-ink-600
                    hover:bg-ink-800
                "
                aria-label="{{ __('luma.nav.open_navigation') }}"
            >
                <svg
                    class="h-5 w-5"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.8"
                >
                    <path
                        stroke-linecap="round"
                        d="M4 7h16M4 12h16M4 17h16"
                    />
                </svg>
            </button>

        </header>


        {{-- ============================================================ --}}
        {{-- MOBILE MENU --}}
        {{-- ============================================================ --}}

        <div
            x-show="mobileMenuOpen"
            x-cloak
            class="fixed inset-0 z-50 md:hidden"
            role="dialog"
            aria-modal="true"
        >

            {{-- Backdrop --}}
            <div
                x-show="mobileMenuOpen"
                x-transition:enter="transition-opacity duration-200"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                x-transition:leave="transition-opacity duration-150"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                @click="mobileMenuOpen = false"
                class="
                    absolute inset-0
                    bg-black/60
                    backdrop-blur-sm
                "
            ></div>


            {{-- Menu panel --}}
            <aside
                x-show="mobileMenuOpen"
                x-transition:enter="transition-transform duration-300 ease-out"
                x-transition:enter-start="-translate-x-full"
                x-transition:enter-end="translate-x-0"
                x-transition:leave="transition-transform duration-200 ease-in"
                x-transition:leave-start="translate-x-0"
                x-transition:leave-end="-translate-x-full"
                class="
                    absolute inset-y-0 left-0
                    flex
                    w-[85%] max-w-sm
                    flex-col
                    border-r border-ink-700
                    bg-ink-950
                    shadow-2xl
                "
            >

                {{-- Mobile menu header --}}
                <div
                    class="
                        flex h-16
                        shrink-0
                        items-center justify-between
                        border-b border-ink-700
                        px-5
                    "
                >

                    <a
                        href="{{ route('dashboard') }}"
                        @click="mobileMenuOpen = false"
                        class="inline-flex items-center"
                        aria-label="{{ __('luma.nav.home') }}"
                    >
                        <img
                            src="{{ asset('images/luma-logo.png') }}"
                            alt="Luma"
                            class="h-9 w-auto max-w-[150px] object-contain"
                        >
                    </a>


                    <button
                        type="button"
                        @click="mobileMenuOpen = false"
                        class="
                            flex h-9 w-9
                            items-center justify-center
                            rounded-lg
                            text-muted
                            transition
                            hover:bg-ink-800
                            hover:text-paper
                        "
                        aria-label="{{ __('luma.nav.close_navigation') }}"
                    >
                        <svg
                            class="h-5 w-5"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M6 6l12 12M18 6L6 18"
                            />
                        </svg>
                    </button>

                </div>


                {{-- Mobile navigation --}}
                <nav
                    class="
                        flex-1
                        space-y-7
                        overflow-y-auto
                        px-3 py-5
                        scrollbar-none
                    "
                >

                    {{-- Main links --}}
                    <div class="space-y-1">

                        {{-- Today --}}
                        <a
                            href="{{ route('dashboard') }}"
                            @click="mobileMenuOpen = false"
                            class="
                                flex items-center gap-3
                                rounded-lg
                                px-3 py-2.5
                                text-sm font-medium
                                transition

                                {{ request()->routeIs('dashboard')
                                    ? 'bg-ink-700 text-paper'
                                    : 'text-muted hover:bg-ink-800 hover:text-paper'
                                }}
                            "
                        >
                            <svg
                                class="h-5 w-5 shrink-0"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="1.75"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M3 12l9-9 9 9M5 10v10a1 1 0 001 1h4v-6h4v6h4a1 1 0 001-1V10"
                                />
                            </svg>

                            {{ __('luma.nav.today') }}
                        </a>


                        {{-- Work log --}}
                        <a
                            href="{{ route('tasks.work-list') }}"
                            @click="mobileMenuOpen = false"
                            class="
                                flex items-center gap-3
                                rounded-lg
                                px-3 py-2.5
                                text-sm font-medium
                                transition

                                {{ request()->routeIs('tasks.work-list')
                                    ? 'bg-ink-700 text-paper'
                                    : 'text-muted hover:bg-ink-800 hover:text-paper'
                                }}
                            "
                        >
                            <svg
                                class="h-5 w-5 shrink-0"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="1.75"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M3 7a2 2 0 012-2h14a2 2 0 012 2v10a2 2 0 01-2 2H5a2 2 0 01-2-2V7z"
                                />

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M8 5V4a1 1 0 011-1h6a1 1 0 011 1v1"
                                />
                            </svg>

                            {{ __('luma.nav.work_log') }}
                        </a>


                        {{-- Fitness --}}
                        <a
                            href="{{ route('workout-plans.index') }}"
                            @click="mobileMenuOpen = false"
                            class="
                                flex items-center gap-3
                                rounded-lg
                                px-3 py-2.5
                                text-sm font-medium
                                transition

                                {{ request()->routeIs('workout-plans.*')
                                    ? 'bg-ink-700 text-paper'
                                    : 'text-muted hover:bg-ink-800 hover:text-paper'
                                }}
                            "
                        >
                            <svg
                                class="h-5 w-5 shrink-0"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="1.75"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M13 10V3L4 14h7v7l9-11h-7z"
                                />
                            </svg>

                            {{ __('luma.nav.fitness') }}
                        </a>


                        {{-- Calendars --}}
                        <a
                            href="{{ route('calendars.index') }}"
                            @click="mobileMenuOpen = false"
                            class="
                                flex items-center gap-3
                                rounded-lg
                                px-3 py-2.5
                                text-sm font-medium
                                transition

                                {{ request()->routeIs('calendars.*')
                                    ? 'bg-ink-700 text-paper'
                                    : 'text-muted hover:bg-ink-800 hover:text-paper'
                                }}
                            "
                        >
                            <svg
                                class="h-5 w-5 shrink-0"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="1.75"
                            >
                                <rect
                                    x="3"
                                    y="5"
                                    width="18"
                                    height="16"
                                    rx="2"
                                />

                                <path
                                    stroke-linecap="round"
                                    d="M3 10h18M8 3v4M16 3v4"
                                />
                            </svg>

                            {{ __('luma.nav.calendars') }}
                        </a>

                    </div>


                    {{-- ================================================= --}}
                    {{-- MOBILE CATEGORIES --}}
                    {{-- ================================================= --}}

                    <div>

                        <p
                            class="
                                px-3
                                text-xs font-semibold
                                uppercase tracking-wider
                                text-muted/70
                            "
                        >
                            {{ __('luma.nav.categories') }}
                        </p>


                        <div class="mt-2 space-y-0.5">

                            @foreach (auth()->user()->categories as $sidebarCategory)

                                <div
                                    class="
                                        group
                                        flex items-center
                                        rounded-lg
                                        transition

                                        {{ request()->route('category')?->id === $sidebarCategory->id
                                            ? 'bg-ink-700'
                                            : 'hover:bg-ink-800'
                                        }}
                                    "
                                >
                                    <a
                                        href="{{ route('categories.show', $sidebarCategory) }}"
                                        @click="mobileMenuOpen = false"
                                        class="
                                            flex min-w-0 flex-1
                                            items-center justify-between
                                            px-3 py-2.5
                                            text-sm font-medium
                                            transition

                                            {{ request()->route('category')?->id === $sidebarCategory->id
                                                ? 'text-paper'
                                                : 'text-muted group-hover:text-paper'
                                            }}
                                        "
                                    >
                                        <span class="flex min-w-0 items-center gap-2">
                                            <span
                                                class="h-2 w-2 shrink-0 rounded-full"
                                                style="background-color: {{ $sidebarCategory->color ?? '#F5B942' }}"
                                            ></span>

                                            <span class="truncate">
                                                {{ $sidebarCategory->name }}
                                            </span>
                                        </span>

                                        <span class="ml-3 shrink-0 font-mono text-xs text-muted/60">
                                            {{ $sidebarCategory->tasks_count ?? $sidebarCategory->tasks()->count() }}
                                        </span>
                                    </a>

                                    <form
                                        method="POST"
                                        action="{{ route('categories.destroy', $sidebarCategory) }}"
                                        class="shrink-0 pr-2"
                                        onsubmit="return confirm(@js(__('luma.nav.delete_category_confirm', ['category' => $sidebarCategory->name])))"
                                    >
                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="
                                                flex h-8 w-8 items-center justify-center
                                                rounded-lg
                                                text-muted/60
                                                transition
                                                hover:bg-red-500/10
                                                hover:text-red-400
                                            "
                                            aria-label="{{ __('luma.nav.delete_category_aria', ['category' => $sidebarCategory->name]) }}"
                                            title="{{ __('luma.nav.delete_category') }}"
                                        >
                                            <svg
                                                class="h-4 w-4"
                                                viewBox="0 0 24 24"
                                                fill="none"
                                                stroke="currentColor"
                                                stroke-width="1.8"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    d="M4 7h16M9 7V4h6v3m-8 0 1 13h8l1-13M10 11v5m4-5v5"
                                                />
                                            </svg>
                                        </button>
                                    </form>
                                </div>

                            @endforeach


                            {{-- Add category --}}
                            <div
                                x-data="{ open: false }"
                                class="px-1 pt-1"
                            >

                                <button
                                    type="button"
                                    @click="open = !open"
                                    class="
                                        flex w-full
                                        items-center gap-2
                                        rounded-lg
                                        px-2 py-2.5
                                        text-sm text-muted
                                        transition
                                        hover:bg-ink-800
                                        hover:text-paper
                                    "
                                >
                                    <svg
                                        class="h-4 w-4"
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="1.75"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M12 4v16m8-8H4"
                                        />
                                    </svg>

                                    {{ __('luma.nav.new_category') }}
                                </button>


                                <form
                                    x-show="open"
                                    x-cloak
                                    x-transition
                                    method="POST"
                                    action="{{ route('categories.store') }}"
                                    class="mt-2 space-y-2 px-1"
                                >
                                    @csrf

                                    <input
                                        type="text"
                                        name="name"
                                        placeholder="{{ __('luma.nav.category_name') }}"
                                        required
                                        class="
                                            w-full
                                            rounded-lg
                                            border border-ink-600
                                            bg-ink-800
                                            px-3 py-2
                                            text-sm text-paper
                                            placeholder:text-muted/60
                                            focus:border-glow
                                            focus:ring-glow
                                        "
                                    >

                                    <button
                                        type="submit"
                                        class="
                                            w-full
                                            rounded-lg
                                            bg-glow
                                            px-3 py-2
                                            text-sm font-semibold
                                            text-ink-950
                                            transition
                                            hover:brightness-110
                                        "
                                    >
                                        {{ __('luma.nav.add_category') }}
                                    </button>

                                </form>

                            </div>

                        </div>
                    </div>

                </nav>

                <div
                    class="
                        shrink-0
                        border-t border-ink-700
                        px-4 py-3
                    "
                >
                    <x-locale-switcher />
                </div>

                {{-- ===================================================== --}}
                {{-- MOBILE PROFILE / LOGOUT --}}
                {{-- ===================================================== --}}

                <div
                    class="
                        shrink-0
                        border-t border-ink-700
                        p-4
                    "
                >

                    <a
                        href="{{ route('profile.edit') }}"
                        @click="mobileMenuOpen = false"
                        class="
                            mb-3
                            flex items-center gap-3
                            rounded-lg
                            px-2 py-2
                            transition
                            hover:bg-ink-800
                        "
                    >

                        <div
                            class="
                                flex h-9 w-9
                                shrink-0
                                items-center justify-center
                                rounded-full
                                bg-ink-700
                                font-display
                                text-sm font-semibold
                                text-paper
                            "
                        >
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </div>


                        <div class="min-w-0 flex-1">

                            <p
                                class="
                                    truncate
                                    text-sm font-medium
                                    text-paper
                                "
                            >
                                {{ auth()->user()->name }}
                            </p>

                            <p
                                class="
                                    truncate
                                    text-xs
                                    text-muted
                                "
                            >
                                {{ auth()->user()->email }}
                            </p>

                        </div>


                        <svg
                            class="
                                h-4 w-4
                                shrink-0
                                text-muted
                            "
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.75"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M9 18l6-6-6-6"
                            />
                        </svg>

                    </a>


                    <form
                        method="POST"
                        action="{{ route('logout') }}"
                    >
                        @csrf

                        <button
                            type="submit"
                            class="
                                flex w-full
                                items-center gap-2
                                rounded-lg
                                px-2 py-2
                                text-sm text-muted
                                transition
                                hover:bg-ink-800
                                hover:text-paper
                            "
                        >
                            <svg
                                class="h-4 w-4"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="1.75"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M10 17l5-5-5-5M15 12H3"
                                />

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M14 3h5a2 2 0 012 2v14a2 2 0 01-2 2h-5"
                                />
                            </svg>

                            {{ __('luma.nav.logout') }}
                        </button>

                    </form>

                </div>

            </aside>

        </div>


        {{-- ============================================================ --}}
        {{-- FIXED DESKTOP SIDEBAR --}}
        {{-- ============================================================ --}}

        <aside
            class="
                hidden
                border-r border-ink-700
                bg-ink-950

                md:fixed
                md:inset-y-0
                md:left-0
                md:z-30
                md:flex
                md:w-64
                md:flex-col
            "
        >

            {{-- Logo --}}
            <div class="shrink-0 px-5 py-6">

                <a
                    href="{{ route('dashboard') }}"
                    class="inline-flex items-center"
                    aria-label="{{ __('luma.nav.home') }}"
                >
                    <img
                        src="{{ asset('images/luma-logo.png') }}"
                        alt="Luma"
                        class="h-11 w-auto max-w-[190px] object-contain"
                    >
                </a>

            </div>


            {{-- ======================================================== --}}
            {{-- DESKTOP NAVIGATION --}}
            {{-- ======================================================== --}}

            <nav
                class="
                    flex-1
                    space-y-6
                    overflow-y-auto
                    px-3 pb-6
                    scrollbar-none
                "
            >

                {{-- Main links --}}
                <div>

                    {{-- Today --}}
                    <a
                        href="{{ route('dashboard') }}"
                        class="
                            flex items-center gap-2
                            rounded-lg
                            px-3 py-2
                            text-sm font-medium
                            transition

                            {{ request()->routeIs('dashboard')
                                ? 'bg-ink-700 text-paper'
                                : 'text-muted hover:bg-ink-800 hover:text-paper'
                            }}
                        "
                    >
                        <svg
                            class="h-4 w-4 shrink-0"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.75"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M3 12l9-9 9 9M5 10v10a1 1 0 001 1h4v-6h4v6h4a1 1 0 001-1V10"
                            />
                        </svg>

                        {{ __('luma.nav.today') }}
                    </a>


                    {{-- Work log --}}
                    <a
                        href="{{ route('tasks.work-list') }}"
                        class="
                            flex items-center gap-2
                            rounded-lg
                            px-3 py-2
                            text-sm font-medium
                            transition

                            {{ request()->routeIs('tasks.work-list')
                                ? 'bg-ink-700 text-paper'
                                : 'text-muted hover:bg-ink-800 hover:text-paper'
                            }}
                        "
                    >
                        <svg
                            class="h-4 w-4 shrink-0"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.75"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M3 7a2 2 0 012-2h14a2 2 0 012 2v10a2 2 0 01-2 2H5a2 2 0 01-2-2V7z"
                            />

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M8 5V4a1 1 0 011-1h6a1 1 0 011 1v1"
                            />
                        </svg>

                        {{ __('luma.nav.work_log') }}
                    </a>


                    {{-- Fitness --}}
                    <a
                        href="{{ route('workout-plans.index') }}"
                        class="
                            flex items-center gap-2
                            rounded-lg
                            px-3 py-2
                            text-sm font-medium
                            transition

                            {{ request()->routeIs('workout-plans.*')
                                ? 'bg-ink-700 text-paper'
                                : 'text-muted hover:bg-ink-800 hover:text-paper'
                            }}
                        "
                    >
                        <svg
                            class="h-4 w-4 shrink-0"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.75"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M13 10V3L4 14h7v7l9-11h-7z"
                            />
                        </svg>

                        {{ __('luma.nav.fitness') }}
                    </a>


                    {{-- Calendars --}}
                    <a
                        href="{{ route('calendars.index') }}"
                        class="
                            flex items-center gap-2
                            rounded-lg
                            px-3 py-2
                            text-sm font-medium
                            transition

                            {{ request()->routeIs('calendars.*')
                                ? 'bg-ink-700 text-paper'
                                : 'text-muted hover:bg-ink-800 hover:text-paper'
                            }}
                        "
                    >
                        <svg
                            class="h-4 w-4 shrink-0"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.75"
                        >
                            <rect
                                x="3"
                                y="5"
                                width="18"
                                height="16"
                                rx="2"
                            />

                            <path
                                stroke-linecap="round"
                                d="M3 10h18M8 3v4M16 3v4"
                            />
                        </svg>

                        {{ __('luma.nav.calendars') }}
                    </a>

                </div>


                {{-- ==================================================== --}}
                {{-- DESKTOP CATEGORIES --}}
                {{-- ==================================================== --}}

                <div>

                    <p
                        class="
                            px-3
                            text-xs font-semibold
                            uppercase tracking-wider
                            text-muted/70
                        "
                    >
                        {{ __('luma.nav.categories') }}
                    </p>


                    <div class="mt-2 space-y-0.5">

                        @foreach (auth()->user()->categories as $sidebarCategory)

                            <div
                                class="
                                    group
                                    flex items-center
                                    rounded-lg
                                    transition

                                    {{ request()->route('category')?->id === $sidebarCategory->id
                                        ? 'bg-ink-700'
                                        : 'hover:bg-ink-800'
                                    }}
                                "
                            >
                                <a
                                    href="{{ route('categories.show', $sidebarCategory) }}"
                                    class="
                                        flex min-w-0 flex-1
                                        items-center justify-between
                                        px-3 py-2
                                        text-sm font-medium
                                        transition

                                        {{ request()->route('category')?->id === $sidebarCategory->id
                                            ? 'text-paper'
                                            : 'text-muted group-hover:text-paper'
                                        }}
                                    "
                                >
                                    <span class="flex min-w-0 items-center gap-2 truncate">
                                        <span
                                            class="h-2 w-2 shrink-0 rounded-full"
                                            style="background-color: {{ $sidebarCategory->color ?? '#F5B942' }}"
                                        ></span>

                                        <span class="truncate">
                                            {{ $sidebarCategory->name }}
                                        </span>
                                    </span>

                                    <span class="ml-2 shrink-0 font-mono text-xs text-muted/60">
                                        {{ $sidebarCategory->tasks_count ?? $sidebarCategory->tasks()->count() }}
                                    </span>
                                </a>

                                <form
                                    method="POST"
                                    action="{{ route('categories.destroy', $sidebarCategory) }}"
                                    class="shrink-0 pr-1.5"
                                    onsubmit="return confirm(@js(__('luma.nav.delete_category_confirm', ['category' => $sidebarCategory->name])))"
                                >
                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="
                                            flex h-7 w-7 items-center justify-center
                                            rounded-md
                                            text-muted/0
                                            transition
                                            group-hover:text-muted/60
                                            hover:!bg-red-500/10
                                            hover:!text-red-400
                                            focus:text-muted
                                        "
                                        aria-label="{{ __('luma.nav.delete_category_aria', ['category' => $sidebarCategory->name]) }}"
                                        title="{{ __('luma.nav.delete_category') }}"
                                    >
                                        <svg
                                            class="h-3.5 w-3.5"
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-width="1.8"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M4 7h16M9 7V4h6v3m-8 0 1 13h8l1-13M10 11v5m4-5v5"
                                            />
                                        </svg>
                                    </button>
                                </form>
                            </div>

                        @endforeach


                        {{-- New category --}}
                        <div
                            x-data="{ open: false }"
                            class="px-1"
                        >

                            <button
                                type="button"
                                @click="open = !open"
                                class="
                                    mt-1
                                    flex w-full
                                    items-center gap-2
                                    rounded-lg
                                    px-2 py-2
                                    text-sm text-muted
                                    transition
                                    hover:bg-ink-800
                                    hover:text-paper
                                "
                            >
                                <svg
                                    class="h-4 w-4"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="1.75"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M12 4v16m8-8H4"
                                    />
                                </svg>

                                {{ __('luma.nav.new_category') }}
                            </button>


                            <form
                                x-show="open"
                                x-cloak
                                x-transition
                                method="POST"
                                action="{{ route('categories.store') }}"
                                class="mt-1 space-y-2 px-1"
                            >
                                @csrf

                                <input
                                    type="text"
                                    name="name"
                                    placeholder="{{ __('luma.nav.category_name') }}"
                                    required
                                    class="
                                        w-full
                                        rounded-md
                                        border-ink-600
                                        bg-ink-800
                                        text-sm
                                        text-paper
                                        placeholder:text-muted/60
                                        focus:border-glow
                                        focus:ring-glow
                                    "
                                >

                                <button
                                    type="submit"
                                    class="
                                        w-full
                                        rounded-md
                                        bg-glow
                                        px-2 py-2
                                        text-sm font-medium
                                        text-ink-950
                                        transition
                                        hover:brightness-110
                                    "
                                >
                                    {{ __('luma.nav.add_category') }}
                                </button>

                            </form>

                        </div>

                    </div>
                </div>

            </nav>


            {{-- ======================================================== --}}
            {{-- DESKTOP USER FOOTER --}}
            {{-- ======================================================== --}}

            <div
                class="
                    shrink-0
                    border-t border-ink-700
                    px-5 py-4
                    bg-ink-950
                "
            >

                <div class="mb-3">
                    <x-locale-switcher />
                </div>

                <a
                    href="{{ route('profile.edit') }}"
                    class="
                        mb-2
                        block
                        truncate
                        text-sm text-muted
                        transition
                        hover:text-paper
                    "
                >
                    {{ auth()->user()->name }}
                </a>


                <form
                    method="POST"
                    action="{{ route('logout') }}"
                >
                    @csrf

                    <button
                        type="submit"
                        class="
                            text-xs
                            text-muted/70
                            transition
                            hover:text-paper
                        "
                    >
                        {{ __('luma.nav.logout') }}
                    </button>

                </form>

            </div>

        </aside>


        {{-- ============================================================ --}}
        {{-- MAIN CONTENT --}}
        {{-- ============================================================ --}}

        <div
            class="
                min-h-[calc(100vh-4rem)]
                min-w-0

                md:ml-64
                md:min-h-screen
            "
        >

            {{-- Flash status --}}
            @if (session('status'))

                <div
                    class="
                        border-b border-sage/30
                        bg-sage/10
                        px-4 py-2
                        text-sm text-sage
                        md:px-6
                    "
                >
                    {{ session('status') }}
                </div>

            @endif


            <main class="px-4 py-6 md:px-8 md:py-8">
                {{ $slot }}
            </main>

        </div>

    </div>


    {{-- ================================================================ --}}
    {{-- PAGE-SPECIFIC SCRIPTS --}}
    {{-- ================================================================ --}}

    @stack('scripts')

</body>
</html>