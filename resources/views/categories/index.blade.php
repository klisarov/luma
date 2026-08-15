<x-layouts.app title="Categories">
    <div class="mx-auto max-w-3xl space-y-6">
        <h1 class="font-display text-2xl font-semibold">Categories</h1>

        <div class="grid gap-3 sm:grid-cols-2">
            @foreach ($categories as $category)
                <a href="{{ route('categories.show', $category) }}"
                   class="flex items-center justify-between rounded-xl2 border border-ink-700 bg-ink-800/60 p-4 hover:border-glow/40 transition">
                    <div class="flex items-center gap-2">
                        <span class="h-2.5 w-2.5 rounded-full" style="background-color: {{ $category->color }}"></span>
                        <p class="text-sm font-medium text-paper">{{ $category->name }}</p>
                    </div>
                    <span class="text-xs text-muted font-mono">{{ $category->tasks_count }}</span>
                </a>
            @endforeach
        </div>
    </div>
</x-layouts.app>