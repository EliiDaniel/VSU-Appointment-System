<div>
    <div class="text-2xl fixed top-0 left-0 p-6 text-end z-10">
        @if (!request()->is('/') && !auth()->check())
            <a href="{{ url('') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-emerald-500" wire:navigate>Back</a>
        @endif
    </div>

    <div class="text-2xl fixed top-0 right-0 p-6 text-end z-10">
        @auth
            <a href="{{ url('/dashboard') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-emerald-500">Dashboard</a>
        @else
            @if (!request()->routeIs('login'))
                <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-emerald-500" wire:navigate>Log in</a>
            @endif
            @if (Route::has('register') && !request()->routeIs('register'))
                <a href="{{ route('register') }}" class="ms-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-emerald-500" wire:navigate>Register</a>
            @endif
        @endauth
    </div>
</div>