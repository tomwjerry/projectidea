<nav class="">
    <div>
        <div class="">
            <a href="{{ route('dashboard') }}">
                {{ __('common.dashboard') }}
            </a>
        </div>

        <!-- Responsive Settings Options -->
        <div class="">
            <div class="">
                <div class="">{{ Auth::user()->name }}</div>
            </div>

            <div class="">
                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <a href="route('logout')"
                        onclick="event.preventDefault(); this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </a>
                </form>
            </div>
        </div>
    </div>
</nav>
