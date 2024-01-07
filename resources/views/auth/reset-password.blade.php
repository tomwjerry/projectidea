<x-guest-layout>
    <form method="POST" action="{{ route('password.store') }}">
        @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Email Address -->
        <div>
            <label for="email">{{ __('auth.email') }}</label>
            <input id="email" class="block mt-1 w-full"
                type="email" name="email"
                value="{{ old('email', $request->email) }}"
                required autofocus autocomplete="username">
        </div>

        <!-- Password -->
        <div class="mt-4">
            <label for="password">{{ __('auth.password') }}</label>
            <input id="password" class="block mt-1 w-full"
                type="password" name="password"
                required autocomplete="new-password">
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <label for="password_confirmation">{{ __('auth.confirm_password') }}</label>

            <input id="password_confirmation" class="block mt-1 w-full"
                type="password"
                name="password_confirmation" required
                autocomplete="new-password">
        </div>

        <div class="">
            <button type="submit">
                {{ __('Reset Password') }}
            </button>
        </div>
    </form>
</x-guest-layout>
