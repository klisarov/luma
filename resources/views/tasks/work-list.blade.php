<x-layouts.app title="Work log">
    <div class="mx-auto max-w-3xl space-y-6">
        <h1 class="font-display text-2xl font-semibold">Work log</h1>
        <p class="text-sm text-muted">Everything you've flagged as work-related, most recent first.</p>

        <div class="divide-y divide-ink-700 rounded-xl2 border border-ink-700 bg-ink-800/60">
            @forelse ($tasks as $task)
                <div class="flex items-center justify-between px-5 py-3.5">
                    <div class="min-w-0">
                        <p class="truncate text-sm font-medium {{ $task->is_completed ? 'text-muted line-through' : 'text-paper' }}">
                            {{ $task->title }}
                        </p>
                        <p class="text-xs text-muted font-mono">
                            {{ $task->category?->name }}
                            @if ($task->due_at) · {{ $task->due_at->format('j M Y · H:i') }} @endif
                        </p>
                    </div>
                    <span class="rounded-full px-2 py-0.5 text-[11px] font-medium
                                  {{ $task->is_completed ? 'bg-sage/15 text-sage' : 'bg-ink-700 text-muted' }}">
                        {{ $task->is_completed ? 'Done' : 'Open' }}
                    </span>
                </div>
            @empty
                <p class="px-5 py-8 text-center text-sm text-muted">No work-related tasks logged yet.</p>
            @endforelse
        </div>

        {{ $tasks->links() }}
    </div>
</x-layouts.app>