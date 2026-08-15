<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Welcome back — Luma</title>

    {{-- Browser / PWA branding --}}
    <link
        rel="icon"
        type="image/png"
        sizes="32x32"
        href="{{ asset('favicon-32x32.png') }}"
    >

    <link
        rel="icon"
        type="image/png"
        sizes="16x16"
        href="{{ asset('favicon-16x16.png') }}"
    >

    <link
        rel="shortcut icon"
        href="{{ asset('favicon.ico') }}"
    >

    <link
        rel="apple-touch-icon"
        sizes="180x180"
        href="{{ asset('apple-touch-icon.png') }}"
    >

    <link
        rel="manifest"
        href="{{ asset('site.webmanifest') }}"
    >

    <meta name="theme-color" content="#0B0F1A">
    <meta name="apple-mobile-web-app-title" content="Luma">

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

<body class="min-h-full bg-ink-950 text-paper antialiased">

    <div class="absolute right-5 top-5 z-20">
        <x-locale-switcher />
        <span class="text-white">
    {{ app()->getLocale() }}
</span>
    </div>

    <main class="relative min-h-screen overflow-hidden">

        {{-- ============================================================ --}}
        {{-- BACKGROUND --}}
        {{-- ============================================================ --}}

        <div class="pointer-events-none absolute inset-0 overflow-hidden">

            {{-- Main golden glow --}}
            <div
                class="absolute -left-40 -top-40 h-[500px] w-[500px] rounded-full opacity-20 blur-[120px]"
                style="background: #F5B942;"
            ></div>

            {{-- Bottom-right golden glow --}}
            <div
                class="absolute -bottom-56 right-[-150px] h-[550px] w-[550px] rounded-full opacity-[0.08] blur-[140px]"
                style="background: #F5B942;"
            ></div>

            {{-- White atmospheric glow --}}
            <div
                class="absolute right-[12%] top-[8%] h-40 w-40 rounded-full opacity-[0.05] blur-[70px]"
                style="background: #ffffff;"
            ></div>

            {{-- Decorative orbital rings --}}
            <div
                class="absolute left-[8%] top-[26%] hidden h-[420px] w-[420px] rotate-[-18deg] rounded-full border border-glow/10 xl:block"
            ></div>

            <div
                class="absolute left-[12%] top-[30%] hidden h-[310px] w-[310px] rotate-[22deg] rounded-full border border-glow/[0.07] xl:block"
            ></div>

        </div>


        {{-- ============================================================ --}}
        {{-- PAGE GRID --}}
        {{-- ============================================================ --}}

        <div
            class="
                relative z-10
                mx-auto
                grid min-h-screen
                max-w-[1600px]
                lg:grid-cols-[1.15fr_0.85fr]
            "
        >

            {{-- ======================================================== --}}
            {{-- MARKETING --}}
            {{-- ======================================================== --}}

            <section
                class="
                    relative
                    flex flex-col
                    px-6 pb-10 pt-7
                    sm:px-10
                    lg:min-h-screen
                    lg:px-14
                    lg:pb-14
                    lg:pt-10
                    xl:px-20
                "
            >

                {{-- Luma logo --}}
                <div>
                    <a
                        href="{{ url('/') }}"
                        class="inline-flex items-center"
                        aria-label="Luma"
                    >
                        <img
                            src="{{ asset('images/luma-logo.png') }}"
                            alt="Luma"
                            class="h-11 w-auto max-w-[180px] object-contain sm:h-12"
                        >
                    </a>
                </div>


                {{-- Hero --}}
                <div
                    class="
                        flex flex-1
                        flex-col justify-center
                        py-14
                        lg:max-w-2xl
                        lg:py-20
                    "
                >

                    {{-- Motto --}}
                    <h1
                        class="
                            max-w-3xl
                            font-display
                            text-4xl font-semibold
                            leading-[1.05]
                            tracking-[-0.035em]
                            text-paper
                            sm:text-5xl
                            lg:text-6xl
                            xl:text-7xl
                        "
                    >
                        {{ __('luma.login.your_day') }}

                        <span
                            class="
                                bg-gradient-to-r
                                from-[#FFE7A3]
                                via-[#F5B942]
                                to-[#E99D22]
                                bg-clip-text
                                text-transparent
                            "
                        >
                            {{ __('luma.login.in_orbit') }}
                        </span>
                    </h1>


                    {{-- Product description --}}
                    <p
                        class="
                            mt-6
                            max-w-xl
                            text-base leading-7
                            text-muted
                            sm:text-lg
                        "
                    >
                        {{ __('luma.login.intro') }}
                    </p>


                    {{-- ================================================= --}}
                    {{-- FEATURES --}}
                    {{-- ================================================= --}}

                    <div
                        class="
                            mt-10
                            grid max-w-2xl
                            gap-3
                            sm:grid-cols-2
                        "
                    >

                        {{-- Focus --}}
                        <div
                            class="
                                group
                                rounded-2xl
                                border border-ink-700
                                bg-ink-900/50
                                p-4
                                backdrop-blur
                                transition
                                hover:border-glow/25
                                hover:bg-ink-800/70
                            "
                        >

                            <div class="flex items-start gap-3">

                                <div
                                    class="
                                        flex h-9 w-9
                                        shrink-0
                                        items-center justify-center
                                        rounded-xl
                                        border border-glow/20
                                        bg-glow/[0.08]
                                        text-glow
                                    "
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
                                            d="M5 13l4 4L19 7"
                                        />
                                    </svg>
                                </div>

                                <div>
                                    <p class="text-sm font-semibold text-paper">
                                        {{ __('luma.login.focused_days') }}
                                    </p>

                                    <p class="mt-1 text-xs leading-5 text-muted">
                                        {{ __('luma.login.focused_days_description') }}
                                    </p>
                                </div>

                            </div>

                        </div>


                        {{-- Calendar --}}
                        <div
                            class="
                                group
                                rounded-2xl
                                border border-ink-700
                                bg-ink-900/50
                                p-4
                                backdrop-blur
                                transition
                                hover:border-glow/25
                                hover:bg-ink-800/70
                            "
                        >

                            <div class="flex items-start gap-3">

                                <div
                                    class="
                                        flex h-9 w-9
                                        shrink-0
                                        items-center justify-center
                                        rounded-xl
                                        border border-glow/20
                                        bg-glow/[0.08]
                                        text-glow
                                    "
                                >
                                    <svg
                                        class="h-4 w-4"
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="1.8"
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
                                </div>

                                <div>
                                    <p class="text-sm font-semibold text-paper">
                                        {{ __('luma.login.one_calendar') }}
                                    </p>

                                    <p class="mt-1 text-xs leading-5 text-muted">
                                        {{ __('luma.login.one_calendar_description') }}
                                    </p>
                                </div>

                            </div>

                        </div>


                        {{-- Fitness --}}
                        <div
                            class="
                                group
                                rounded-2xl
                                border border-ink-700
                                bg-ink-900/50
                                p-4
                                backdrop-blur
                                transition
                                hover:border-glow/25
                                hover:bg-ink-800/70
                            "
                        >

                            <div class="flex items-start gap-3">

                                <div
                                    class="
                                        flex h-9 w-9
                                        shrink-0
                                        items-center justify-center
                                        rounded-xl
                                        border border-glow/20
                                        bg-glow/[0.08]
                                        text-glow
                                    "
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
                                            d="M13 10V3L4 14h7v7l9-11h-7z"
                                        />
                                    </svg>
                                </div>

                                <div>
                                    <p class="text-sm font-semibold text-paper">
                                        {{ __('luma.login.stay_consistent') }}
                                    </p>

                                    <p class="mt-1 text-xs leading-5 text-muted">
                                        {{ __('luma.login.stay_consistent_description') }}
                                    </p>
                                </div>

                            </div>

                        </div>


                        {{-- Reminders --}}
                        <div
                            class="
                                group
                                rounded-2xl
                                border border-ink-700
                                bg-ink-900/50
                                p-4
                                backdrop-blur
                                transition
                                hover:border-glow/25
                                hover:bg-ink-800/70
                            "
                        >

                            <div class="flex items-start gap-3">

                                <div
                                    class="
                                        flex h-9 w-9
                                        shrink-0
                                        items-center justify-center
                                        rounded-xl
                                        border border-glow/20
                                        bg-glow/[0.08]
                                        text-glow
                                    "
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
                                            d="M18 8A6 6 0 006 8c0 7-3 7-3 9h18c0-2-3-2-3-9M10 21h4"
                                        />
                                    </svg>
                                </div>

                                <div>
                                    <p class="text-sm font-semibold text-paper">
                                        {{ __('luma.login.never_lose_track') }}
                                    </p>

                                    <p class="mt-1 text-xs leading-5 text-muted">
                                        {{ __('luma.login.never_lose_track_description') }}
                                    </p>
                                </div>

                            </div>

                        </div>

                    </div>


                    {{-- Product statement --}}
                    <div
                        class="
                            mt-10
                            flex items-center gap-3
                            text-sm text-muted
                        "
                    >
                        <div class="h-px w-8 bg-glow/40"></div>

                        <span>
                            One place. Less noise. More momentum.
                        </span>
                    </div>

                </div>


                {{-- Desktop footer --}}
                <div
                    class="
                        hidden
                        items-center justify-between
                        border-t border-ink-800
                        pt-5
                        text-xs text-muted/60
                        lg:flex
                    "
                >
                    <span>
                        © {{ date('Y') }} Luma
                    </span>

                    <span>
                        Built for intentional days.
                    </span>
                </div>

            </section>


            {{-- ======================================================== --}}
            {{-- LOGIN SIDE --}}
            {{-- ======================================================== --}}

            <section
                class="
                    relative
                    flex items-center justify-center
                    border-t border-ink-800
                    bg-ink-900/30
                    px-5 py-12
                    sm:px-8
                    lg:min-h-screen
                    lg:border-l
                    lg:border-t-0
                    lg:px-12
                    lg:py-16
                "
            >

                {{-- Light texture --}}
                <div
                    class="
                        pointer-events-none
                        absolute inset-0
                        bg-gradient-to-br
                        from-white/[0.025]
                        via-transparent
                        to-glow/[0.025]
                    "
                ></div>


                <div class="relative w-full max-w-md">

                    {{-- ================================================= --}}
                    {{-- LOGIN CARD --}}
                    {{-- ================================================= --}}

                    <div
                        class="
                            relative
                            overflow-hidden
                            rounded-[28px]
                            border border-ink-700
                            bg-ink-900/80
                            p-6
                            shadow-2xl
                            shadow-black/30
                            backdrop-blur-xl
                            sm:p-8
                        "
                    >

                        {{-- Top gold highlight --}}
                        <div
                            class="
                                pointer-events-none
                                absolute left-10 right-10 top-0
                                h-px
                                bg-gradient-to-r
                                from-transparent
                                via-glow/60
                                to-transparent
                            "
                        ></div>


                        {{-- Glow --}}
                        <div
                            class="
                                pointer-events-none
                                absolute -right-20 -top-20
                                h-44 w-44
                                rounded-full
                                bg-glow/[0.08]
                                blur-3xl
                            "
                        ></div>


                        {{-- ================================================= --}}
                        {{-- LOGIN HEADER --}}
                        {{-- ================================================= --}}

                        <div class="relative">

                            {{-- Luma app icon --}}
                            <div class="mb-6">

                                <div
                                    class="
                                        relative
                                        inline-flex
                                        rounded-2xl
                                        shadow-lg
                                        shadow-glow/10
                                    "
                                >

                                    <div
                                        class="
                                            pointer-events-none
                                            absolute -inset-2
                                            rounded-[22px]
                                            bg-glow/10
                                            blur-xl
                                        "
                                    ></div>

                                    <img
                                        src="{{ asset('icons/icon-192.png') }}"
                                        alt="Luma"
                                        class="
                                            relative
                                            h-14 w-14
                                            rounded-2xl
                                            border border-glow/20
                                            object-cover
                                            shadow-xl
                                        "
                                    >

                                </div>

                            </div>


                            <h2
                                class="
                                    font-display
                                    text-2xl font-semibold
                                    tracking-tight
                                    text-paper
                                    sm:text-3xl
                                "
                            >
                                {{ __('luma.login.welcome_back') }}
                            </h2>


                            <p class="mt-2 text-sm leading-6 text-muted">
                                {{ __('luma.login.welcome_description') }}
                            </p>

                        </div>


                        {{-- ================================================= --}}
                        {{-- SESSION STATUS --}}
                        {{-- ================================================= --}}

                        @if (session('status'))

                            <div
                                class="
                                    mt-6
                                    rounded-xl
                                    border border-sage/20
                                    bg-sage/10
                                    px-4 py-3
                                    text-sm text-sage
                                "
                            >
                                {{ session('status') }}
                            </div>

                        @endif


                        {{-- ================================================= --}}
                        {{-- LOGIN FORM --}}
                        {{-- ================================================= --}}

                        <form
                            method="POST"
                            action="{{ route('login') }}"
                            class="mt-8"
                            x-data="{ showPassword: false }"
                        >
                            @csrf


                            {{-- Email --}}
                            <div>

                                <label
                                    for="email"
                                    class="
                                        mb-2
                                        block
                                        text-xs font-semibold
                                        uppercase
                                        tracking-[0.14em]
                                        text-muted
                                    "
                                >
                                    Email
                                </label>


                                <div class="relative">

                                    <div
                                        class="
                                            pointer-events-none
                                            absolute inset-y-0 left-0
                                            flex items-center
                                            pl-4
                                            text-muted
                                        "
                                    >
                                        <svg
                                            class="h-4 w-4"
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-width="1.7"
                                        >
                                            <rect
                                                x="3"
                                                y="5"
                                                width="18"
                                                height="14"
                                                rx="2"
                                            />

                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M3 7l9 6 9-6"
                                            />
                                        </svg>
                                    </div>


                                    <input
                                        id="email"
                                        type="email"
                                        name="email"
                                        value="{{ old('email') }}"
                                        required
                                        autofocus
                                        autocomplete="username"
                                        placeholder="you@example.com"
                                        class="
                                            block w-full
                                            rounded-xl
                                            border border-ink-600
                                            bg-ink-950/70
                                            py-3.5
                                            pl-11 pr-4
                                            text-sm
                                            text-paper
                                            outline-none
                                            placeholder:text-muted/40
                                            transition
                                            focus:border-glow/60
                                            focus:ring-4
                                            focus:ring-glow/[0.08]
                                        "
                                    >

                                </div>


                                @error('email')

                                    <p class="mt-2 text-xs text-red-400">
                                        {{ $message }}
                                    </p>

                                @enderror

                            </div>


                            {{-- Password --}}
                            <div class="mt-5">

                                <div class="mb-2 flex items-center justify-between">

                                    <label
                                        for="password"
                                        class="
                                            block
                                            text-xs font-semibold
                                            uppercase
                                            tracking-[0.14em]
                                            text-muted
                                        "
                                    >
                                        Password
                                    </label>


                                    @if (Route::has('password.request'))

                                    @endif

                                </div>


                                <div class="relative">

                                    <div
                                        class="
                                            pointer-events-none
                                            absolute inset-y-0 left-0
                                            flex items-center
                                            pl-4
                                            text-muted
                                        "
                                    >
                                        <svg
                                            class="h-4 w-4"
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-width="1.7"
                                        >
                                            <rect
                                                x="5"
                                                y="10"
                                                width="14"
                                                height="10"
                                                rx="2"
                                            />

                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M8 10V7a4 4 0 018 0v3"
                                            />
                                        </svg>
                                    </div>


                                    <input
                                        id="password"
                                        :type="showPassword ? 'text' : 'password'"
                                        name="password"
                                        required
                                        autocomplete="current-password"
                                        placeholder="Enter your password"
                                        class="
                                            block w-full
                                            rounded-xl
                                            border border-ink-600
                                            bg-ink-950/70
                                            py-3.5
                                            pl-11 pr-12
                                            text-sm
                                            text-paper
                                            outline-none
                                            placeholder:text-muted/40
                                            transition
                                            focus:border-glow/60
                                            focus:ring-4
                                            focus:ring-glow/[0.08]
                                        "
                                    >


                                    {{-- Show / hide password --}}
                                    <button
                                        type="button"
                                        @click="showPassword = !showPassword"
                                        class="
                                            absolute inset-y-0 right-0
                                            flex items-center
                                            px-4
                                            text-muted
                                            transition
                                            hover:text-paper
                                        "
                                        aria-label="Toggle password visibility"
                                    >

                                        {{-- Eye --}}
                                        <svg
                                            x-show="!showPassword"
                                            class="h-4 w-4"
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-width="1.7"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M2.5 12s3.5-6 9.5-6 9.5 6 9.5 6-3.5 6-9.5 6-9.5-6-9.5-6z"
                                            />

                                            <circle
                                                cx="12"
                                                cy="12"
                                                r="2.5"
                                            />
                                        </svg>


                                        {{-- Eye closed --}}
                                        <svg
                                            x-show="showPassword"
                                            x-cloak
                                            class="h-4 w-4"
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-width="1.7"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M3 3l18 18"
                                            />

                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M10.6 6.2A10.8 10.8 0 0112 6c6 0 9.5 6 9.5 6a17.5 17.5 0 01-2.1 2.8M6.2 6.2C3.8 8 2.5 12 2.5 12s3.5 6 9.5 6a10 10 0 004-.8"
                                            />
                                        </svg>

                                    </button>

                                </div>


                                @error('password')

                                    <p class="mt-2 text-xs text-red-400">
                                        {{ $message }}
                                    </p>

                                @enderror

                            </div>


                            {{-- Remember --}}
                            <div class="mt-5">

                                <label
                                    for="remember_me"
                                    class="
                                        inline-flex
                                        cursor-pointer
                                        items-center gap-2.5
                                        text-sm text-muted
                                    "
                                >

                                    <input
                                        id="remember_me"
                                        type="checkbox"
                                        name="remember"
                                        class="
                                            h-4 w-4
                                            rounded
                                            border-ink-600
                                            bg-ink-950
                                            text-glow
                                            focus:ring-glow
                                            focus:ring-offset-0
                                        "
                                    >

                                    <span>
                                        {{ __('luma.login.keep_signed_in') }}
                                    </span>

                                </label>

                            </div>


                            {{-- Login button --}}
                            <button
                                type="submit"
                                class="
                                    group
                                    relative
                                    mt-7
                                    flex w-full
                                    items-center justify-center
                                    overflow-hidden
                                    rounded-xl
                                    bg-glow
                                    px-4 py-3.5
                                    text-sm font-semibold
                                    text-ink-950
                                    shadow-lg
                                    shadow-glow/10
                                    transition
                                    duration-300
                                    hover:-translate-y-0.5
                                    hover:brightness-105
                                    hover:shadow-glow/20
                                    active:translate-y-0
                                "
                            >

                                <span class="relative z-10">
                                    {{ __('luma.login.enter_luma') }}
                                </span>


                                <svg
                                    class="
                                        relative z-10
                                        ml-2 h-4 w-4
                                        transition-transform
                                        duration-300
                                        group-hover:translate-x-1
                                    "
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="2"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M5 12h14M13 6l6 6-6 6"
                                    />
                                </svg>


                                {{-- Button shine --}}
                                <div
                                    class="
                                        absolute inset-0
                                        translate-x-[-110%]
                                        bg-gradient-to-r
                                        from-transparent
                                        via-white/30
                                        to-transparent
                                        transition-transform
                                        duration-700
                                        group-hover:translate-x-[110%]
                                    "
                                ></div>

                            </button>

                        </form>


                        {{-- ================================================= --}}
                        {{-- PRIVACY NOTE --}}
                        {{-- ================================================= --}}

                        <div
                            class="
                                mt-7
                                border-t border-ink-700
                                pt-5
                                text-center
                            "
                        >
                            <p class="text-xs leading-5 text-muted/60">
                                {{ __('luma.login.privacy') }}
                            </p>
                        </div>

                    </div>


                    {{-- Mobile footer --}}
                    <p
                        class="
                            mt-6
                            text-center
                            text-xs
                            text-muted/50
                            lg:hidden
                        "
                    >
                        © {{ date('Y') }} Luma · {{ __('luma.login.motto') }}
                    </p>

                </div>

            </section>

        </div>

    </main>

</body>
</html>