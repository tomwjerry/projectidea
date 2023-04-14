<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <label for="name">{{ __('Name') }}</label>
            <input id="name" class="block mt-1 w-full" type="text" name="name"
                :value="old('name')" required autofocus autocomplete="name">
            <p class="mt-2">{{ implode(', ', $errors->get('name')) }}</p>
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <label for="email">{{ __('Email') }}</label>
            <input id="email" class="block mt-1 w-full" type="email"
                name="email" :value="old('email')" required autocomplete="username">
            <p class="mt-2">{{ implode(', ', $errors->get('email')) }}</p>
        </div>

        <!-- Password -->
        <div class="mt-4">
            <label for="password">{{ __('Password') }}</label>

            <input id="password" class="block mt-1 w-full"
                type="password"
                name="password"
                required autocomplete="new-password">

            <p class="mt-2">{{ implode(', ', $errors->get('password')) }}</p>
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <label for="password_confirmation">{{ __('Confirm Password') }}</label>

            <input id="password_confirmation" class="block mt-1 w-full"
                type="password"
                name="password_confirmation" required autocomplete="new-password">

                <p class="mt-2">{{ implode(', ', $errors->get('password_confirmation')) }}</p>
        </div>

        <div class="flex items-center justify-end mt-4">
            <a href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <button class="ml-4" type="submit">
                {{ __('Register') }}
            </button>
        </div>
    </form>
</x-guest-layout>
