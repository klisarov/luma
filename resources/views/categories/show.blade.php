<x-layouts.app :title="$category->name">
    <div class="mx-auto max-w-3xl space-y-6">
        <div class="flex items-center gap-2">
            <span class="h-3 w-3 rounded-full" style="background-color: {{ $category->color }}"></span>
            <h1 class="font-display text-2xl font-semibold">{{ $category->name }}</h1>
        </div>

        {{-- Subcategories --}}
        <div class="flex flex-wrap items-center gap-2">
            @foreach ($category->subcategories as $sub)
                <span class="rounded-full border border-ink-600 bg-ink-800 px-3 py-1 text-xs text-muted">{{ $sub->name }}</span>
            @endforeach
            <form method="POST" action="{{ route('subcategories.store', $category) }}" class="flex gap-1">
                @csrf
                <input type="text" name="name" placeholder="+ subcategory" required
                       class="w-32 rounded-full border-ink-600 bg-ink-800 px-3 py-1 text-xs text-paper placeholder:text-muted/60 focus:border-glow focus:ring-glow">
            </form>
        </div>

        {{-- Add task --}}
        <form method="POST" action="{{ route('tasks.store') }}"
              class="grid gap-3 rounded-xl2 border border-ink-700 bg-ink-800/60 p-4 sm:grid-cols-2">
            @csrf
            <input type="hidden" name="category_id" value="{{ $category->id }}">
            <input type="text" name="title" placeholder="Task title" required
                   class="sm:col-span-2 rounded-md border-ink-600 bg-ink-800 text-sm text-paper placeholder:text-muted/60 focus:border-glow focus:ring-glow">

            @if ($category->subcategories->isNotEmpty())
                <select name="subcategory_id" class="rounded-md border-ink-600 bg-ink-800 text-sm text-paper focus:border-glow focus:ring-glow">
                    <option value="">No subcategory</option>
                    @foreach ($category->subcategories as $sub)
                        <option value="{{ $sub->id }}">{{ $sub->name }}</option>
                    @endforeach
                </select>
            @endif

            <input type="datetime-local" name="due_at"
                   class="rounded-md border-ink-600 bg-ink-800 text-sm text-paper focus:border-glow focus:ring-glow">

            <select name="reminder_offset_minutes" class="rounded-md border-ink-600 bg-ink-800 text-sm text-paper focus:border-glow focus:ring-glow">
                <option value="">No reminder</option>
                <option value="15">15 min before</option>
                <option value="30">30 min before</option>
                <option value="60">1 hour before</option>
            </select>

            <label class="flex items-center gap-2 text-sm text-muted">
                <input type="checkbox" name="is_work_related" value="1" class="rounded border-ink-600 bg-ink-800 text-glow focus:ring-glow">
                Work-related
            </label>

            <button type="submit" class="sm:col-span-2 rounded-md bg-glow px-4 py-2 text-sm font-medium text-ink-950">Add task</button>
        </form>

        {{-- Task list --}}
        <div class="divide-y divide-ink-700 rounded-xl2 border border-ink-700 bg-ink-800/60">
            @forelse ($category->tasks as $task)
                <div class="flex items-center justify-between px-5 py-3.5">
                    <div class="min-w-0">
                        <p class="truncate text-sm font-medium {{ $task->is_completed ? 'text-muted line-through' : 'text-paper' }}">
                            {{ $task->title }}
                        </p>
                        <p class="text-xs text-muted font-mono">
                            {{ $task->subcategory?->name }}
                            @if ($task->due_at) · {{ $task->due_at->format('j M · H:i') }} @endif
                        </p>
                    </div>
                    <form method="POST" action="{{ route('tasks.destroy', $task) }}">
                        @csrf @method('DELETE')
                        <button type="submit" class="text-xs text-muted hover:text-paper">Remove</button>
                    </form>
                </div>
            @empty
                <p class="px-5 py-8 text-center text-sm text-muted">No tasks in this category yet.</p>
            @endforelse
        </div>
    </div>
</x-layouts.app>