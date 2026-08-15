<x-layouts.app title="Profile">

    <div class="mx-auto max-w-4xl space-y-8">

        {{-- ============================================================ --}}
        {{-- HEADER --}}
        {{-- ============================================================ --}}

        <div
            class="
                overflow-hidden
                rounded-xl2
                border border-ink-700
                bg-ink-800/60
            "
        >

            <div
                class="
                    relative
                    overflow-hidden
                    border-b border-ink-700
                    px-5 py-6
                    sm:px-6
                "
            >

                {{-- Glow --}}
                <div
                    class="
                        pointer-events-none
                        absolute -right-16 -top-20
                        h-56 w-56
                        rounded-full
                        bg-glow/10
                        blur-3xl
                    "
                ></div>


                <div
                    class="
                        relative
                        flex flex-col gap-5
                        sm:flex-row
                        sm:items-center
                    "
                >

                    <div class="min-w-0">

                        <p
                            class="
                                text-xs
                                font-semibold
                                uppercase
                                tracking-[0.18em]
                                text-glow
                            "
                        >
                            Your Luma
                        </p>


                        <h1
                            class="
                                mt-1
                                truncate
                                font-display
                                text-2xl font-semibold
                                text-paper
                                sm:text-3xl
                            "
                        >
                            {{ auth()->user()->name }}
                        </h1>


                        <p
                            class="
                                mt-1
                                truncate
                                text-sm
                                text-muted
                            "
                        >
                            {{ auth()->user()->email }}
                        </p>

                    </div>

                </div>

            </div>


            {{-- Account state --}}
            <div
                class="
                    flex items-center
                    gap-5
                    px-5 py-3
                    text-xs text-muted
                    sm:px-6
                "
            >

                <span class="flex items-center gap-2">

                    <span
                        class="
                            h-1.5 w-1.5
                            shrink-0
                            rounded-full
                            bg-sage
                        "
                    ></span>

                    <span>
                        Account active
                    </span>

                </span>


                <span
                    class="
                        h-4
                        w-px
                        bg-ink-600
                    "
                ></span>


                <span class="font-mono">
                    {{ auth()->user()->timezone ?? 'Europe/Skopje' }}
                </span>

            </div>

        </div>


        {{-- ============================================================ --}}
        {{-- STATUS --}}
        {{-- ============================================================ --}}

        @if (session('status') === 'password-updated')

            <div
                class="
                    rounded-xl
                    border border-sage/20
                    bg-sage/10
                    px-4 py-3
                    text-sm
                    text-sage
                "
            >
                Password updated successfully.
            </div>

        @endif


        {{-- ============================================================ --}}
        {{-- PASSWORD --}}
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
                    flex items-start gap-3
                    border-b border-ink-700
                    px-5 py-4
                    sm:px-6
                "
            >

                <div
                    class="
                        flex h-10 w-10
                        shrink-0
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
                            d="M16.5 10.5V6.75a4.5 4.5 0 00-9 0v3.75M6.75 10.5h10.5A2.25 2.25 0 0119.5 12.75v6A2.25 2.25 0 0117.25 21H6.75a2.25 2.25 0 01-2.25-2.25v-6a2.25 2.25 0 012.25-2.25z"
                        />
                    </svg>

                </div>


                <div>

                    <h2
                        class="
                            font-display
                            text-base font-semibold
                            text-paper
                        "
                    >
                        Change password
                    </h2>


                    <p
                        class="
                            mt-1
                            text-xs
                            leading-5
                            text-muted
                        "
                    >
                        Keep your Luma account secure with a strong password.
                    </p>

                </div>

            </div>


            <form
                method="POST"
                action="{{ route('password.update') }}"
                class="space-y-5 p-5 sm:p-6"
            >

                @csrf
                @method('PUT')


                {{-- Current password --}}
                <div>

                    <label
                        for="update_password_current_password"
                        class="
                            mb-1.5
                            block
                            text-xs font-medium
                            text-muted
                        "
                    >
                        Current password
                    </label>


                    <input
                        id="update_password_current_password"
                        name="current_password"
                        type="password"
                        autocomplete="current-password"
                        required
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


                    @error('current_password', 'updatePassword')

                        <p
                            class="
                                mt-1.5
                                text-xs
                                text-red-400
                            "
                        >
                            {{ $message }}
                        </p>

                    @enderror

                </div>


                {{-- New password --}}
                <div>

                    <label
                        for="update_password_password"
                        class="
                            mb-1.5
                            block
                            text-xs font-medium
                            text-muted
                        "
                    >
                        New password
                    </label>


                    <input
                        id="update_password_password"
                        name="password"
                        type="password"
                        autocomplete="new-password"
                        required
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


                    @error('password', 'updatePassword')

                        <p
                            class="
                                mt-1.5
                                text-xs
                                text-red-400
                            "
                        >
                            {{ $message }}
                        </p>

                    @enderror

                </div>


                {{-- Confirm password --}}
                <div>

                    <label
                        for="update_password_password_confirmation"
                        class="
                            mb-1.5
                            block
                            text-xs font-medium
                            text-muted
                        "
                    >
                        Confirm new password
                    </label>


                    <input
                        id="update_password_password_confirmation"
                        name="password_confirmation"
                        type="password"
                        autocomplete="new-password"
                        required
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


                <div
                    class="
                        flex
                        justify-end
                        border-t border-ink-700
                        pt-5
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
                        Update password
                    </button>

                </div>

            </form>

        </section>


        {{-- ============================================================ --}}
        {{-- ACCOUNT INFORMATION --}}
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
                    flex items-start gap-3
                    border-b border-ink-700
                    px-5 py-4
                    sm:px-6
                "
            >

                <div
                    class="
                        flex h-10 w-10
                        shrink-0
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
                            d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zM12 8.25h.008v.008H12V8.25z"
                        />
                    </svg>

                </div>


                <div>

                    <h2
                        class="
                            font-display
                            text-base font-semibold
                            text-paper
                        "
                    >
                        Account information
                    </h2>


                    <p
                        class="
                            mt-1
                            text-xs
                            leading-5
                            text-muted
                        "
                    >
                        Information associated with your Luma account.
                    </p>

                </div>

            </div>


            <div class="divide-y divide-ink-700">

                {{-- Name --}}
                <div
                    class="
                        flex items-center
                        justify-between
                        gap-5
                        px-5 py-4
                        sm:px-6
                    "
                >

                    <span class="text-sm text-muted">
                        Name
                    </span>


                    <span
                        class="
                            truncate
                            text-right
                            text-sm
                            font-medium
                            text-paper
                        "
                    >
                        {{ auth()->user()->name }}
                    </span>

                </div>


                {{-- Email --}}
                <div
                    class="
                        flex items-center
                        justify-between
                        gap-5
                        px-5 py-4
                        sm:px-6
                    "
                >

                    <span class="text-sm text-muted">
                        Email
                    </span>


                    <span
                        class="
                            truncate
                            text-right
                            text-sm
                            text-paper
                        "
                    >
                        {{ auth()->user()->email }}
                    </span>

                </div>


                {{-- Account ID --}}
                <div
                    class="
                        flex items-center
                        justify-between
                        gap-5
                        px-5 py-4
                        sm:px-6
                    "
                >

                    <span class="text-sm text-muted">
                        Account ID
                    </span>


                    <span
                        class="
                            font-mono
                            text-xs
                            text-paper
                        "
                    >
                        #{{ auth()->id() }}
                    </span>

                </div>


                {{-- Member since --}}
                <div
                    class="
                        flex items-center
                        justify-between
                        gap-5
                        px-5 py-4
                        sm:px-6
                    "
                >

                    <span class="text-sm text-muted">
                        Member since
                    </span>


                    <span
                        class="
                            font-mono
                            text-xs
                            text-paper
                        "
                    >
                        {{ auth()->user()->created_at?->format('j M Y') }}
                    </span>

                </div>


                {{-- Timezone --}}
                <div
                    class="
                        flex items-center
                        justify-between
                        gap-5
                        px-5 py-4
                        sm:px-6
                    "
                >

                    <span class="text-sm text-muted">
                        Timezone
                    </span>


                    <span
                        class="
                            font-mono
                            text-xs
                            text-paper
                        "
                    >
                        {{ auth()->user()->timezone ?? 'Europe/Skopje' }}
                    </span>

                </div>

            </div>

        </section>

    </div>

</x-layouts.app>