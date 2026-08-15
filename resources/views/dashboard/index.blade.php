<x-layouts.app title="Today">
    <div class="mx-auto max-w-5xl space-y-8">

        {{-- Header --}}
        <div class="flex flex-col items-start justify-between gap-6 sm:flex-row sm:items-center">
            <div>
                <p class="text-sm text-muted">
                    {{ now()->translatedFormat('l, j F') }}
                </p>

                <h1 class="font-display text-2xl font-semibold text-paper sm:text-3xl">
                    Today's plan
                </h1>
            </div>

            {{-- Completion glow ring --}}
            <div
                id="glow-ring"
                class="relative flex h-24 w-24 items-center justify-center rounded-full"
                style="
                    box-shadow: 0 0 {{ 20 + $completionPercentage * 0.4 }}px -4px rgba(245, 185, 66, {{ 0.15 + ($completionPercentage / 100) * 0.45 }});
                    transition: box-shadow 750ms cubic-bezier(0.22, 1, 0.36, 1);
                    will-change: box-shadow;
                "
            >
                <svg class="h-24 w-24 -rotate-90" viewBox="0 0 100 100">
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
                        style="
                            will-change: stroke-dashoffset;
                        "
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
                {{ $completionPercentage }}% of today's tasks are done.
            </span>
        </p>

        {{-- ============================================================ --}}
        {{-- PUSH NOTIFICATIONS --}}
        {{-- ============================================================ --}}

        <div
            class="rounded-xl2 border border-ink-700 bg-ink-800/60 p-4 sm:p-5"
        >
            <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                <div class="flex items-start gap-3">
                    <div
                        class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl border border-glow/20 bg-glow/10 text-glow"
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
                        <h2 class="text-sm font-semibold text-paper">
                            Notifications
                        </h2>

                        <p
                            id="push-status"
                            class="mt-1 text-xs leading-5 text-muted"
                        >
                            Enable push notifications, then send a test from Laravel.
                        </p>
                    </div>
                </div>

                <div class="flex flex-wrap gap-2">
                    <button
                        id="enable-notifications"
                        type="button"
                        class="rounded-lg bg-glow px-3.5 py-2 text-xs font-semibold text-ink-950 transition hover:brightness-110 disabled:cursor-not-allowed disabled:opacity-60"
                    >
                        Enable notifications
                    </button>

                    <button
                        id="send-test-notification"
                        type="button"
                        class="rounded-lg border border-ink-600 bg-ink-900 px-3.5 py-2 text-xs font-medium text-paper transition hover:border-glow/40 hover:bg-ink-700 disabled:cursor-not-allowed disabled:opacity-60"
                    >
                        Send test
                    </button>
                </div>
            </div>
        </div>

        {{-- Categories --}}
        @if ($categories->isNotEmpty())
            <div class="flex flex-wrap gap-2">
                @foreach ($categories as $category)
                    <a
                        href="{{ route('categories.show', $category) }}"
                        class="flex items-center gap-2 rounded-full border border-ink-600 bg-ink-800 px-3.5 py-1.5 text-sm font-medium text-paper transition hover:border-glow/50 hover:bg-ink-700"
                    >
                        <span
                            class="h-2 w-2 rounded-full"
                            style="background-color: {{ $category->color ?? '#F5B942' }}"
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
            class="rounded-xl2 border border-ink-700 bg-ink-800/60"
        >
            <div class="flex items-center justify-between border-b border-ink-700 px-5 py-4">
                <h2 class="font-display text-base font-semibold">
                    Today's obligations
                </h2>

                <span
                    id="today-task-count"
                    class="font-mono text-xs text-muted"
                >
                    {{ $todaysTasks->count() }}
                    task{{ $todaysTasks->count() === 1 ? '' : 's' }}
                </span>
            </div>

            <div class="divide-y divide-ink-700">
                @forelse ($todaysTasks as $task)
                    <div
                        class="task-row flex items-center gap-3 px-5 py-3.5"
                        data-task-id="{{ $task->id }}"
                        data-list="today"
                    >
                        {{-- Checkbox --}}
                        <button
                            type="button"
                            class="task-checkbox flex h-5 w-5 shrink-0 items-center justify-center rounded-full border transition
                            {{ $task->is_completed
                                ? 'border-sage bg-sage/20'
                                : 'border-ink-600 hover:border-glow'
                            }}"
                            data-task-id="{{ $task->id }}"
                            aria-pressed="{{ $task->is_completed ? 'true' : 'false' }}"
                        >
                            <svg
                                class="check-icon h-3 w-3 text-sage {{ $task->is_completed ? '' : 'hidden' }}"
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
                                class="task-title truncate text-sm font-medium
                                {{ $task->is_completed
                                    ? 'text-muted line-through'
                                    : 'text-paper'
                                }}"
                            >
                                {{ $task->title }}
                            </p>

                            <div class="mt-0.5 flex flex-wrap items-center gap-2 text-xs text-muted">

                                @if ($task->category)
                                    <span class="flex items-center gap-1">
                                        <span
                                            class="h-1.5 w-1.5 rounded-full"
                                            style="background-color: {{ $task->category->color ?? '#F5B942' }}"
                                        ></span>

                                        <span>
                                            {{ $task->category->name }}

                                            @if ($task->subcategory)
                                                · {{ $task->subcategory->name }}
                                            @endif
                                        </span>
                                    </span>
                                @endif

                                @if ($task->due_at)
                                    <span class="font-mono">
                                        {{ $task->due_at->format('H:i') }}
                                    </span>
                                @endif

                                @if ($task->priority)
                                    <span class="capitalize">
                                        {{ $task->priority }}
                                    </span>
                                @endif
                            </div>
                        </div>

                        {{-- Work badge --}}
                        @if ($task->is_work_related)
                            <span class="rounded-full bg-violet/15 px-2 py-0.5 text-[11px] font-medium text-violet-soft">
                                Work
                            </span>
                        @endif
                    </div>

                @empty
                    <div class="px-5 py-10 text-center">
                        <p class="text-sm text-muted">
                            Nothing on the books for today.
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
            class="rounded-xl2 border border-ink-700 bg-ink-800/60"
        >
            <div class="flex items-center justify-between border-b border-ink-700 px-5 py-4">
                <div>
                    <h2 class="font-display text-base font-semibold">
                        Remaining obligations
                    </h2>

                    <p class="mt-0.5 text-xs text-muted">
                        Upcoming, overdue and unscheduled tasks
                    </p>
                </div>

                <span
                    id="remaining-task-count"
                    class="font-mono text-xs text-muted"
                    data-count="{{ $remainingTasks->count() }}"
                >
                    {{ $remainingTasks->count() }}
                    task{{ $remainingTasks->count() === 1 ? '' : 's' }}
                </span>
            </div>

            <div
                id="remaining-task-list"
                class="divide-y divide-ink-700"
            >
                @forelse ($remainingTasks as $task)
                    <div
                        class="task-row flex items-center gap-3 px-5 py-3.5 transition duration-200"
                        data-task-id="{{ $task->id }}"
                        data-list="remaining"
                    >
                        {{-- Checkbox --}}
                        <button
                            type="button"
                            class="task-checkbox flex h-5 w-5 shrink-0 items-center justify-center rounded-full border border-ink-600 transition hover:border-glow"
                            data-task-id="{{ $task->id }}"
                            aria-pressed="false"
                        >
                            <svg
                                class="check-icon hidden h-3 w-3 text-sage"
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
                            <p class="task-title truncate text-sm font-medium text-paper">
                                {{ $task->title }}
                            </p>

                            <div class="mt-0.5 flex flex-wrap items-center gap-2 text-xs text-muted">

                                {{-- Category --}}
                                @if ($task->category)
                                    <span class="flex items-center gap-1">
                                        <span
                                            class="h-1.5 w-1.5 rounded-full"
                                            style="background-color: {{ $task->category->color ?? '#F5B942' }}"
                                        ></span>

                                        <span>
                                            {{ $task->category->name }}

                                            @if ($task->subcategory)
                                                · {{ $task->subcategory->name }}
                                            @endif
                                        </span>
                                    </span>
                                @endif

                                {{-- Due date --}}
                                @if ($task->due_at)
                                    <span class="font-mono">
                                        {{ $task->due_at->format('j M · H:i') }}
                                    </span>
                                @else
                                    <span class="font-mono">
                                        No deadline
                                    </span>
                                @endif

                                {{-- Overdue badge --}}
                                @if ($task->due_at && $task->due_at->isPast())
                                    <span class="rounded-full bg-red-500/10 px-2 py-0.5 text-[11px] font-medium text-red-400">
                                        Overdue
                                    </span>
                                @endif

                                {{-- Priority --}}
                                @if ($task->priority)
                                    <span class="capitalize">
                                        {{ $task->priority }}
                                    </span>
                                @endif
                            </div>
                        </div>

                        {{-- Work badge --}}
                        @if ($task->is_work_related)
                            <span class="rounded-full bg-violet/15 px-2 py-0.5 text-[11px] font-medium text-violet-soft">
                                Work
                            </span>
                        @endif
                    </div>

                @empty
                    <div
                        id="remaining-empty-state"
                        class="px-5 py-10 text-center"
                    >
                        <p class="text-sm text-muted">
                            You're all caught up.
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
                        Calendars
                    </h2>
                </div>

                <div
                    class="flex gap-4 overflow-x-auto pb-2 scrollbar-none"
                    x-data
                >
                    @foreach ($calendars as $calendar)
                        <div class="w-64 shrink-0 rounded-xl2 border border-ink-700 bg-ink-800/60 p-4">

                            {{-- Calendar title + delete --}}
                            <div class="mb-3 flex items-center justify-between gap-2">
                                <div class="flex min-w-0 items-center gap-2">
                                    <span
                                        class="h-2 w-2 shrink-0 rounded-full"
                                        style="background-color: {{ $calendar->color ?? '#F5B942' }}"
                                    ></span>

                                    <p class="truncate text-sm font-semibold">
                                        {{ $calendar->name }}
                                    </p>
                                </div>

                                <form
                                    method="POST"
                                    action="{{ route('calendars.destroy', $calendar) }}"
                                    class="shrink-0"
                                    onsubmit="return confirm('Delete {{ addslashes($calendar->name) }} and all events inside it?')"
                                >
                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="
                                            flex h-8 w-8 items-center justify-center
                                            rounded-lg
                                            text-muted/50
                                            transition
                                            hover:bg-red-500/10
                                            hover:text-red-400
                                        "
                                        aria-label="Delete {{ $calendar->name }}"
                                        title="Delete calendar"
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
                                            {{ $event->starts_at->format('j M · H:i') }}
                                        </p>

                                        @if ($event->location)
                                            <p class="truncate text-muted/70">
                                                {{ $event->location }}
                                            </p>
                                        @endif
                                    </li>
                                @empty
                                    <li class="text-xs text-muted/70">
                                        No upcoming events
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
    {{-- TASK CHECKBOX SCRIPT --}}
    {{-- ================================================================ --}}

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', () => {

                const circumference = 2 * Math.PI * 42;
                let ringValueAnimationFrame = null;
                let ringStrokeAnimationFrame = null;

                // =========================================================
                // PUSH NOTIFICATIONS
                // =========================================================

                const enableNotificationsButton =
                    document.getElementById('enable-notifications');

                const sendTestNotificationButton =
                    document.getElementById('send-test-notification');

                const pushStatus =
                    document.getElementById('push-status');

                const vapidPublicKey =
                    @json(config('webpush.vapid.public_key'));

                const csrfToken =
                    document.querySelector('meta[name="csrf-token"]')?.content ?? '';

                function setPushStatus(message, type = 'muted') {
                    if (!pushStatus) {
                        return;
                    }

                    pushStatus.textContent = message;

                    pushStatus.classList.remove(
                        'text-muted',
                        'text-sage',
                        'text-red-400',
                        'text-glow'
                    );

                    const className = {
                        muted: 'text-muted',
                        success: 'text-sage',
                        error: 'text-red-400',
                        info: 'text-glow',
                    }[type] ?? 'text-muted';

                    pushStatus.classList.add(className);
                }

                function urlBase64ToUint8Array(base64String) {
                    const padding =
                        '='.repeat((4 - base64String.length % 4) % 4);

                    const base64 =
                        (base64String + padding)
                            .replace(/-/g, '+')
                            .replace(/_/g, '/');

                    const rawData = window.atob(base64);

                    return Uint8Array.from(
                        [...rawData].map(
                            character => character.charCodeAt(0)
                        )
                    );
                }

                async function getPushRegistration() {
                    if (!('serviceWorker' in navigator)) {
                        throw new Error(
                            'Service workers are not supported in this browser.'
                        );
                    }

                    const registration =
                        await navigator.serviceWorker.register('/sw.js');

                    await navigator.serviceWorker.ready;

                    return registration;
                }

                async function savePushSubscription(subscription) {
                    const subscriptionJson = subscription.toJSON();

                    if (
                        !subscriptionJson.keys?.p256dh ||
                        !subscriptionJson.keys?.auth
                    ) {
                        throw new Error(
                            'The browser did not return push encryption keys.'
                        );
                    }

                    const response = await fetch(
                        '{{ route('push.subscribe') }}',
                        {
                            method: 'POST',

                            headers: {
                                'Content-Type': 'application/json',
                                'Accept': 'application/json',
                                'X-CSRF-TOKEN': csrfToken,
                                'X-Requested-With': 'XMLHttpRequest',
                            },

                            body: JSON.stringify({
                                endpoint: subscription.endpoint,

                                keys: {
                                    p256dh: subscriptionJson.keys.p256dh,
                                    auth: subscriptionJson.keys.auth,
                                },

                                content_encoding:
                                    PushManager.supportedContentEncodings?.[0]
                                    ?? 'aes128gcm',
                            }),
                        }
                    );

                    if (!response.ok) {
                        const body = await response.text();

                        throw new Error(
                            `Unable to save push subscription: ${body}`
                        );
                    }
                }

                async function enablePushNotifications() {
                    if (!('Notification' in window)) {
                        throw new Error(
                            'Notifications are not supported in this browser.'
                        );
                    }

                    if (!('PushManager' in window)) {
                        throw new Error(
                            'Web Push is not supported in this browser.'
                        );
                    }

                    if (!vapidPublicKey) {
                        throw new Error(
                            'VAPID public key is missing from Laravel configuration.'
                        );
                    }

                    let permission = Notification.permission;

                    if (permission !== 'granted') {
                        permission =
                            await Notification.requestPermission();
                    }

                    if (permission !== 'granted') {
                        throw new Error(
                            'Notification permission was not granted.'
                        );
                    }

                    const registration =
                        await getPushRegistration();

                    let subscription =
                        await registration.pushManager.getSubscription();

                    if (!subscription) {
                        subscription =
                            await registration.pushManager.subscribe({
                                userVisibleOnly: true,

                                applicationServerKey:
                                    urlBase64ToUint8Array(
                                        vapidPublicKey
                                    ),
                            });
                    }

                    await savePushSubscription(subscription);

                    return subscription;
                }

                async function refreshPushStatus() {
                    if (
                        !('Notification' in window) ||
                        !('serviceWorker' in navigator) ||
                        !('PushManager' in window)
                    ) {
                        setPushStatus(
                            'Push notifications are not supported in this browser.',
                            'error'
                        );

                        if (enableNotificationsButton) {
                            enableNotificationsButton.disabled = true;
                        }

                        if (sendTestNotificationButton) {
                            sendTestNotificationButton.disabled = true;
                        }

                        return;
                    }

                    if (Notification.permission === 'denied') {
                        setPushStatus(
                            'Notifications are blocked in browser settings.',
                            'error'
                        );

                        return;
                    }

                    try {
                        const registration =
                            await navigator.serviceWorker.getRegistration('/');

                        const subscription =
                            registration
                                ? await registration.pushManager.getSubscription()
                                : null;

                        if (
                            Notification.permission === 'granted' &&
                            subscription
                        ) {
                            setPushStatus(
                                'Push notifications are enabled on this device.',
                                'success'
                            );

                            if (enableNotificationsButton) {
                                enableNotificationsButton.textContent =
                                    'Enabled ✓';
                            }
                        }
                    } catch (error) {
                        console.error(
                            'Unable to read push status:',
                            error
                        );
                    }
                }

                enableNotificationsButton?.addEventListener(
                    'click',
                    async () => {
                        const originalText =
                            enableNotificationsButton.textContent;

                        enableNotificationsButton.disabled = true;
                        enableNotificationsButton.textContent =
                            'Enabling...';

                        setPushStatus(
                            'Creating push subscription...',
                            'info'
                        );

                        try {
                            await enablePushNotifications();

                            enableNotificationsButton.textContent =
                                'Enabled ✓';

                            setPushStatus(
                                'Push notifications are enabled on this device.',
                                'success'
                            );
                        } catch (error) {
                            console.error(
                                'Unable to enable notifications:',
                                error
                            );

                            enableNotificationsButton.textContent =
                                originalText;

                            setPushStatus(
                                error.message ??
                                'Unable to enable notifications.',
                                'error'
                            );
                        } finally {
                            enableNotificationsButton.disabled = false;
                        }
                    }
                );

                sendTestNotificationButton?.addEventListener(
                    'click',
                    async () => {
                        const originalText =
                            sendTestNotificationButton.textContent;

                        sendTestNotificationButton.disabled = true;
                        sendTestNotificationButton.textContent =
                            'Sending...';

                        setPushStatus(
                            'Sending a test push from Laravel...',
                            'info'
                        );

                        try {
                            const response = await fetch(
                                '{{ route('push.test') }}',
                                {
                                    method: 'POST',

                                    headers: {
                                        'Accept': 'application/json',
                                        'X-CSRF-TOKEN': csrfToken,
                                        'X-Requested-With': 'XMLHttpRequest',
                                    },
                                }
                            );

                            if (!response.ok) {
                                const body =
                                    await response.text();

                                throw new Error(
                                    `Test push failed: ${body}`
                                );
                            }

                            sendTestNotificationButton.textContent =
                                'Sent ✓';

                            setPushStatus(
                                'Test push was sent from Laravel.',
                                'success'
                            );

                            window.setTimeout(() => {
                                sendTestNotificationButton.textContent =
                                    originalText;
                            }, 1600);
                        } catch (error) {
                            console.error(
                                'Unable to send test notification:',
                                error
                            );

                            sendTestNotificationButton.textContent =
                                originalText;

                            setPushStatus(
                                error.message ??
                                'Unable to send test notification.',
                                'error'
                            );
                        } finally {
                            sendTestNotificationButton.disabled = false;
                        }
                    }
                );

                refreshPushStatus();

                /**
                 * Update today's completion ring.
                 */
                function updateCompletionPercentage(percentage) {
                    const sentence = document.getElementById('completion-sentence');
                    const ringValue = document.getElementById('glow-ring-value');
                    const ringProgress = document.getElementById('glow-ring-progress');
                    const ring = document.getElementById('glow-ring');

                    percentage = Math.max(
                        0,
                        Math.min(100, Number(percentage))
                    );

                    /*
                     * Smoothly animate the SVG progress ring manually.
                     * This avoids browsers snapping presentation attributes
                     * such as stroke-dashoffset directly to the new value.
                     */
                    if (ringProgress) {
                        if (ringStrokeAnimationFrame !== null) {
                            cancelAnimationFrame(ringStrokeAnimationFrame);
                        }

                        const computedOffset = parseFloat(
                            getComputedStyle(ringProgress).strokeDashoffset
                        );

                        const startOffset = Number.isFinite(computedOffset)
                            ? computedOffset
                            : circumference;

                        const targetOffset =
                            circumference * (1 - percentage / 100);

                        const difference = targetOffset - startOffset;
                        const duration = 750;
                        const startTime = performance.now();

                        const animateRing = (currentTime) => {
                            const elapsed = currentTime - startTime;
                            const progress = Math.min(elapsed / duration, 1);

                            // Smooth ease-out cubic.
                            const eased =
                                1 - Math.pow(1 - progress, 3);

                            const currentOffset =
                                startOffset + difference * eased;

                            ringProgress.style.strokeDashoffset =
                                `${currentOffset}px`;

                            if (progress < 1) {
                                ringStrokeAnimationFrame =
                                    requestAnimationFrame(animateRing);
                            } else {
                                ringProgress.style.strokeDashoffset =
                                    `${targetOffset}px`;

                                ringStrokeAnimationFrame = null;
                            }
                        };

                        ringStrokeAnimationFrame =
                            requestAnimationFrame(animateRing);
                    }

                    /*
                     * Smoothly animate the glow around the ring.
                     */
                    if (ring) {
                        ring.style.boxShadow =
                            `0 0 ${20 + percentage * 0.4}px -4px ` +
                            `rgba(245, 185, 66, ${
                                0.15 + (percentage / 100) * 0.45
                            })`;
                    }

                    /*
                     * Animate the percentage number instead of jumping
                     * directly from the old value to the new one.
                     */
                    if (ringValue) {
                        if (ringValueAnimationFrame !== null) {
                            cancelAnimationFrame(ringValueAnimationFrame);
                        }

                        const currentPercentage =
                            parseInt(ringValue.textContent, 10) || 0;

                        const difference =
                            percentage - currentPercentage;

                        const duration = 650;
                        const startTime = performance.now();

                        const animateNumber = (currentTime) => {
                            const elapsed = currentTime - startTime;
                            const progress = Math.min(elapsed / duration, 1);

                            /*
                             * Ease-out cubic.
                             */
                            const eased =
                                1 - Math.pow(1 - progress, 3);

                            const value = Math.round(
                                currentPercentage + difference * eased
                            );

                            ringValue.textContent = `${value}%`;

                            if (progress < 1) {
                                ringValueAnimationFrame =
                                    requestAnimationFrame(animateNumber);
                            } else {
                                ringValue.textContent = `${percentage}%`;
                                ringValueAnimationFrame = null;
                            }
                        };

                        ringValueAnimationFrame =
                            requestAnimationFrame(animateNumber);
                    }

                    if (sentence) {
                        sentence.textContent =
                            `${percentage}% of today's tasks are done.`;
                    }
                }

                /**
                 * Update remaining task counter.
                 */
                function updateRemainingCount() {
                    const countElement = document.getElementById('remaining-task-count');
                    const list = document.getElementById('remaining-task-list');

                    if (!countElement || !list) {
                        return;
                    }

                    const rows = list.querySelectorAll(
                        '.task-row[data-list="remaining"]'
                    );

                    const count = rows.length;

                    countElement.dataset.count = count;
                    countElement.textContent =
                        `${count} task${count === 1 ? '' : 's'}`;

                    if (count === 0) {
                        const existingEmptyState =
                            document.getElementById('remaining-empty-state');

                        if (!existingEmptyState) {
                            const empty = document.createElement('div');

                            empty.id = 'remaining-empty-state';
                            empty.className = 'px-5 py-10 text-center';

                            empty.innerHTML = `
                                <p class="text-sm text-muted">
                                    You're all caught up.
                                </p>
                            `;

                            list.appendChild(empty);
                        }
                    }
                }

                /**
                 * Handle all dashboard task checkboxes.
                 */
                document.querySelectorAll('.task-checkbox').forEach(button => {

                    button.addEventListener('click', async () => {

                        if (button.disabled) {
                            return;
                        }

                        const taskId = button.dataset.taskId;

                        const row = button.closest('.task-row');

                        if (!row) {
                            return;
                        }

                        const title = row.querySelector('.task-title');
                        const checkIcon = button.querySelector('.check-icon');

                        button.disabled = true;
                        button.classList.add('opacity-60');

                        try {
                            const response = await fetch(
                                `/tasks/${taskId}/toggle`,
                                {
                                    method: 'PATCH',

                                    headers: {
                                        'X-CSRF-TOKEN':
                                            document.querySelector(
                                                'meta[name="csrf-token"]'
                                            )?.content ?? '',

                                        'Accept': 'application/json',

                                        'X-Requested-With': 'XMLHttpRequest',
                                    },
                                }
                            );

                            if (!response.ok) {
                                throw new Error(
                                    `Request failed with status ${response.status}`
                                );
                            }

                            const data = await response.json();

                            const isCompleted = Boolean(data.is_completed);

                            /*
                             * Checkbox appearance
                             */
                            button.setAttribute(
                                'aria-pressed',
                                isCompleted ? 'true' : 'false'
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

                            if (checkIcon) {
                                checkIcon.classList.toggle(
                                    'hidden',
                                    !isCompleted
                                );
                            }

                            /*
                             * Task title appearance
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
                             * Update today's completion percentage.
                             */
                            if (
                                typeof data.completion_percentage !== 'undefined'
                            ) {
                                updateCompletionPercentage(
                                    Number(data.completion_percentage)
                                );
                            }

                            /*
                             * A completed task is no longer a
                             * "remaining obligation", so remove it.
                             */
                            if (
                                row.dataset.list === 'remaining' &&
                                isCompleted
                            ) {
                                row.classList.add(
                                    'opacity-0',
                                    '-translate-y-1'
                                );

                                setTimeout(() => {
                                    row.remove();
                                    updateRemainingCount();
                                }, 200);
                            }

                        } catch (error) {
                            console.error(
                                'Unable to toggle task:',
                                error
                            );
                        } finally {
                            button.disabled = false;
                            button.classList.remove('opacity-60');
                        }
                    });
                });

            });
        </script>
    @endpush
</x-layouts.app>