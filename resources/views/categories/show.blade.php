<x-layouts.app :title="$category->name">

    <div class="mx-auto max-w-4xl space-y-6">

        {{-- ============================================================ --}}
        {{-- HEADER --}}
        {{-- ============================================================ --}}

        <div
            class="
                flex flex-col gap-4
                sm:flex-row
                sm:items-center
                sm:justify-between
            "
        >

            <div class="flex items-center gap-3">

                <span
                    class="h-3 w-3 shrink-0 rounded-full"
                    style="background-color: {{ $category->color ?? '#F5B942' }}"
                ></span>

                <div>

                    <h1 class="font-display text-2xl font-semibold text-paper">
                        {{ $category->name }}
                    </h1>

                    <p class="mt-1 text-sm text-muted">
                        {{ trans_choice(
                            'luma.categories.task_count',
                            $category->tasks->count(),
                            ['count' => $category->tasks->count()]
                        ) }}
                    </p>

                </div>

            </div>

        </div>


        {{-- ============================================================ --}}
        {{-- STATUS / ERRORS --}}
        {{-- ============================================================ --}}

        @if (session('status'))

            <div
                class="
                    rounded-xl
                    border border-sage/20
                    bg-sage/10
                    px-4 py-3
                    text-sm text-sage
                "
            >
                {{ session('status') }}
            </div>

        @endif


        @if ($errors->any())

            <div
                class="
                    rounded-xl
                    border border-red-500/20
                    bg-red-500/10
                    px-4 py-3
                "
            >

                <ul class="space-y-1 text-sm text-red-400">

                    @foreach ($errors->all() as $error)

                        <li>
                            {{ $error }}
                        </li>

                    @endforeach

                </ul>

            </div>

        @endif


        {{-- ============================================================ --}}
        {{-- SUBCATEGORIES --}}
        {{-- ============================================================ --}}

        <section
            class="
                overflow-hidden
                rounded-xl2
                border border-ink-700
                bg-ink-800/60
            "
        >

            <div class="border-b border-ink-700 px-5 py-4">

                <div
                    class="
                        flex flex-col gap-4
                        sm:flex-row
                        sm:items-center
                        sm:justify-between
                    "
                >

                    <div>

                        <h2
                            class="
                                font-display
                                text-base font-semibold
                                text-paper
                            "
                        >
                            {{ __('luma.categories.subcategories') }}
                        </h2>

                        <p class="mt-1 text-xs text-muted">
                            {{ __(
                                'luma.categories.organize_tasks',
                                ['category' => $category->name]
                            ) }}
                        </p>

                    </div>


                    {{-- Add subcategory --}}
                    <form
                        method="POST"
                        action="{{ route('subcategories.store') }}"
                        class="flex gap-2"
                    >

                        @csrf

                        <input
                            type="hidden"
                            name="category_id"
                            value="{{ $category->id }}"
                        >

                        <input
                            type="text"
                            name="name"
                            value="{{ old('name') }}"
                            placeholder="{{ __('luma.categories.subcategory_name') }}"
                            required
                            class="
                                min-w-0
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
                                px-4 py-2
                                text-sm font-medium
                                text-ink-950
                                transition
                                hover:brightness-110
                            "
                        >
                            {{ __('luma.common.add') }}
                        </button>

                    </form>

                </div>

            </div>


            {{-- Subcategory list --}}
            <div class="divide-y divide-ink-700">

                @forelse ($category->subcategories as $subcategory)

                    <div
                        class="
                            flex items-center
                            justify-between
                            gap-4
                            px-5 py-3.5
                        "
                    >

                        <div class="min-w-0">

                            <p
                                class="
                                    truncate
                                    text-sm font-medium
                                    text-paper
                                "
                            >
                                {{ $subcategory->name }}
                            </p>

                            <p class="mt-0.5 text-xs text-muted">
                                {{ trans_choice(
                                    'luma.categories.task_count',
                                    $subcategory->tasks->count(),
                                    ['count' => $subcategory->tasks->count()]
                                ) }}
                            </p>

                        </div>


                        <form
                            method="POST"
                            action="{{ route('subcategories.destroy', $subcategory) }}"
                            onsubmit="return confirm(@js(__('luma.categories.delete_subcategory_confirm')))"
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

                    <div class="px-5 py-8 text-center">

                        <p class="text-sm text-muted">
                            {{ __('luma.categories.no_subcategories') }}
                        </p>

                    </div>

                @endforelse

            </div>

        </section>


        {{-- ============================================================ --}}
        {{-- ADD TASK --}}
        {{-- ============================================================ --}}

        <section
            class="
                overflow-hidden
                rounded-xl2
                border border-ink-700
                bg-ink-800/60
            "
        >

            <div class="border-b border-ink-700 px-5 py-4">

                <h2
                    class="
                        font-display
                        text-base font-semibold
                        text-paper
                    "
                >
                    {{ __('luma.categories.add_task') }}
                </h2>

                <p class="mt-1 text-xs text-muted">
                    {{ __(
                        'luma.categories.add_task_description',
                        ['category' => $category->name]
                    ) }}
                </p>

            </div>


            <form
                method="POST"
                action="{{ route('tasks.store') }}"
                class="
                    grid gap-4
                    p-5
                    sm:grid-cols-2
                "
            >

                @csrf

                <input
                    type="hidden"
                    name="category_id"
                    value="{{ $category->id }}"
                >


                {{-- Title --}}
                <div class="sm:col-span-2">

                    <label
                        for="title"
                        class="
                            mb-1.5
                            block
                            text-xs font-medium
                            text-muted
                        "
                    >
                        {{ __('luma.categories.task_title') }}
                    </label>

                    <input
                        id="title"
                        type="text"
                        name="title"
                        value="{{ old('title') }}"
                        required
                        placeholder="{{ __('luma.categories.task_title_placeholder') }}"
                        class="
                            w-full
                            rounded-lg
                            border-ink-600
                            bg-ink-900
                            text-sm
                            text-paper
                            placeholder:text-muted/50
                            focus:border-glow
                            focus:ring-glow
                        "
                    >

                </div>


                {{-- Subcategory --}}
                <div>

                    <label
                        for="subcategory_id"
                        class="
                            mb-1.5
                            block
                            text-xs font-medium
                            text-muted
                        "
                    >
                        {{ __('luma.categories.subcategory') }}
                    </label>

                    <select
                        id="subcategory_id"
                        name="subcategory_id"
                        class="
                            w-full
                            rounded-lg
                            border-ink-600
                            bg-ink-900
                            text-sm
                            text-paper
                            focus:border-glow
                            focus:ring-glow
                        "
                    >

                        <option value="">
                            {{ __('luma.categories.no_subcategory') }}
                        </option>

                        @foreach ($category->subcategories as $subcategory)

                            <option
                                value="{{ $subcategory->id }}"
                                @selected(
                                    old('subcategory_id') == $subcategory->id
                                )
                            >
                                {{ $subcategory->name }}
                            </option>

                        @endforeach

                    </select>

                </div>


                {{-- Priority --}}
                <div>

                    <label
                        for="priority"
                        class="
                            mb-1.5
                            block
                            text-xs font-medium
                            text-muted
                        "
                    >
                        {{ __('luma.categories.priority') }}
                    </label>

                    <select
                        id="priority"
                        name="priority"
                        class="
                            w-full
                            rounded-lg
                            border-ink-600
                            bg-ink-900
                            text-sm
                            text-paper
                            focus:border-glow
                            focus:ring-glow
                        "
                    >

                        <option value="">
                            {{ __('luma.categories.no_priority') }}
                        </option>

                        <option
                            value="low"
                            @selected(old('priority') === 'low')
                        >
                            {{ __('luma.common.low') }}
                        </option>

                        <option
                            value="medium"
                            @selected(old('priority') === 'medium')
                        >
                            {{ __('luma.common.medium') }}
                        </option>

                        <option
                            value="high"
                            @selected(old('priority') === 'high')
                        >
                            {{ __('luma.common.high') }}
                        </option>

                    </select>

                </div>


                {{-- Due date --}}
                <div>

                    <label
                        for="due_at"
                        class="
                            mb-1.5
                            block
                            text-xs font-medium
                            text-muted
                        "
                    >
                        {{ __('luma.categories.due_at') }}
                    </label>

                    <input
                        id="due_at"
                        type="datetime-local"
                        name="due_at"
                        value="{{ old('due_at') }}"
                        class="
                            w-full
                            rounded-lg
                            border-ink-600
                            bg-ink-900
                            text-sm
                            text-paper
                            focus:border-glow
                            focus:ring-glow
                        "
                    >

                </div>


                {{-- Reminder --}}
                <div>

                    <label
                        for="reminder_offset_minutes"
                        class="
                            mb-1.5
                            block
                            text-xs font-medium
                            text-muted
                        "
                    >
                        {{ __('luma.categories.reminder') }}
                    </label>

                    <select
                        id="reminder_offset_minutes"
                        name="reminder_offset_minutes"
                        class="
                            w-full
                            rounded-lg
                            border-ink-600
                            bg-ink-900
                            text-sm
                            text-paper
                            focus:border-glow
                            focus:ring-glow
                        "
                    >

                        <option value="">
                            {{ __('luma.categories.no_reminder') }}
                        </option>

                        <option
                            value="15"
                            @selected(old('reminder_offset_minutes') == 15)
                        >
                            {{ __('luma.categories.reminder_15') }}
                        </option>

                        <option
                            value="30"
                            @selected(old('reminder_offset_minutes') == 30)
                        >
                            {{ __('luma.categories.reminder_30') }}
                        </option>

                        <option
                            value="60"
                            @selected(old('reminder_offset_minutes') == 60)
                        >
                            {{ __('luma.categories.reminder_60') }}
                        </option>

                        <option
                            value="1440"
                            @selected(old('reminder_offset_minutes') == 1440)
                        >
                            {{ __('luma.categories.reminder_day') }}
                        </option>

                    </select>

                </div>


                {{-- Description --}}
                <div class="sm:col-span-2">

                    <label
                        for="description"
                        class="
                            mb-1.5
                            block
                            text-xs font-medium
                            text-muted
                        "
                    >
                        {{ __('luma.common.description') }}
                    </label>

                    <textarea
                        id="description"
                        name="description"
                        rows="3"
                        placeholder="{{ __('luma.categories.description_placeholder') }}"
                        class="
                            w-full
                            resize-none
                            rounded-lg
                            border-ink-600
                            bg-ink-900
                            text-sm
                            text-paper
                            placeholder:text-muted/50
                            focus:border-glow
                            focus:ring-glow
                        "
                    >{{ old('description') }}</textarea>

                </div>


                {{-- Work related --}}
                <div class="sm:col-span-2">

                    <input
                        type="hidden"
                        name="is_work_related"
                        value="0"
                    >

                    <label
                        class="
                            inline-flex
                            cursor-pointer
                            items-center gap-2.5
                            text-sm text-muted
                        "
                    >

                        <input
                            type="checkbox"
                            name="is_work_related"
                            value="1"
                            @checked(old('is_work_related'))
                            class="
                                rounded
                                border-ink-600
                                bg-ink-900
                                text-glow
                                focus:ring-glow
                            "
                        >

                        <span>
                            {{ __('luma.categories.work_related') }}
                        </span>

                    </label>

                </div>


                <div
                    class="
                        flex justify-end
                        border-t border-ink-700
                        pt-4
                        sm:col-span-2
                    "
                >

                    <button
                        type="submit"
                        class="
                            rounded-lg
                            bg-glow
                            px-5 py-2.5
                            text-sm font-semibold
                            text-ink-950
                            transition
                            hover:brightness-110
                        "
                    >
                        {{ __('luma.categories.add_task') }}
                    </button>

                </div>

            </form>

        </section>


        {{-- ============================================================ --}}
        {{-- TASKS --}}
        {{-- ============================================================ --}}

        <section
            class="
                overflow-hidden
                rounded-xl2
                border border-ink-700
                bg-ink-800/60
            "
        >

            <div
                class="
                    flex items-center
                    justify-between
                    border-b border-ink-700
                    px-5 py-4
                "
            >

                <h2
                    class="
                        font-display
                        text-base font-semibold
                        text-paper
                    "
                >
                    {{ __('luma.categories.tasks') }}
                </h2>

                <span class="font-mono text-xs text-muted">
                    {{ $category->tasks->count() }}
                </span>

            </div>


            <div class="divide-y divide-ink-700">

                @forelse ($category->tasks as $task)

                    <div
                        class="
                            flex items-center
                            gap-3
                            px-5 py-3.5
                        "
                    >

                        {{-- Completion --}}
                        <span
                            class="
                                flex h-5 w-5 shrink-0
                                items-center justify-center
                                rounded-full border

                                {{ $task->is_completed
                                    ? 'border-sage bg-sage/20'
                                    : 'border-ink-600'
                                }}
                            "
                        >

                            @if ($task->is_completed)

                                <svg
                                    class="h-3 w-3 text-sage"
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

                            @endif

                        </span>


                        {{-- Task --}}
                        <div class="min-w-0 flex-1">

                            <p
                                class="
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
                                    mt-1
                                    flex flex-wrap
                                    items-center gap-2
                                    text-xs text-muted
                                "
                            >

                                @if ($task->subcategory)

                                    <span>
                                        {{ $task->subcategory->name }}
                                    </span>

                                @endif


                                @if ($task->due_at)

                                    <span class="font-mono">
                                        {{
                                            $task->due_at
                                                ->locale(app()->getLocale())
                                                ->translatedFormat('j M · H:i')
                                        }}
                                    </span>


                                    @if (
                                        !$task->is_completed &&
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

                                @else

                                    <span class="font-mono">
                                        {{ __('luma.common.no_deadline') }}
                                    </span>

                                @endif


                                @if ($task->priority)

                                    <span>
                                        {{ __('luma.common.' . $task->priority) }}
                                    </span>

                                @endif

                            </div>

                        </div>


                        @if ($task->is_work_related)

                            <span
                                class="
                                    shrink-0
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
                            {{ __('luma.categories.no_tasks') }}
                        </p>

                    </div>

                @endforelse

            </div>

        </section>

    </div>

</x-layouts.app>