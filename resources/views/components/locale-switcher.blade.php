<div
    class="
        inline-flex
        items-center
        gap-0.5
        rounded-lg
        bg-ink-800/80
        p-0.5
    "
    aria-label="Language"
>

    {{-- English --}}
    <form
        method="POST"
        action="{{ route('locale.update', 'en') }}"
        class="m-0"
    >
        @csrf

        <button
            type="submit"
            title="English"
            aria-label="English"
            class="
                flex
                h-7
                min-w-9
                items-center
                justify-center
                rounded-md
                px-2
                text-[11px]
                font-semibold
                tracking-wide
                transition-all
                duration-200

                {{ app()->isLocale('en')
                    ? 'bg-paper text-ink-950 shadow-sm'
                    : 'text-muted hover:bg-ink-700 hover:text-paper'
                }}
            "
        >
            EN
        </button>
    </form>


    {{-- Macedonian --}}
    <form
        method="POST"
        action="{{ route('locale.update', 'mk') }}"
        class="m-0"
    >
        @csrf

        <button
            type="submit"
            title="Македонски"
            aria-label="Македонски"
            class="
                flex
                h-7
                min-w-9
                items-center
                justify-center
                rounded-md
                px-2
                text-[11px]
                font-semibold
                tracking-wide
                transition-all
                duration-200

                {{ app()->isLocale('mk')
                    ? 'bg-paper text-ink-950 shadow-sm'
                    : 'text-muted hover:bg-ink-700 hover:text-paper'
                }}
            "
        >
            MK
        </button>
    </form>

</div>