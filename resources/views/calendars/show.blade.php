<x-layouts.app :title="$calendar->name">

    <div class="mx-auto max-w-3xl space-y-6">

        {{-- ============================================================ --}}
        {{-- CALENDAR HEADER --}}
        {{-- ============================================================ --}}

        <div class="flex items-center gap-2">

            <span
                class="h-3 w-3 rounded-full"
                style="background-color: {{ $calendar->color ?? '#F5B942' }}"
            ></span>

            <h1 class="font-display text-2xl font-semibold text-paper">
                {{ $calendar->name }}
            </h1>

        </div>


        {{-- ============================================================ --}}
        {{-- ADD EVENT --}}
        {{-- ============================================================ --}}

        <form
            method="POST"
            action="{{ route('calendar-events.store') }}"
            class="
                grid gap-3
                rounded-xl2
                border border-ink-700
                bg-ink-800/60
                p-4
                sm:grid-cols-2
            "
        >
            @csrf


            <input
                type="hidden"
                name="calendar_id"
                value="{{ $calendar->id }}"
            >


            <input
                type="text"
                name="title"
                value="{{ old('title') }}"
                placeholder="{{ __('luma.calendar.event_title') }}"
                required
                class="
                    rounded-md
                    border-ink-600
                    bg-ink-800
                    text-sm text-paper
                    placeholder:text-muted/60
                    focus:border-glow
                    focus:ring-glow
                    sm:col-span-2
                "
            >


            <input
                type="text"
                name="location"
                value="{{ old('location') }}"
                placeholder="{{ __('luma.calendar.location_optional') }}"
                class="
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
                name="notify_before_minutes"
                class="
                    rounded-md
                    border-ink-600
                    bg-ink-800
                    text-sm text-paper
                    focus:border-glow
                    focus:ring-glow
                "
            >

                <option value="">
                    {{ __('luma.calendar.no_reminder') }}
                </option>

                <option
                    value="15"
                    @selected(old('notify_before_minutes') === '15')
                >
                    {{ __('luma.calendar.reminder_15') }}
                </option>

                <option
                    value="30"
                    @selected(old('notify_before_minutes') === '30')
                >
                    {{ __('luma.calendar.reminder_30') }}
                </option>

                <option
                    value="60"
                    @selected(old('notify_before_minutes') === '60')
                >
                    {{ __('luma.calendar.reminder_60') }}
                </option>

                <option
                    value="1440"
                    @selected(old('notify_before_minutes') === '1440')
                >
                    {{ __('luma.calendar.reminder_day') }}
                </option>

            </select>


            <input
                type="datetime-local"
                name="starts_at"
                value="{{ old('starts_at') }}"
                required
                class="
                    rounded-md
                    border-ink-600
                    bg-ink-800
                    text-sm text-paper
                    focus:border-glow
                    focus:ring-glow
                "
            >


            <input
                type="datetime-local"
                name="ends_at"
                value="{{ old('ends_at') }}"
                class="
                    rounded-md
                    border-ink-600
                    bg-ink-800
                    text-sm text-paper
                    focus:border-glow
                    focus:ring-glow
                "
            >


            @if ($errors->any())

                <div
                    class="
                        rounded-lg
                        border border-red-500/20
                        bg-red-500/10
                        p-3
                        sm:col-span-2
                    "
                >

                    <ul class="space-y-1 text-xs text-red-400">

                        @foreach ($errors->all() as $error)

                            <li>
                                {{ $error }}
                            </li>

                        @endforeach

                    </ul>

                </div>

            @endif


            <button
                type="submit"
                class="
                    rounded-md
                    bg-glow
                    px-4 py-2
                    text-sm font-medium
                    text-ink-950
                    transition
                    hover:brightness-110
                    sm:col-span-2
                "
            >
                {{ __('luma.calendar.add_event') }}
            </button>

        </form>


        {{-- ============================================================ --}}
        {{-- EVENTS --}}
        {{-- ============================================================ --}}

        <div
            class="
                divide-y divide-ink-700
                rounded-xl2
                border border-ink-700
                bg-ink-800/60
            "
        >

            @forelse ($calendar->events as $event)

                <div
                    class="
                        flex items-center justify-between
                        gap-4
                        px-5 py-3.5
                    "
                >

                    <div class="min-w-0">

                        <p class="truncate text-sm font-medium text-paper">
                            {{ $event->title }}
                        </p>


                        <p class="mt-0.5 font-mono text-xs text-muted">

                            {{
                                $event->starts_at
                                    ->locale(app()->getLocale())
                                    ->translatedFormat('j M Y · H:i')
                            }}

                            @if ($event->location)
                                · {{ $event->location }}
                            @endif

                        </p>


                        @if ($event->notify_before_minutes)

                            @php
                                $reminderText = match ((int) $event->notify_before_minutes) {
                                    15 => __('luma.calendar.reminder_15'),
                                    30 => __('luma.calendar.reminder_30'),
                                    60 => __('luma.calendar.reminder_60'),
                                    1440 => __('luma.calendar.reminder_day'),

                                    default => __('luma.calendar.reminder_minutes', [
                                        'minutes' => $event->notify_before_minutes,
                                    ]),
                                };
                            @endphp

                            <p class="mt-1 text-xs text-muted/70">
                                {{
                                    __('luma.calendar.reminder_display', [
                                        'reminder' => $reminderText,
                                    ])
                                }}
                            </p>

                        @endif

                    </div>


                    <form
                        method="POST"
                        action="{{ route('calendar-events.destroy', $event) }}"
                        onsubmit="return confirm(@js(__('luma.calendar.remove_event_confirm')))"
                        class="shrink-0"
                    >
                        @csrf
                        @method('DELETE')


                        <button
                            type="submit"
                            class="
                                rounded-md
                                px-2 py-1
                                text-xs text-muted
                                transition
                                hover:bg-red-500/10
                                hover:text-red-400
                            "
                        >
                            {{ __('luma.common.remove') }}
                        </button>

                    </form>

                </div>

            @empty

                <p class="px-5 py-8 text-center text-sm text-muted">
                    {{ __('luma.calendar.no_events') }}
                </p>

            @endforelse

        </div>

    </div>

</x-layouts.app>