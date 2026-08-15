<x-layouts.app :title="__('luma.work.title')">

    <div class="mx-auto max-w-3xl space-y-6">

        <div>
            <h1 class="font-display text-2xl font-semibold text-paper">
                {{ __('luma.work.title') }}
            </h1>

            <p class="mt-1 text-sm text-muted">
                {{ __('luma.work.description') }}
            </p>
        </div>


        <div
            class="
                divide-y divide-ink-700
                rounded-xl2
                border border-ink-700
                bg-ink-800/60
            "
        >

            @forelse ($tasks as $task)

                <div
                    class="
                        flex
                        items-center
                        justify-between
                        gap-4
                        px-5
                        py-3.5
                    "
                >

                    <div class="min-w-0">

                        <p
                            class="
                                truncate
                                text-sm
                                font-medium

                                {{ $task->is_completed
                                    ? 'text-muted line-through'
                                    : 'text-paper'
                                }}
                            "
                        >
                            {{ $task->title }}
                        </p>


                        <p
                            class="
                                mt-0.5
                                text-xs
                                text-muted
                                font-mono
                            "
                        >

                            @if ($task->category)
                                {{ $task->category->name }}
                            @endif

                            @if ($task->due_at)

                                @if ($task->category)
                                    ·
                                @endif

                                {{
                                    $task->due_at
                                        ->locale(app()->getLocale())
                                        ->translatedFormat('j M Y · H:i')
                                }}

                            @endif

                        </p>

                    </div>


                    <span
                        class="
                            shrink-0
                            rounded-full
                            px-2
                            py-0.5
                            text-[11px]
                            font-medium

                            {{ $task->is_completed
                                ? 'bg-sage/15 text-sage'
                                : 'bg-ink-700 text-muted'
                            }}
                        "
                    >
                        {{ $task->is_completed
                            ? __('luma.work.done')
                            : __('luma.work.open')
                        }}
                    </span>

                </div>

            @empty

                <p
                    class="
                        px-5
                        py-8
                        text-center
                        text-sm
                        text-muted
                    "
                >
                    {{ __('luma.work.empty') }}
                </p>

            @endforelse

        </div>


        {{ $tasks->links() }}

    </div>

</x-layouts.app>