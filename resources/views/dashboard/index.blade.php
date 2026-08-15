<x-layouts.app :title="__('luma.dashboard.title')">

    <div class="mx-auto max-w-5xl space-y-8">

        {{-- ============================================================ --}}
        {{-- HEADER --}}
        {{-- ============================================================ --}}

        <div class="flex flex-col items-start justify-between gap-6 sm:flex-row sm:items-center">

            <div>
                <p class="text-sm text-muted">
                    {{
                        now()
                            ->locale(app()->getLocale())
                            ->translatedFormat('l, j F')
                    }}
                </p>

                <h1 class="font-display text-2xl font-semibold text-paper sm:text-3xl">
                    {{ __('luma.dashboard.todays_plan') }}
                </h1>
            </div>


            {{-- Completion glow ring --}}
            <div
                id="glow-ring"
                class="relative flex h-24 w-24 items-center justify-center rounded-full"
                style="
                    box-shadow:
                        0 0 {{ 20 + $completionPercentage * 0.4 }}px
                        -4px
                        rgba(
                            245,
                            185,
                            66,
                            {{ 0.15 + ($completionPercentage / 100) * 0.45 }}
                        );

                    transition:
                        box-shadow
                        750ms
                        cubic-bezier(0.22, 1, 0.36, 1);

                    will-change: box-shadow;
                "
            >

                <svg
                    class="h-24 w-24 -rotate-90"
                    viewBox="0 0 100 100"
                >

                    <circle
                        cx="50"
                        cy="50"
                        r="42"
                        fill="none"
                        stroke="#262A3A"
                        stroke-width="8"
                    />

                    <circle
                        id="glow-ring-progress"
                        cx="50"
                        cy="50"
                        r="42"
                        fill="none"
                        stroke="#F5B942"
                        stroke-width="8"
                        stroke-linecap="round"
                        stroke-dasharray="{{ 2 * 3.14159 * 42 }}"
                        stroke-dashoffset="{{ 2 * 3.14159 * 42 * (1 - $completionPercentage / 100) }}"
                        style="will-change: stroke-dashoffset;"
                    />

                </svg>


                <div class="absolute inset-0 flex flex-col items-center justify-center">

                    <span
                        id="glow-ring-value"
                        class="font-mono text-lg font-medium text-paper"
                    >
                        {{ $completionPercentage }}%
                    </span>

                </div>

            </div>

        </div>


        {{-- Completion sentence --}}
        <p class="text-sm text-muted">

            <span id="completion-sentence">
                {{ __('luma.dashboard.completion', ['percentage' => $completionPercentage]) }}
            </span>

        </p>


        {{-- ============================================================ --}}
        {{-- DEVICE SETUP PROMPTS --}}
        {{-- ============================================================ --}}

        <div
            id="device-setup-prompts"
            class="space-y-3"
        >

            {{-- ======================================================== --}}
            {{-- IPHONE INSTALL PROMPT --}}
            {{-- ======================================================== --}}

            <div
                id="ios-install-prompt"
                class="
                    hidden
                    overflow-hidden
                    rounded-xl2
                    border border-glow/25
                    bg-gradient-to-br
                    from-glow/10
                    via-ink-800/90
                    to-ink-800/60
                    p-4
                    sm:p-5
                "
            >

                <div
                    class="
                        flex flex-col gap-4
                        sm:flex-row
                        sm:items-center
                        sm:justify-between
                    "
                >

                    <div class="flex items-start gap-3">

                        {{-- Install icon --}}
                        <div
                            class="
                                flex h-11 w-11 shrink-0
                                items-center justify-center
                                rounded-xl
                                border border-glow/20
                                bg-glow/10
                                text-glow
                            "
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
                                    d="M12 16V4m0 0L8 8m4-4 4 4M5 12v7a1 1 0 001 1h12a1 1 0 001-1v-7"
                                />
                            </svg>

                        </div>


                        <div>

                            <div class="flex flex-wrap items-center gap-2">

                                <h2 class="text-sm font-semibold text-paper">
                                    {{ __('luma.dashboard.add_to_iphone') }}
                                </h2>

                                <span
                                    class="
                                        rounded-full
                                        border border-glow/20
                                        bg-glow/10
                                        px-2 py-0.5
                                        text-[10px]
                                        font-semibold
                                        uppercase
                                        tracking-wider
                                        text-glow
                                    "
                                >
                                    {{ __('luma.dashboard.recommended') }}
                                </span>

                            </div>


                            <p
                                class="
                                    mt-1
                                    max-w-xl
                                    text-xs
                                    leading-5
                                    text-muted
                                "
                            >
                                {{ __('luma.dashboard.iphone_description') }}
                            </p>

                        </div>

                    </div>


                    {{-- iOS instructions --}}
                    <div
                        class="
                            shrink-0
                            rounded-xl
                            border border-ink-600
                            bg-ink-900/80
                            px-4 py-3
                        "
                    >

                        <div class="flex items-center gap-2 text-xs">

                            {{-- Share icon --}}
                            <svg
                                class="h-4 w-4 shrink-0 text-glow"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="1.8"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M12 16V3m0 0L8 7m4-4 4 4M5 11v9h14v-9"
                                />
                            </svg>

                            <span class="font-medium text-paper">
                                {{ __('luma.dashboard.share') }}
                            </span>

                            <span class="text-muted/50">
                                →
                            </span>

                            <span class="font-semibold text-glow">
                                {{ __('luma.dashboard.add_to_home_screen') }}
                            </span>

                        </div>

                    </div>

                </div>

            </div>


            {{-- ======================================================== --}}
            {{-- NOTIFICATION PROMPT --}}
            {{-- ======================================================== --}}

            <div
                id="notification-prompt"
                class="
                    hidden
                    overflow-hidden
                    rounded-xl2
                    border border-violet/25
                    bg-gradient-to-br
                    from-violet/10
                    via-ink-800/90
                    to-ink-800/60
                    p-4
                    sm:p-5
                "
            >

                <div
                    class="
                        flex flex-col gap-4
                        sm:flex-row
                        sm:items-center
                        sm:justify-between
                    "
                >

                    <div class="flex items-start gap-3">

                        {{-- Bell icon --}}
                        <div
                            class="
                                flex h-11 w-11 shrink-0
                                items-center justify-center
                                rounded-xl
                                border border-violet/20
                                bg-violet/10
                                text-violet-soft
                            "
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
                                    d="M18 8a6 6 0 10-12 0c0 7-3 7-3 9h18c0-2-3-2-3-9M10 21h4"
                                />

                            </svg>

                        </div>


                        <div>

                            <h2
                                id="notification-prompt-title"
                                class="text-sm font-semibold text-paper"
                            >
                                {{ __('luma.dashboard.stay_on_track') }}
                            </h2>


                            <p
                                id="push-status"
                                class="
                                    mt-1
                                    max-w-xl
                                    text-xs
                                    leading-5
                                    text-muted
                                "
                            >
                                {{ __('luma.dashboard.allow_notifications_description') }}
                            </p>

                        </div>

                    </div>


                    <button
                        id="enable-notifications"
                        type="button"
                        class="
                            shrink-0
                            rounded-lg
                            bg-glow
                            px-4 py-2.5
                            text-xs
                            font-semibold
                            text-ink-950
                            transition
                            hover:brightness-110
                            disabled:cursor-not-allowed
                            disabled:opacity-60
                        "
                    >
                        {{ __('luma.dashboard.allow_notifications') }}
                    </button>

                </div>

            </div>

        </div>


        {{-- ============================================================ --}}
        {{-- CATEGORIES --}}
        {{-- ============================================================ --}}

        @if ($categories->isNotEmpty())

            <div class="flex flex-wrap gap-2">

                @foreach ($categories as $category)

                    <a
                        href="{{ route('categories.show', $category) }}"
                        class="
                            flex items-center gap-2
                            rounded-full
                            border border-ink-600
                            bg-ink-800
                            px-3.5 py-1.5
                            text-sm font-medium
                            text-paper
                            transition
                            hover:border-glow/50
                            hover:bg-ink-700
                        "
                    >

                        <span
                            class="h-2 w-2 rounded-full"
                            style="
                                background-color:
                                    {{ $category->color ?? '#F5B942' }}
                            "
                        ></span>


                        {{ $category->name }}


                        <span class="font-mono text-xs text-muted">
                            {{ $category->tasks_count }}
                        </span>

                    </a>

                @endforeach

            </div>

        @endif


        {{-- ============================================================ --}}
        {{-- TODAY'S OBLIGATIONS --}}
        {{-- ============================================================ --}}

        <div
            id="todays-obligations"
            class="
                rounded-xl2
                border border-ink-700
                bg-ink-800/60
            "
        >

            <div
                class="
                    flex items-center justify-between
                    border-b border-ink-700
                    px-5 py-4
                "
            >

                <h2 class="font-display text-base font-semibold">
                    {{ __('luma.dashboard.todays_obligations') }}
                </h2>


                <span
                    id="today-task-count"
                    class="font-mono text-xs text-muted"
                >
                    {{ trans_choice(
                        'luma.dashboard.task_count',
                        $todaysTasks->count(),
                        ['count' => $todaysTasks->count()]
                    ) }}
                </span>

            </div>


            <div class="divide-y divide-ink-700">

                @forelse ($todaysTasks as $task)

                    <div
                        class="
                            task-row
                            flex items-center gap-3
                            px-5 py-3.5
                        "
                        data-task-id="{{ $task->id }}"
                        data-list="today"
                    >

                        {{-- Checkbox --}}
                        <button
                            type="button"
                            class="
                                task-checkbox
                                flex h-5 w-5 shrink-0
                                items-center justify-center
                                rounded-full border
                                transition

                                {{ $task->is_completed
                                    ? 'border-sage bg-sage/20'
                                    : 'border-ink-600 hover:border-glow'
                                }}
                            "
                            data-task-id="{{ $task->id }}"
                            aria-pressed="{{ $task->is_completed ? 'true' : 'false' }}"
                        >

                            <svg
                                class="
                                    check-icon
                                    h-3 w-3
                                    text-sage

                                    {{ $task->is_completed
                                        ? ''
                                        : 'hidden'
                                    }}
                                "
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="3"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M5 13l4 4L19 7"
                                />
                            </svg>

                        </button>


                        {{-- Task information --}}
                        <div class="min-w-0 flex-1">

                            <p
                                class="
                                    task-title
                                    truncate
                                    text-sm font-medium

                                    {{ $task->is_completed
                                        ? 'text-muted line-through'
                                        : 'text-paper'
                                    }}
                                "
                            >
                                {{ $task->title }}
                            </p>


                            <div
                                class="
                                    mt-0.5
                                    flex flex-wrap
                                    items-center gap-2
                                    text-xs text-muted
                                "
                            >

                                {{-- Category --}}
                                @if ($task->category)

                                    <span class="flex items-center gap-1">

                                        <span
                                            class="h-1.5 w-1.5 rounded-full"
                                            style="
                                                background-color:
                                                    {{ $task->category->color ?? '#F5B942' }}
                                            "
                                        ></span>


                                        <span>

                                            {{ $task->category->name }}

                                            @if ($task->subcategory)
                                                · {{ $task->subcategory->name }}
                                            @endif

                                        </span>

                                    </span>

                                @endif


                                {{-- Due --}}
                                @if ($task->due_at)

                                    <span class="font-mono">
                                        {{ $task->due_at->format('H:i') }}
                                    </span>

                                @endif


                                {{-- Priority --}}
                                @if ($task->priority)

                                    <span class="capitalize">
                                        {{ __('luma.common.' . $task->priority) }}
                                    </span>

                                @endif

                            </div>

                        </div>


                        {{-- Work --}}
                        @if ($task->is_work_related)

                            <span
                                class="
                                    rounded-full
                                    bg-violet/15
                                    px-2 py-0.5
                                    text-[11px]
                                    font-medium
                                    text-violet-soft
                                "
                            >
                                {{ __('luma.common.work') }}
                            </span>

                        @endif

                    </div>


                @empty

                    <div class="px-5 py-10 text-center">

                        <p class="text-sm text-muted">
                            {{ __('luma.dashboard.nothing_today') }}
                        </p>

                    </div>

                @endforelse

            </div>

        </div>


        {{-- ============================================================ --}}
        {{-- REMAINING OBLIGATIONS --}}
        {{-- ============================================================ --}}

        <div
            id="remaining-obligations"
            class="
                rounded-xl2
                border border-ink-700
                bg-ink-800/60
            "
        >

            <div
                class="
                    flex items-center justify-between
                    border-b border-ink-700
                    px-5 py-4
                "
            >

                <div>

                    <h2 class="font-display text-base font-semibold">
                        {{ __('luma.dashboard.remaining_obligations') }}
                    </h2>


                    <p class="mt-0.5 text-xs text-muted">
                        {{ __('luma.dashboard.remaining_description') }}
                    </p>

                </div>


                <span
                    id="remaining-task-count"
                    class="font-mono text-xs text-muted"
                    data-count="{{ $remainingTasks->count() }}"
                >
                    {{ trans_choice(
                        'luma.dashboard.task_count',
                        $remainingTasks->count(),
                        ['count' => $remainingTasks->count()]
                    ) }}
                </span>

            </div>


            <div
                id="remaining-task-list"
                class="divide-y divide-ink-700"
            >

                @forelse ($remainingTasks as $task)

                    <div
                        class="
                            task-row
                            flex items-center gap-3
                            px-5 py-3.5
                            transition
                            duration-200
                        "
                        data-task-id="{{ $task->id }}"
                        data-list="remaining"
                    >

                        {{-- Checkbox --}}
                        <button
                            type="button"
                            class="
                                task-checkbox
                                flex h-5 w-5 shrink-0
                                items-center justify-center
                                rounded-full
                                border border-ink-600
                                transition
                                hover:border-glow
                            "
                            data-task-id="{{ $task->id }}"
                            aria-pressed="false"
                        >

                            <svg
                                class="
                                    check-icon
                                    hidden
                                    h-3 w-3
                                    text-sage
                                "
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="3"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M5 13l4 4L19 7"
                                />
                            </svg>

                        </button>


                        {{-- Task information --}}
                        <div class="min-w-0 flex-1">

                            <p
                                class="
                                    task-title
                                    truncate
                                    text-sm font-medium
                                    text-paper
                                "
                            >
                                {{ $task->title }}
                            </p>


                            <div
                                class="
                                    mt-0.5
                                    flex flex-wrap
                                    items-center gap-2
                                    text-xs text-muted
                                "
                            >

                                {{-- Category --}}
                                @if ($task->category)

                                    <span class="flex items-center gap-1">

                                        <span
                                            class="h-1.5 w-1.5 rounded-full"
                                            style="
                                                background-color:
                                                    {{ $task->category->color ?? '#F5B942' }}
                                            "
                                        ></span>


                                        <span>

                                            {{ $task->category->name }}

                                            @if ($task->subcategory)
                                                · {{ $task->subcategory->name }}
                                            @endif

                                        </span>

                                    </span>

                                @endif


                                {{-- Due --}}
                                @if ($task->due_at)

                                    <span class="font-mono">
                                        {{ $task->due_at->locale(app()->getLocale())->translatedFormat('j M · H:i') }}
                                    </span>

                                @else

                                    <span class="font-mono">
                                        {{ __('luma.common.no_deadline') }}
                                    </span>

                                @endif


                                {{-- Overdue --}}
                                @if (
                                    $task->due_at &&
                                    $task->due_at->isPast()
                                )

                                    <span
                                        class="
                                            rounded-full
                                            bg-red-500/10
                                            px-2 py-0.5
                                            text-[11px]
                                            font-medium
                                            text-red-400
                                        "
                                    >
                                        {{ __('luma.common.overdue') }}
                                    </span>

                                @endif


                                {{-- Priority --}}
                                @if ($task->priority)

                                    <span class="capitalize">
                                        {{ __('luma.common.' . $task->priority) }}
                                    </span>

                                @endif

                            </div>

                        </div>


                        {{-- Work --}}
                        @if ($task->is_work_related)

                            <span
                                class="
                                    rounded-full
                                    bg-violet/15
                                    px-2 py-0.5
                                    text-[11px]
                                    font-medium
                                    text-violet-soft
                                "
                            >
                                {{ __('luma.common.work') }}
                            </span>

                        @endif

                    </div>


                @empty

                    <div
                        id="remaining-empty-state"
                        class="px-5 py-10 text-center"
                    >

                        <p class="text-sm text-muted">
                            {{ __('luma.dashboard.all_caught_up') }}
                        </p>

                    </div>

                @endforelse

            </div>

        </div>


        {{-- ============================================================ --}}
        {{-- CALENDARS --}}
        {{-- ============================================================ --}}

        @if ($calendars->isNotEmpty())

            <div>

                <div class="mb-3 flex items-center justify-between">

                    <h2 class="font-display text-base font-semibold">
                        {{ __('luma.dashboard.calendars') }}
                    </h2>

                </div>


                <div
                    class="
                        flex gap-4
                        overflow-x-auto
                        pb-2
                        scrollbar-none
                    "
                    x-data
                >

                    @foreach ($calendars as $calendar)

                        <div
                            class="
                                w-64 shrink-0
                                rounded-xl2
                                border border-ink-700
                                bg-ink-800/60
                                p-4
                            "
                        >

                            {{-- Calendar title + delete --}}
                            <div
                                class="
                                    mb-3
                                    flex items-center
                                    justify-between
                                    gap-2
                                "
                            >

                                <div
                                    class="
                                        flex min-w-0
                                        items-center gap-2
                                    "
                                >

                                    <span
                                        class="
                                            h-2 w-2
                                            shrink-0
                                            rounded-full
                                        "
                                        style="
                                            background-color:
                                                {{ $calendar->color ?? '#F5B942' }}
                                        "
                                    ></span>


                                    <p class="truncate text-sm font-semibold">
                                        {{ $calendar->name }}
                                    </p>

                                </div>


                                <form
                                    method="POST"
                                    action="{{ route('calendars.destroy', $calendar) }}"
                                    class="shrink-0"
                                    onsubmit="return confirm(@js(__('luma.dashboard.delete_calendar_confirm', ['name' => $calendar->name])))"
                                >

                                    @csrf
                                    @method('DELETE')


                                    <button
                                        type="submit"
                                        class="
                                            flex h-8 w-8
                                            items-center justify-center
                                            rounded-lg
                                            text-muted/50
                                            transition
                                            hover:bg-red-500/10
                                            hover:text-red-400
                                        "
                                        aria-label="{{ __('luma.dashboard.delete_calendar_aria', ['name' => $calendar->name]) }}"
                                        title="{{ __('luma.dashboard.delete_calendar') }}"
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


                            {{-- Events --}}
                            <ul class="space-y-2">

                                @forelse ($calendar->events as $event)

                                    <li class="text-xs">

                                        <p class="truncate text-paper">
                                            {{ $event->title }}
                                        </p>


                                        <p class="font-mono text-muted">
                                            {{ $event->starts_at->locale(app()->getLocale())->translatedFormat('j M · H:i') }}
                                        </p>


                                        @if ($event->location)

                                            <p class="truncate text-muted/70">
                                                {{ $event->location }}
                                            </p>

                                        @endif

                                    </li>


                                @empty

                                    <li class="text-xs text-muted/70">
                                        {{ __('luma.dashboard.no_upcoming_events') }}
                                    </li>

                                @endforelse

                            </ul>

                        </div>

                    @endforeach

                </div>

            </div>

        @endif

    </div>


    {{-- ================================================================ --}}
    {{-- DASHBOARD SCRIPT --}}
    {{-- ================================================================ --}}

    @push('scripts')

        <script>

            document.addEventListener('DOMContentLoaded', () => {

                const translations = {
                    notificationsBlocked:
                        @json(__('luma.dashboard.notifications_blocked')),

                    notificationsBlockedIphone:
                        @json(__('luma.dashboard.notifications_blocked_iphone')),

                    notificationsBlockedBrowser:
                        @json(__('luma.dashboard.notifications_blocked_browser')),

                    notificationsBlockedDevice:
                        @json(__('luma.dashboard.notifications_blocked_device')),

                    stayOnTrack:
                        @json(__('luma.dashboard.stay_on_track')),

                    allowNotifications:
                        @json(__('luma.dashboard.allow_notifications')),

                    allowNotificationsDescription:
                        @json(__('luma.dashboard.allow_notifications_description')),

                    enablingNotifications:
                        @json(__('luma.dashboard.enabling_notifications')),

                    connectingNotifications:
                        @json(__('luma.dashboard.connecting_notifications')),

                    enabled:
                        @json(__('luma.dashboard.enabled')),

                    notificationsEnabled:
                        @json(__('luma.dashboard.notifications_enabled')),

                    unableToEnableNotifications:
                        @json(__('luma.dashboard.unable_to_enable_notifications')),

                    serviceWorkersUnsupported:
                        @json(__('luma.dashboard.service_workers_unsupported')),

                    pushKeysMissing:
                        @json(__('luma.dashboard.push_keys_missing')),

                    notificationsUnsupported:
                        @json(__('luma.dashboard.notifications_unsupported')),

                    webPushUnsupported:
                        @json(__('luma.dashboard.web_push_unsupported')),

                    vapidMissing:
                        @json(__('luma.dashboard.vapid_missing')),

                    notificationPermissionNotGranted:
                        @json(__('luma.dashboard.notification_permission_not_granted')),

                    unableSavePushSubscription:
                        @json(__('luma.dashboard.unable_save_push_subscription')),

                    completion:
                        @json(__('luma.dashboard.completion')),

                    taskSingular:
                        @json(__('luma.dashboard.task_singular')),

                    taskPlural:
                        @json(__('luma.dashboard.task_plural')),

                    allCaughtUp:
                        @json(__('luma.dashboard.all_caught_up')),
                };

                const circumference =
                    2 * Math.PI * 42;

                let ringValueAnimationFrame =
                    null;

                let ringStrokeAnimationFrame =
                    null;


                // =========================================================
                // DEVICE SETUP + PUSH NOTIFICATIONS
                // =========================================================

                const notificationPrompt =
                    document.getElementById(
                        'notification-prompt'
                    );

                const notificationPromptTitle =
                    document.getElementById(
                        'notification-prompt-title'
                    );

                const enableNotificationsButton =
                    document.getElementById(
                        'enable-notifications'
                    );

                const pushStatus =
                    document.getElementById(
                        'push-status'
                    );

                const iosInstallPrompt =
                    document.getElementById(
                        'ios-install-prompt'
                    );


                const vapidPublicKey =
                    @json(
                        config(
                            'webpush.vapid.public_key'
                        )
                    );


                const csrfToken =
                    document.querySelector(
                        'meta[name="csrf-token"]'
                    )?.content ?? '';


                // =========================================================
                // DEVICE DETECTION
                // =========================================================

                const isIPhone =
                    /iPhone/i.test(
                        navigator.userAgent
                    );


                const isStandalone =
                    window.matchMedia(
                        '(display-mode: standalone)'
                    ).matches ||
                    window.navigator.standalone === true;


                // =========================================================
                // UI STATUS
                // =========================================================

                function setPushStatus(
                    message,
                    type = 'muted'
                ) {

                    if (!pushStatus) {
                        return;
                    }


                    pushStatus.textContent =
                        message;


                    pushStatus.classList.remove(
                        'text-muted',
                        'text-sage',
                        'text-red-400',
                        'text-glow',
                        'text-violet-soft'
                    );


                    const className = {

                        muted:
                            'text-muted',

                        success:
                            'text-sage',

                        error:
                            'text-red-400',

                        info:
                            'text-violet-soft',

                    }[type] ?? 'text-muted';


                    pushStatus.classList.add(
                        className
                    );

                }


                // =========================================================
                // VAPID
                // =========================================================

                function urlBase64ToUint8Array(
                    base64String
                ) {

                    const padding =
                        '='.repeat(
                            (
                                4 -
                                base64String.length % 4
                            ) % 4
                        );


                    const base64 =
                        (
                            base64String +
                            padding
                        )
                            .replace(
                                /-/g,
                                '+'
                            )
                            .replace(
                                /_/g,
                                '/'
                            );


                    const rawData =
                        window.atob(
                            base64
                        );


                    return Uint8Array.from(

                        [...rawData].map(
                            character =>
                                character.charCodeAt(
                                    0
                                )
                        )

                    );

                }


                // =========================================================
                // SERVICE WORKER
                // =========================================================

                async function getPushRegistration() {

                    if (
                        !(
                            'serviceWorker'
                            in navigator
                        )
                    ) {

                        throw new Error(
                            translations.serviceWorkersUnsupported
                        );

                    }


                    const registration =
                        await navigator
                            .serviceWorker
                            .register(
                                '/sw.js'
                            );


                    await navigator
                        .serviceWorker
                        .ready;


                    return registration;

                }


                // =========================================================
                // SAVE PUSH SUBSCRIPTION
                // =========================================================

                async function savePushSubscription(
                    subscription
                ) {

                    const subscriptionJson =
                        subscription.toJSON();


                    if (
                        !subscriptionJson
                            .keys
                            ?.p256dh ||

                        !subscriptionJson
                            .keys
                            ?.auth
                    ) {

                        throw new Error(
                            translations.pushKeysMissing
                        );

                    }


                    const response =
                        await fetch(

                            '{{ route('push.subscribe') }}',

                            {

                                method:
                                    'POST',

                                headers: {

                                    'Content-Type':
                                        'application/json',

                                    'Accept':
                                        'application/json',

                                    'X-CSRF-TOKEN':
                                        csrfToken,

                                    'X-Requested-With':
                                        'XMLHttpRequest',

                                },


                                body:
                                    JSON.stringify({

                                        endpoint:
                                            subscription.endpoint,


                                        keys: {

                                            p256dh:
                                                subscriptionJson
                                                    .keys
                                                    .p256dh,

                                            auth:
                                                subscriptionJson
                                                    .keys
                                                    .auth,

                                        },


                                        content_encoding:
                                            PushManager
                                                .supportedContentEncodings
                                                ?.[0]
                                            ?? 'aes128gcm',

                                    }),

                            }

                        );


                    if (!response.ok) {

                        const body =
                            await response
                                .text();


                        throw new Error(
                            translations.unableSavePushSubscription.replace(':error', body)
                        );

                    }

                }


                // =========================================================
                // ENABLE PUSH NOTIFICATIONS
                // =========================================================

                async function enablePushNotifications() {

                    if (
                        !(
                            'Notification'
                            in window
                        )
                    ) {

                        throw new Error(
                            translations.notificationsUnsupported
                        );

                    }


                    if (
                        !(
                            'PushManager'
                            in window
                        )
                    ) {

                        throw new Error(
                            translations.webPushUnsupported
                        );

                    }


                    if (!vapidPublicKey) {

                        throw new Error(
                            translations.vapidMissing
                        );

                    }


                    let permission =
                        Notification.permission;


                    if (
                        permission ===
                        'denied'
                    ) {

                        throw new Error(
                            translations.notificationsBlockedDevice
                        );

                    }


                    if (
                        permission !==
                        'granted'
                    ) {

                        permission =
                            await Notification
                                .requestPermission();

                    }


                    if (
                        permission !==
                        'granted'
                    ) {

                        throw new Error(
                            translations.notificationPermissionNotGranted
                        );

                    }


                    const registration =
                        await getPushRegistration();


                    let subscription =
                        await registration
                            .pushManager
                            .getSubscription();


                    if (!subscription) {

                        subscription =
                            await registration
                                .pushManager
                                .subscribe({

                                    userVisibleOnly:
                                        true,


                                    applicationServerKey:
                                        urlBase64ToUint8Array(
                                            vapidPublicKey
                                        ),

                                });

                    }


                    await savePushSubscription(
                        subscription
                    );


                    return subscription;

                }


                // =========================================================
                // REFRESH SETUP PROMPTS
                // =========================================================

                async function refreshDevicePrompts() {

                    /*
                     * iPhone opened in normal browser.
                     *
                     * First ask the user to install Luma.
                     */

                    if (
                        isIPhone &&
                        !isStandalone
                    ) {

                        iosInstallPrompt
                            ?.classList
                            .remove(
                                'hidden'
                            );


                        notificationPrompt
                            ?.classList
                            .add(
                                'hidden'
                            );


                        return;

                    }


                    /*
                     * Not an iPhone browser,
                     * or already running installed.
                     */

                    iosInstallPrompt
                        ?.classList
                        .add(
                            'hidden'
                        );


                    /*
                     * No Web Push support.
                     */

                    if (
                        !(
                            'Notification'
                            in window
                        ) ||

                        !(
                            'serviceWorker'
                            in navigator
                        ) ||

                        !(
                            'PushManager'
                            in window
                        )
                    ) {

                        notificationPrompt
                            ?.classList
                            .add(
                                'hidden'
                            );


                        return;

                    }


                    /*
                     * User has explicitly blocked notifications.
                     */

                    if (
                        Notification.permission ===
                        'denied'
                    ) {

                        notificationPrompt
                            ?.classList
                            .remove(
                                'hidden'
                            );


                        if (
                            notificationPromptTitle
                        ) {

                            notificationPromptTitle
                                .textContent =
                                translations.notificationsBlocked;

                        }


                        setPushStatus(

                            isIPhone
                                ? translations.notificationsBlockedIphone
                                : translations.notificationsBlockedBrowser,

                            'error'

                        );


                        enableNotificationsButton
                            ?.classList
                            .add(
                                'hidden'
                            );


                        return;

                    }


                    /*
                     * Check active subscription.
                     */

                    try {

                        const registration =
                            await navigator
                                .serviceWorker
                                .getRegistration(
                                    '/'
                                );


                        const subscription =
                            registration
                                ? await registration
                                    .pushManager
                                    .getSubscription()
                                : null;


                        /*
                         * Fully configured.
                         *
                         * Nothing needs to be shown.
                         */

                        if (
                            Notification.permission ===
                                'granted' &&
                            subscription
                        ) {

                            notificationPrompt
                                ?.classList
                                .add(
                                    'hidden'
                                );


                            return;

                        }

                    } catch (error) {

                        console.error(
                            'Unable to inspect push subscription:',
                            error
                        );

                    }


                    /*
                     * Notifications still need setup.
                     */

                    notificationPrompt
                        ?.classList
                        .remove(
                            'hidden'
                        );


                    if (
                        notificationPromptTitle
                    ) {

                        notificationPromptTitle
                            .textContent =
                            translations.stayOnTrack;

                    }


                    if (
                        enableNotificationsButton
                    ) {

                        enableNotificationsButton
                            .classList
                            .remove(
                                'hidden'
                            );


                        enableNotificationsButton
                            .disabled =
                            false;


                        enableNotificationsButton
                            .textContent =
                            translations.allowNotifications;

                    }


                    setPushStatus(
                        translations.allowNotificationsDescription,
                        'muted'
                    );

                }


                // =========================================================
                // ENABLE NOTIFICATIONS BUTTON
                // =========================================================

                enableNotificationsButton
                    ?.addEventListener(

                        'click',

                        async () => {

                            const originalText =
                                enableNotificationsButton
                                    .textContent;


                            enableNotificationsButton
                                .disabled =
                                true;


                            enableNotificationsButton
                                .textContent =
                                translations.enablingNotifications;


                            setPushStatus(
                                translations.connectingNotifications,
                                'info'
                            );


                            try {

                                await enablePushNotifications();


                                enableNotificationsButton
                                    .textContent =
                                    translations.enabled;


                                setPushStatus(
                                    translations.notificationsEnabled,
                                    'success'
                                );


                                /*
                                 * Let user see success briefly,
                                 * then remove prompt.
                                 */

                                window.setTimeout(

                                    () => {

                                        notificationPrompt
                                            ?.classList
                                            .add(
                                                'hidden'
                                            );

                                    },

                                    900

                                );

                            } catch (error) {

                                console.error(
                                    'Unable to enable notifications:',
                                    error
                                );


                                if (
                                    (
                                        'Notification'
                                        in window
                                    ) &&

                                    Notification.permission ===
                                        'denied'
                                ) {

                                    if (
                                        notificationPromptTitle
                                    ) {

                                        notificationPromptTitle
                                            .textContent =
                                            translations.notificationsBlocked;

                                    }


                                    setPushStatus(

                                        isIPhone
                                            ? translations.notificationsBlockedIphone
                                            : translations.notificationsBlockedBrowser,

                                        'error'

                                    );


                                    enableNotificationsButton
                                        .classList
                                        .add(
                                            'hidden'
                                        );

                                } else {

                                    enableNotificationsButton
                                        .textContent =
                                        originalText;


                                    setPushStatus(

                                        error.message ??
                                        translations.unableToEnableNotifications,

                                        'error'

                                    );

                                }

                            } finally {

                                enableNotificationsButton
                                    .disabled =
                                    false;

                            }

                        }

                    );


                // =========================================================
                // INITIALIZE DEVICE PROMPTS
                // =========================================================

                refreshDevicePrompts();


                // =========================================================
                // COMPLETION RING
                // =========================================================

                function updateCompletionPercentage(
                    percentage
                ) {

                    const sentence =
                        document.getElementById(
                            'completion-sentence'
                        );

                    const ringValue =
                        document.getElementById(
                            'glow-ring-value'
                        );

                    const ringProgress =
                        document.getElementById(
                            'glow-ring-progress'
                        );

                    const ring =
                        document.getElementById(
                            'glow-ring'
                        );


                    percentage =
                        Math.max(
                            0,
                            Math.min(
                                100,
                                Number(
                                    percentage
                                )
                            )
                        );


                    /*
                     * Animate ring.
                     */

                    if (ringProgress) {

                        if (
                            ringStrokeAnimationFrame !==
                            null
                        ) {

                            cancelAnimationFrame(
                                ringStrokeAnimationFrame
                            );

                        }


                        const computedOffset =
                            parseFloat(

                                getComputedStyle(
                                    ringProgress
                                ).strokeDashoffset

                            );


                        const startOffset =
                            Number.isFinite(
                                computedOffset
                            )
                                ? computedOffset
                                : circumference;


                        const targetOffset =
                            circumference *
                            (
                                1 -
                                percentage / 100
                            );


                        const difference =
                            targetOffset -
                            startOffset;


                        const duration =
                            750;


                        const startTime =
                            performance.now();


                        const animateRing =
                            currentTime => {

                                const elapsed =
                                    currentTime -
                                    startTime;


                                const progress =
                                    Math.min(
                                        elapsed /
                                        duration,
                                        1
                                    );


                                const eased =
                                    1 -
                                    Math.pow(
                                        1 - progress,
                                        3
                                    );


                                const currentOffset =
                                    startOffset +
                                    difference *
                                    eased;


                                ringProgress
                                    .style
                                    .strokeDashoffset =
                                    `${currentOffset}px`;


                                if (
                                    progress < 1
                                ) {

                                    ringStrokeAnimationFrame =
                                        requestAnimationFrame(
                                            animateRing
                                        );

                                } else {

                                    ringProgress
                                        .style
                                        .strokeDashoffset =
                                        `${targetOffset}px`;


                                    ringStrokeAnimationFrame =
                                        null;

                                }

                            };


                        ringStrokeAnimationFrame =
                            requestAnimationFrame(
                                animateRing
                            );

                    }


                    /*
                     * Glow strength.
                     */

                    if (ring) {

                        ring.style.boxShadow =

                            `0 0 ${
                                20 +
                                percentage *
                                0.4
                            }px -4px ` +

                            `rgba(
                                245,
                                185,
                                66,
                                ${
                                    0.15 +
                                    (
                                        percentage /
                                        100
                                    ) *
                                    0.45
                                }
                            )`;

                    }


                    /*
                     * Animate percentage number.
                     */

                    if (ringValue) {

                        if (
                            ringValueAnimationFrame !==
                            null
                        ) {

                            cancelAnimationFrame(
                                ringValueAnimationFrame
                            );

                        }


                        const currentPercentage =
                            parseInt(
                                ringValue.textContent,
                                10
                            ) || 0;


                        const difference =
                            percentage -
                            currentPercentage;


                        const duration =
                            650;


                        const startTime =
                            performance.now();


                        const animateNumber =
                            currentTime => {

                                const elapsed =
                                    currentTime -
                                    startTime;


                                const progress =
                                    Math.min(
                                        elapsed /
                                        duration,
                                        1
                                    );


                                const eased =
                                    1 -
                                    Math.pow(
                                        1 - progress,
                                        3
                                    );


                                const value =
                                    Math.round(

                                        currentPercentage +
                                        difference *
                                        eased

                                    );


                                ringValue.textContent =
                                    `${value}%`;


                                if (
                                    progress < 1
                                ) {

                                    ringValueAnimationFrame =
                                        requestAnimationFrame(
                                            animateNumber
                                        );

                                } else {

                                    ringValue.textContent =
                                        `${percentage}%`;


                                    ringValueAnimationFrame =
                                        null;

                                }

                            };


                        ringValueAnimationFrame =
                            requestAnimationFrame(
                                animateNumber
                            );

                    }


                    if (sentence) {

                        sentence.textContent =
                            translations.completion.replace(':percentage', percentage);

                    }

                }


                // =========================================================
                // REMAINING TASK COUNTER
                // =========================================================

                function updateRemainingCount() {

                    const countElement =
                        document.getElementById(
                            'remaining-task-count'
                        );


                    const list =
                        document.getElementById(
                            'remaining-task-list'
                        );


                    if (
                        !countElement ||
                        !list
                    ) {

                        return;

                    }


                    const rows =
                        list.querySelectorAll(
                            '.task-row[data-list="remaining"]'
                        );


                    const count =
                        rows.length;


                    countElement.dataset.count =
                        count;


                    countElement.textContent =
                        `${count} ${
                            count === 1
                                ? translations.taskSingular
                                : translations.taskPlural
                        }`;


                    if (
                        count === 0
                    ) {

                        const existingEmptyState =
                            document.getElementById(
                                'remaining-empty-state'
                            );


                        if (
                            !existingEmptyState
                        ) {

                            const empty =
                                document.createElement(
                                    'div'
                                );


                            empty.id =
                                'remaining-empty-state';


                            empty.className =
                                'px-5 py-10 text-center';


                            empty.innerHTML = `

                                <p class="text-sm text-muted">
                                    {{ __('luma.dashboard.all_caught_up') }}
                                </p>

                            `;


                            list.appendChild(
                                empty
                            );

                        }

                    }

                }


                // =========================================================
                // TASK CHECKBOXES
                // =========================================================

                document
                    .querySelectorAll(
                        '.task-checkbox'
                    )
                    .forEach(
                        button => {

                            button.addEventListener(

                                'click',

                                async () => {

                                    if (
                                        button.disabled
                                    ) {

                                        return;

                                    }


                                    const taskId =
                                        button.dataset
                                            .taskId;


                                    const row =
                                        button.closest(
                                            '.task-row'
                                        );


                                    if (!row) {
                                        return;
                                    }


                                    const title =
                                        row.querySelector(
                                            '.task-title'
                                        );


                                    const checkIcon =
                                        button.querySelector(
                                            '.check-icon'
                                        );


                                    button.disabled =
                                        true;


                                    button.classList.add(
                                        'opacity-60'
                                    );


                                    try {

                                        const response =
                                            await fetch(

                                                `/tasks/${taskId}/toggle`,

                                                {

                                                    method:
                                                        'PATCH',


                                                    headers: {

                                                        'X-CSRF-TOKEN':
                                                            document
                                                                .querySelector(
                                                                    'meta[name="csrf-token"]'
                                                                )
                                                                ?.content
                                                            ?? '',


                                                        'Accept':
                                                            'application/json',


                                                        'X-Requested-With':
                                                            'XMLHttpRequest',

                                                    },

                                                }

                                            );


                                        if (
                                            !response.ok
                                        ) {

                                            throw new Error(
                                                `Request failed with status ${response.status}`
                                            );

                                        }


                                        const data =
                                            await response
                                                .json();


                                        const isCompleted =
                                            Boolean(
                                                data.is_completed
                                            );


                                        /*
                                         * Checkbox.
                                         */

                                        button.setAttribute(

                                            'aria-pressed',

                                            isCompleted
                                                ? 'true'
                                                : 'false'

                                        );


                                        button.classList.toggle(
                                            'border-sage',
                                            isCompleted
                                        );


                                        button.classList.toggle(
                                            'bg-sage/20',
                                            isCompleted
                                        );


                                        button.classList.toggle(
                                            'border-ink-600',
                                            !isCompleted
                                        );


                                        if (
                                            checkIcon
                                        ) {

                                            checkIcon
                                                .classList
                                                .toggle(
                                                    'hidden',
                                                    !isCompleted
                                                );

                                        }


                                        /*
                                         * Title.
                                         */

                                        if (title) {

                                            title.classList.toggle(
                                                'text-muted',
                                                isCompleted
                                            );


                                            title.classList.toggle(
                                                'line-through',
                                                isCompleted
                                            );


                                            title.classList.toggle(
                                                'text-paper',
                                                !isCompleted
                                            );

                                        }


                                        /*
                                         * Dashboard percentage.
                                         */

                                        if (
                                            typeof data
                                                .completion_percentage
                                            !==
                                            'undefined'
                                        ) {

                                            updateCompletionPercentage(

                                                Number(
                                                    data
                                                        .completion_percentage
                                                )

                                            );

                                        }


                                        /*
                                         * Remove completed item
                                         * from remaining list.
                                         */

                                        if (
                                            row.dataset.list ===
                                                'remaining' &&
                                            isCompleted
                                        ) {

                                            row.classList.add(
                                                'opacity-0',
                                                '-translate-y-1'
                                            );


                                            setTimeout(

                                                () => {

                                                    row.remove();

                                                    updateRemainingCount();

                                                },

                                                200

                                            );

                                        }

                                    } catch (error) {

                                        console.error(
                                            'Unable to toggle task:',
                                            error
                                        );

                                    } finally {

                                        button.disabled =
                                            false;


                                        button.classList.remove(
                                            'opacity-60'
                                        );

                                    }

                                }

                            );

                        }
                    );

            });

        </script>

    @endpush

</x-layouts.app>