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

                    {{-- Avatar --}}
                    <div
                        class="
                            flex h-16 w-16
                            shrink-0
                            items-center justify-center
                            rounded-2xl
                            border border-glow/20
                            bg-glow/10
                            font-display
                            text-xl font-semibold
                            text-glow
                            shadow-[0_0_35px_-12px_rgba(245,185,66,0.45)]
                        "
                    >
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>


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


            <div
                class="
                    flex flex-wrap
                    items-center gap-x-6 gap-y-2
                    px-5 py-3
                    text-xs text-muted
                    sm:px-6
                "
            >

                <span class="flex items-center gap-2">

                    <span
                        class="
                            h-1.5 w-1.5
                            rounded-full
                            bg-sage
                        "
                    ></span>

                    Account active

                </span>


                <span class="font-mono">
                    Europe/Skopje
                </span>

            </div>

        </div>


        {{-- ============================================================ --}}
        {{-- STATUS --}}
        {{-- ============================================================ --}}

        @if (session('status') === 'profile-updated')

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
                Profile updated successfully.
            </div>

        @endif


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
        {{-- PROFILE INFORMATION --}}
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
                            d="M15.75 6.75a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.5 20.25a7.5 7.5 0 0115 0"
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
                        Profile information
                    </h2>


                    <p
                        class="
                            mt-1
                            text-xs
                            leading-5
                            text-muted
                        "
                    >
                        Update the name and email address associated with your
                        Luma account.
                    </p>

                </div>

            </div>


            <form
                method="POST"
                action="{{ route('profile.update') }}"
                class="space-y-5 p-5 sm:p-6"
            >

                @csrf
                @method('PATCH')


                {{-- Name --}}
                <div>

                    <label
                        for="name"
                        class="
                            mb-1.5
                            block
                            text-xs font-medium
                            text-muted
                        "
                    >
                        Name
                    </label>


                    <input
                        id="name"
                        name="name"
                        type="text"
                        value="{{ old('name', auth()->user()->name) }}"
                        autocomplete="name"
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


                    @error('name')

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


                {{-- Email --}}
                <div>

                    <label
                        for="email"
                        class="
                            mb-1.5
                            block
                            text-xs font-medium
                            text-muted
                        "
                    >
                        Email
                    </label>


                    <input
                        id="email"
                        name="email"
                        type="email"
                        value="{{ old('email', auth()->user()->email) }}"
                        autocomplete="username"
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


                    @error('email')

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


                <div class="flex justify-end">

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
                        Save changes
                    </button>

                </div>

            </form>

        </section>


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
                        Password
                    </h2>


                    <p
                        class="
                            mt-1
                            text-xs
                            leading-5
                            text-muted
                        "
                    >
                        Keep your account secure with a strong password.
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


                    @error(
                        'current_password',
                        'updatePassword'
                    )

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


                    @error(
                        'password',
                        'updatePassword'
                    )

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


                {{-- Confirm --}}
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


                <div class="flex justify-end">

                    <button
                        type="submit"
                        class="
                            rounded-lg
                            border border-ink-600
                            bg-ink-700
                            px-5 py-2.5
                            text-sm font-semibold
                            text-paper
                            transition
                            hover:border-glow/40
                            hover:bg-ink-600
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
                    border-b border-ink-700
                    px-5 py-4
                    sm:px-6
                "
            >

                <h2
                    class="
                        font-display
                        text-base font-semibold
                        text-paper
                    "
                >
                    Account
                </h2>


                <p
                    class="
                        mt-1
                        text-xs
                        text-muted
                    "
                >
                    Luma account details.
                </p>

            </div>


            <div class="divide-y divide-ink-700">

                <div
                    class="
                        flex items-center justify-between
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


                <div
                    class="
                        flex items-center justify-between
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


                <div
                    class="
                        flex items-center justify-between
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


        {{-- ============================================================ --}}
        {{-- DANGER ZONE --}}
        {{-- ============================================================ --}}

        <section
            x-data="{ confirmDelete: false }"
            class="
                overflow-hidden
                rounded-xl2
                border border-red-500/20
                bg-red-500/[0.03]
            "
        >

            <div
                class="
                    flex flex-col gap-4
                    p-5
                    sm:flex-row
                    sm:items-center
                    sm:justify-between
                    sm:p-6
                "
            >

                <div>

                    <h2
                        class="
                            font-display
                            text-base font-semibold
                            text-red-400
                        "
                    >
                        Delete account
                    </h2>


                    <p
                        class="
                            mt-1
                            max-w-xl
                            text-xs
                            leading-5
                            text-muted
                        "
                    >
                        Permanently delete your Luma account and all data
                        associated with it. This cannot be undone.
                    </p>

                </div>


                <button
                    type="button"
                    @click="confirmDelete = true"
                    class="
                        shrink-0
                        rounded-lg
                        border border-red-500/30
                        bg-red-500/10
                        px-4 py-2.5
                        text-xs font-semibold
                        text-red-400
                        transition
                        hover:bg-red-500/20
                    "
                >
                    Delete account
                </button>

            </div>


            {{-- Delete confirmation --}}
            <div
                x-cloak
                x-show="confirmDelete"
                x-transition
                class="
                    border-t border-red-500/20
                    bg-ink-900/50
                    p-5
                    sm:p-6
                "
            >

                <form
                    method="POST"
                    action="{{ route('profile.destroy') }}"
                    class="space-y-4"
                >

                    @csrf
                    @method('DELETE')


                    <div>

                        <h3
                            class="
                                text-sm font-semibold
                                text-paper
                            "
                        >
                            Are you sure?
                        </h3>


                        <p
                            class="
                                mt-1
                                text-xs
                                leading-5
                                text-muted
                            "
                        >
                            Enter your password to permanently delete your
                            account.
                        </p>

                    </div>


                    <div>

                        <label
                            for="delete_password"
                            class="sr-only"
                        >
                            Password
                        </label>


                        <input
                            id="delete_password"
                            name="password"
                            type="password"
                            placeholder="Your password"
                            autocomplete="current-password"
                            class="
                                w-full
                                rounded-lg
                                border-ink-600
                                bg-ink-900
                                text-sm
                                text-paper
                                placeholder:text-muted/50
                                focus:border-red-400
                                focus:ring-red-400
                                sm:max-w-md
                            "
                        >


                        @error(
                            'password',
                            'userDeletion'
                        )

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


                    <div class="flex flex-wrap gap-2">

                        <button
                            type="submit"
                            class="
                                rounded-lg
                                bg-red-500
                                px-4 py-2.5
                                text-xs font-semibold
                                text-white
                                transition
                                hover:bg-red-400
                            "
                        >
                            Permanently delete
                        </button>


                        <button
                            type="button"
                            @click="confirmDelete = false"
                            class="
                                rounded-lg
                                border border-ink-600
                                bg-ink-800
                                px-4 py-2.5
                                text-xs font-medium
                                text-muted
                                transition
                                hover:bg-ink-700
                                hover:text-paper
                            "
                        >
                            Cancel
                        </button>

                    </div>

                </form>

            </div>

        </section>

    </div>

</x-layouts.app>