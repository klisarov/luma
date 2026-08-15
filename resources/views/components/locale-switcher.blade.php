<div
    class="
        inline-flex
        items-center
        rounded-lg
        border
        border-ink-700
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
                px-2.5
                text-xs
                font-semibold
                transition

                {{ app()->isLocale('en')
                    ? 'bg-glow text-ink-950'
                    : 'text-muted hover:bg-ink-800 hover:text-paper'
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
                px-2.5
                text-xs
                font-semibold
                transition

                {{ app()->isLocale('mk')
                    ? 'bg-glow text-ink-950'
                    : 'text-muted hover:bg-ink-800 hover:text-paper'
                }}
            "
        >
            MK
        </button>
    </form>

</div>