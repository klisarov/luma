<x-layouts.app :title="__('luma.fitness.title')">

    @php
        $days = __('luma.fitness.days');
        $shortDays = __('luma.fitness.days_short');
    @endphp

    <div class="mx-auto max-w-4xl space-y-6">

        <h1 class="font-display text-2xl font-semibold">
            {{ __('luma.fitness.tracker') }}
        </h1>


        {{-- ============================================================ --}}
        {{-- FITNESS TIP --}}
        {{-- ============================================================ --}}

        @if ($tip)

            <div class="rounded-xl2 border border-glow/30 bg-glow/10 p-4">

                <p class="text-xs font-semibold uppercase tracking-wide text-glow">
                    {{ __('luma.fitness.todays_tip') }}
                </p>

                <p class="mt-1 text-sm text-paper">
                    {{ $tip }}
                </p>

            </div>

        @elseif (! auth()->user()->sex)

            <div
                class="
                    rounded-xl2
                    border border-ink-700
                    bg-ink-800/60
                    p-4
                    text-sm text-muted
                "
            >

                {{ __('luma.fitness.profile_details_prompt') }}

                <a
                    href="{{ route('profile.edit') }}"
                    class="text-glow hover:underline"
                >
                    {{ __('luma.fitness.update_profile') }}
                </a>

            </div>

        @endif


        {{-- ============================================================ --}}
        {{-- ADD WORKOUT --}}
        {{-- ============================================================ --}}

        <form
            method="POST"
            action="{{ route('workout-plans.store') }}"
            class="
                grid gap-3
                rounded-xl2
                border border-ink-700
                bg-ink-800/60
                p-4
                sm:grid-cols-2
                lg:grid-cols-4
            "
        >
            @csrf


            {{-- Day --}}
            <select
                name="day_of_week"
                class="
                    rounded-md
                    border-ink-600
                    bg-ink-800
                    text-sm text-paper
                    focus:border-glow
                    focus:ring-glow
                "
            >

                @foreach ($days as $i => $day)

                    <option value="{{ $i }}">
                        {{ $day }}
                    </option>

                @endforeach

            </select>


            {{-- Time --}}
            <input
                type="time"
                name="scheduled_time"
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


            {{-- Workout type --}}
            <input
                type="text"
                name="workout_type"
                placeholder="{{ __('luma.fitness.workout_type_placeholder') }}"
                required
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


            {{-- Duration + submit --}}
            <div class="flex gap-2">

                <input
                    type="number"
                    name="duration_minutes"
                    placeholder="{{ __('luma.fitness.duration_placeholder') }}"
                    min="5"
                    class="
                        w-full
                        rounded-md
                        border-ink-600
                        bg-ink-800
                        text-sm text-paper
                        placeholder:text-muted/60
                        focus:border-glow
                        focus:ring-glow
                    "
                >

                <button
                    type="submit"
                    class="
                        shrink-0
                        rounded-md
                        bg-glow
                        px-3
                        text-sm font-medium
                        text-ink-950
                    "
                >
                    {{ __('luma.common.add') }}
                </button>

            </div>

        </form>


        {{-- ============================================================ --}}
        {{-- WEEKLY GRID --}}
        {{-- ============================================================ --}}

        <div class="grid gap-3 sm:grid-cols-2 lg:grid-cols-7">

            @foreach ($shortDays as $i => $label)

                <div
                    class="
                        rounded-xl2
                        border border-ink-700
                        bg-ink-800/60
                        p-3
                    "
                >

                    <p
                        class="
                            mb-2
                            text-xs
                            font-semibold
                            uppercase
                            tracking-wide
                            text-muted
                        "
                    >
                        {{ $label }}
                    </p>


                    <div class="space-y-2">

                        @forelse ($plans->get($i, collect()) as $workout)

                            <div class="rounded-lg bg-ink-700 p-2">

                                <p class="text-xs font-medium text-paper">
                                    {{ $workout->workout_type }}
                                </p>


                                <p class="font-mono text-[11px] text-muted">

                                    {{
                                        \Illuminate\Support\Carbon::parse(
                                            $workout->scheduled_time
                                        )->format('H:i')
                                    }}

                                    ·

                                    {{ $workout->duration_minutes }}
                                    {{ __('luma.fitness.minutes_short') }}

                                </p>


                                <form
                                    method="POST"
                                    action="{{ route('workout-plans.destroy', $workout) }}"
                                    class="mt-1"
                                >
                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="
                                            text-[10px]
                                            text-muted
                                            hover:text-paper
                                        "
                                    >
                                        {{ __('luma.common.remove') }}
                                    </button>

                                </form>

                            </div>

                        @empty

                            <p class="text-[11px] text-muted/50">
                                {{ __('luma.fitness.rest') }}
                            </p>

                        @endforelse

                    </div>

                </div>

            @endforeach

        </div>

    </div>

</x-layouts.app>