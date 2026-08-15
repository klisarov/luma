<div
    class="
        inline-flex
        items-center
        gap-1
        rounded-lg
        border border-ink-700
        bg-ink-900
        p-1
    "
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
            aria-label="English"
            title="English"
            class="
                flex
                h-8
                min-w-10
                items-center
                justify-center
                rounded-md
                border
                px-2.5
                text-xs
                font-bold
                tracking-wide
                transition-all
                duration-200

                {{ app()->isLocale('en')
                    ? 'border-glow bg-glow/15 text-glow'
                    : 'border-transparent bg-transparent text-muted hover:bg-ink-800 hover:text-paper'
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
            aria-label="Македонски"
            title="Македонски"
            class="
                flex
                h-8
                min-w-10
                items-center
                justify-center
                rounded-md
                border
                px-2.5
                text-xs
                font-bold
                tracking-wide
                transition-all
                duration-200

                {{ app()->isLocale('mk')
                    ? 'border-glow bg-glow/15 text-glow'
                    : 'border-transparent bg-transparent text-muted hover:bg-ink-800 hover:text-paper'
                }}
            "
        >
            MK
        </button>
    </form>

</div>