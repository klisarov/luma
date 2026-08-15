<div
    class="
        inline-flex
        shrink-0
        items-center
        rounded-lg
        border
        border-ink-700
        bg-ink-900/90
        p-0.5
        shadow-lg
        shadow-black/10
        backdrop-blur
        sm:p-1
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
                min-h-8
                min-w-9
                items-center
                justify-center
                rounded-md
                px-2
                text-[10px]
                font-bold
                tracking-[0.08em]
                transition
                sm:min-w-10
                sm:px-2.5
                sm:text-xs

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
                min-h-8
                min-w-9
                items-center
                justify-center
                rounded-md
                px-2
                text-[10px]
                font-bold
                tracking-[0.08em]
                transition
                sm:min-w-10
                sm:px-2.5
                sm:text-xs

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