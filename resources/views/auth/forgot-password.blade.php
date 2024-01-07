<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('auth.forgotpw') }}
    </div>

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <label for="email">{{ __('auth.email') }}</label>
            <input id="email" class="block mt-1 w-full"
                type="email" name="email" :value="old('email')"
                required autofocus>
        </div>

        <div class="flex items-center justify-end mt-4">
            <button type="submit">
                {{ __('auth.send_recovery_link') }}
            </button>
        </div>
    </form>
</x-guest-layout>
