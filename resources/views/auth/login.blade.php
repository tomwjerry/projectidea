<x-guest-layout>
    <!-- Session Status -->
    <p>{{ session('status') }}</p>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <label for="email">{{ __('Email') }}</label>
            <input id="email"
                type="email" name="email" :value="old('email')"
                required autofocus autocomplete="username">
        </div>

        <!-- Password -->
        <div>
            <label for="password">{{ __('Password') }}</label>

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
                <span>{{ __('Remember me') }}</span>
            </label>
        </div>

        <div>
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}">{{ __('Forgot your password?') }}</a>
            @endif

            <button type="submit">
                {{ __('Log in') }}
            </button>
        </div>
    </form>
</x-guest-layout>
