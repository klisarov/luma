<x-layouts.app :title="__('luma.calendar.title')">

    <div class="mx-auto max-w-3xl space-y-6">

        <div class="flex items-center justify-between">

            <h1 class="font-display text-2xl font-semibold">
                {{ __('luma.calendar.title') }}
            </h1>

        </div>


        {{-- ============================================================ --}}
        {{-- ADD CALENDAR --}}
        {{-- ============================================================ --}}

        <form
            method="POST"
            action="{{ route('calendars.store') }}"
            class="
                flex flex-wrap gap-2
                rounded-xl2
                border border-ink-700
                bg-ink-800/60
                p-4
            "
        >
            @csrf


            <input
                type="text"
                name="name"
                placeholder="{{ __('luma.calendar.calendar_name') }}"
                required
                class="
                    min-w-[160px]
                    flex-1
                    rounded-md
                    border-ink-600
                    bg-ink-800
                    text-sm text-paper
                    placeholder:text-muted/60
                    focus:border-glow
                    focus:ring-glow
                "
            >


            <select
                name="type"
                class="
                    rounded-md
                    border-ink-600
                    bg-ink-800
                    text-sm text-paper
                    focus:border-glow
                    focus:ring-glow
                "
            >
                <option value="work">
                    {{ __('luma.calendar.types.work') }}
                </option>

                <option value="study">
                    {{ __('luma.calendar.types.study') }}
                </option>

                <option value="exhibition">
                    {{ __('luma.calendar.types.exhibition') }}
                </option>

                <option value="lecture">
                    {{ __('luma.calendar.types.lecture') }}
                </option>

                <option value="birthday">
                    {{ __('luma.calendar.types.birthday') }}
                </option>

                <option value="custom">
                    {{ __('luma.calendar.types.custom') }}
                </option>
            </select>


            <input
                type="color"
                name="color"
                value="#8B87F5"
                class="
                    h-9 w-12
                    rounded-md
                    border-ink-600
                    bg-ink-800
                "
            >


            <button
                type="submit"
                class="
                    rounded-md
                    bg-glow
                    px-4
                    text-sm font-medium
                    text-ink-950
                "
            >
                {{ __('luma.calendar.add_calendar') }}
            </button>

        </form>


        {{-- ============================================================ --}}
        {{-- CALENDAR LIST --}}
        {{-- ============================================================ --}}

        <div class="grid gap-3 sm:grid-cols-2">

            @foreach ($calendars as $calendar)

                <a
                    href="{{ route('calendars.show', $calendar) }}"
                    class="
                        flex items-center justify-between
                        rounded-xl2
                        border border-ink-700
                        bg-ink-800/60
                        p-4
                        transition
                        hover:border-glow/40
                    "
                >

                    <div class="flex items-center gap-2">

                        <span
                            class="h-2.5 w-2.5 rounded-full"
                            style="background-color: {{ $calendar->color }}"
                        ></span>


                        <div>

                            <p class="text-sm font-medium text-paper">
                                {{ $calendar->name }}
                            </p>

                            <p class="text-xs text-muted">
                                {{ __('luma.calendar.types.' . $calendar->type) }}
                            </p>

                        </div>

                    </div>


                    <span class="font-mono text-xs text-muted">
                        {{ $calendar->events_count }}
                    </span>

                </a>

            @endforeach

        </div>

    </div>

</x-layouts.app>