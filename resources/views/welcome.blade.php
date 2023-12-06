<x-guest-layout>
    <!-- Session Status -->
    <p>{{ session('status') }}</p>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <label for="username">{{ __('auth.username') }}</label>
            <input id="username"
                type="text" name="username" :value="old('username')"
                required autofocus autocomplete="username">
        </div>

        <!-- Password -->
        <div>
            <label for="password">{{ __('auth.password') }}</label>

            <input id="password"
                type="password"
                name="password"
                required autocomplete="current-password">
        </div>

        <!-- Remember Me -->
        <div>
            <label for="remember_me">
                <input id="remember_me" type="checkbox"
                    name="remember">
                <span>{{ __('auth.remember_me') }}</span>
            </label>
        </div>

        <div>
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}">{{ __('auth.forgot_credentials') }}</a>
            @endif

            <button type="submit">
                {{ __('auth.login') }}
            </button>
        </div>
    </form>
    <a href="{{ route('register') }}">Register</a>
</x-guest-layout>
