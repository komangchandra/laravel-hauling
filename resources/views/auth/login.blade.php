<x-guest-layout>

    <!-- Session Status -->
    <x-auth-session-status
        class="mb-3"
        :status="session('status')"
    />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email -->
        <div class="mb-4">

            <label class="form-label fw-semibold">
                Email
            </label>

            <div class="input-group">

                <span class="input-group-text">
                    <i class="bi bi-envelope"></i>
                </span>

                <input
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    class="form-control"
                    placeholder="Masukan email Anda..."
                    required
                    autofocus
                >

            </div>

            <x-input-error
                :messages="$errors->get('email')"
                class="mt-2 text-danger"
            />

        </div>

        <!-- Password -->
        <div class="mb-4">

            <label class="form-label fw-semibold">
                Password
            </label>

            <div class="input-group">

                <span class="input-group-text">
                    <i class="bi bi-lock"></i>
                </span>

                <input
                    type="password"
                    name="password"
                    id="password"
                    class="form-control"
                    placeholder="Masukan password Anda..."
                    required
                >

                <span
                    class="input-group-text toggle-password"
                    onclick="togglePassword()"
                >
                    <i class="bi bi-eye" id="eyeIcon"></i>
                </span>

            </div>

            <x-input-error
                :messages="$errors->get('password')"
                class="mt-2 text-danger"
            />

        </div>

        <!-- Remember -->
        <div class="form-check mb-4">

            <input
                class="form-check-input"
                type="checkbox"
                name="remember"
                id="remember"
            >

            <label class="form-check-label" for="remember">
                Remember me
            </label>

        </div>

        <!-- Button -->
        <button
            type="submit"
            class="btn btn-primary btn-login w-100"
        >
            Sign In
        </button>

    </form>

    <script>
        function togglePassword() {

            const password = document.getElementById('password');
            const eyeIcon = document.getElementById('eyeIcon');

            if (password.type === 'password') {

                password.type = 'text';

                eyeIcon.classList.remove('bi-eye');
                eyeIcon.classList.add('bi-eye-slash');

            } else {

                password.type = 'password';

                eyeIcon.classList.remove('bi-eye-slash');
                eyeIcon.classList.add('bi-eye');

            }
        }
    </script>

</x-guest-layout>