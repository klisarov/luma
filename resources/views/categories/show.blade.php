<x-layouts.app :title="$category->name">
    <div class="mx-auto max-w-4xl space-y-6">

        {{-- ============================================================ --}}
        {{-- HEADER --}}
        {{-- ============================================================ --}}

        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

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
                        {{ $category->tasks->count() }}
                        task{{ $category->tasks->count() === 1 ? '' : 's' }}
                    </p>
                </div>
            </div>

        </div>


        {{-- ============================================================ --}}
        {{-- STATUS / ERRORS --}}
        {{-- ============================================================ --}}

        @if (session('status'))
            <div class="rounded-xl border border-sage/20 bg-sage/10 px-4 py-3 text-sm text-sage">
                {{ session('status') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="rounded-xl border border-red-500/20 bg-red-500/10 px-4 py-3">
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

        <div class="rounded-xl2 border border-ink-700 bg-ink-800/60">

            <div class="border-b border-ink-700 px-5 py-4">
                <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

                    <div>
                        <h2 class="font-display text-base font-semibold text-paper">
                            Subcategories
                        </h2>

                        <p class="mt-1 text-xs text-muted">
                            Organize tasks inside {{ $category->name }}.
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
                            placeholder="Subcategory name"
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
                            Add
                        </button>
                    </form>

                </div>
            </div>


            {{-- Subcategory list --}}
            <div class="divide-y divide-ink-700">

                @forelse ($category->subcategories as $subcategory)

                    <div class="flex items-center justify-between gap-4 px-5 py-3.5">

                        <div class="min-w-0">

                            <p class="truncate text-sm font-medium text-paper">
                                {{ $subcategory->name }}
                            </p>

                            <p class="mt-0.5 text-xs text-muted">
                                {{ $subcategory->tasks->count() }}
                                task{{ $subcategory->tasks->count() === 1 ? '' : 's' }}
                            </p>

                        </div>


                        <form
                            method="POST"
                            action="{{ route('subcategories.destroy', $subcategory) }}"
                            onsubmit="return confirm('Delete this subcategory? Tasks will remain.')"
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
                                Remove
                            </button>
                        </form>

                    </div>

                @empty

                    <div class="px-5 py-8 text-center">
                        <p class="text-sm text-muted">
                            No subcategories yet.
                        </p>
                    </div>

                @endforelse

            </div>

        </div>


        {{-- ============================================================ --}}
        {{-- TASKS --}}
        {{-- ============================================================ --}}

        <div class="rounded-xl2 border border-ink-700 bg-ink-800/60">

            <div class="flex items-center justify-between border-b border-ink-700 px-5 py-4">

                <h2 class="font-display text-base font-semibold text-paper">
                    Tasks
                </h2>

                <span class="font-mono text-xs text-muted">
                    {{ $category->tasks->count() }}
                </span>

            </div>


            <div class="divide-y divide-ink-700">

                @forelse ($category->tasks as $task)

                    <div
                        class="flex items-center gap-3 px-5 py-3.5"
                    >

                        {{-- Completion indicator --}}
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


                        {{-- Task content --}}
                        <div class="min-w-0 flex-1">

                            <p
                                class="
                                    truncate text-sm font-medium
                                    {{ $task->is_completed
                                        ? 'text-muted line-through'
                                        : 'text-paper'
                                    }}
                                "
                            >
                                {{ $task->title }}
                            </p>


                            <div class="mt-1 flex flex-wrap items-center gap-2 text-xs text-muted">

                                {{-- Subcategory --}}
                                @if ($task->subcategory)
                                    <span>
                                        {{ $task->subcategory->name }}
                                    </span>
                                @endif


                                {{-- Due --}}
                                @if ($task->due_at)

                                    <span class="font-mono">
                                        {{ $task->due_at->format('j M · H:i') }}
                                    </span>

                                    @if (!$task->is_completed && $task->due_at->isPast())
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
                                            Overdue
                                        </span>
                                    @endif

                                @else

                                    <span class="font-mono">
                                        No deadline
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


                        {{-- Work --}}
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
                                Work
                            </span>
                        @endif

                    </div>

                @empty

                    <div class="px-5 py-10 text-center">
                        <p class="text-sm text-muted">
                            No tasks in this category yet.
                        </p>
                    </div>

                @endforelse

            </div>

        </div>

    </div>
</x-layouts.app>