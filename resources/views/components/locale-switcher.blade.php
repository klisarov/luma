<div
    class="
        inline-flex
        items-center
        rounded-lg
        border border-ink-700
        bg-ink-900
        p-1
    "
>

    <form
        method="POST"
        action="{{ route('locale.update', 'en') }}"
    >
        @csrf

        <button
            type="submit"
            class="
                rounded-md
                px-2.5 py-1.5
                text-xs font-semibold
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


    <form
        method="POST"
        action="{{ route('locale.update', 'mk') }}"
    >
        @csrf

        <button
            type="submit"
            class="
                rounded-md
                px-2.5 py-1.5
                text-xs font-semibold
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