<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <label for="name">{{ __('auth.name') }}</label>
            <input id="name" class="block mt-1 w-full" type="text" name="name"
                :value="old('name')" required autofocus autocomplete="name">
            <p class="mt-2">{{ implode(', ', $errors->get('name')) }}</p>
        </div>

        <!-- Username -->
        <div class="mt-4">
            <label for="username">{{ __('auth.username') }}</label>
            <input id="username" class="block mt-1 w-full" type="username"
                name="username" :value="old('username')" required autocomplete="off">
            <p class="mt-2">{{ implode(', ', $errors->get('username')) }}</p>
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <label for="email">{{ __('auth.email') }}</label>
            <input id="email" class="block mt-1 w-full" type="email"
                name="email" :value="old('email')" required autocomplete="username">
            <p class="mt-2">{{ implode(', ', $errors->get('email')) }}</p>
        </div>

        <!-- Password -->
        <div class="mt-4">
            <label for="password">{{ __('auth.password') }}</label>

            <input id="password" class="block mt-1 w-full"
                type="password"
                name="password"
                required autocomplete="new-password">

            <p class="mt-2">{{ implode(', ', $errors->get('password')) }}</p>
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <label for="password_confirmation">{{ __('auth.confirm_password') }}</label>

            <input id="password_confirmation" class="block mt-1 w-full"
                type="password"
                name="password_confirmation" required autocomplete="new-password">

                <p class="mt-2">{{ implode(', ', $errors->get('password_confirmation')) }}</p>
        </div>

        <div class="flex items-center justify-end mt-4">
            <a href="{{ route('login') }}">
                {{ __('auth.already_registered') }}
            </a>

            <button class="ml-4" type="submit">
                {{ __('auth.register') }}
            </button>
        </div>
    </form>
</x-guest-layout>
