<x-guest-layout>
    <div class="">
        {{ __('auth.verify_before_use') }}
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 font-medium text-sm text-green-600">
            {{ __('auth.verification_sent') }}
        </div>
    @endif

    <div class="mt-4 flex items-center justify-between">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf

            <div>
                <button type="submit">
                    {{ __('auth.resend_email') }}
                </button>
            </div>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button type="submit" class="">
                {{ __('common.login') }}
            </button>
        </form>
    </div>
</x-guest-layout>
