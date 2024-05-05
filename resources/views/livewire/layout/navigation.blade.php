<?php

use App\Livewire\Actions\Logout;
use App\Models\Notification;

$logout = function (Logout $logout) {
    $logout();

    $this->redirect('/', navigate: true);
};

$markAsRead = function (Notification $notification) {
    $notification->markAsRead();
};

?>

<nav x-data="{ open: false }" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700 fixed top-0 w-full z-20">
    <!-- Primary Navigation Menu -->
    <div class="px-6">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" wire:navigate>
                        <x-application-logo maxWidth="xs" class="block w-auto fill-current text-gray-800 dark:text-gray-200 " />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    @if(auth()->user()->isAdmin())
                        <x-nav-link :href="route('registrar.dashboard')" :active="request()->routeIs('registrar*')" wire:navigate>
                            {{ __('Registrar') }}
                        </x-nav-link>
                        <x-nav-link :href="route('cashier.dashboard')" :active="request()->routeIs('cashier*')" wire:navigate>
                            {{ __('Cashier') }}
                        </x-nav-link>
                        <x-nav-link :href="route('requester.dashboard')" :active="request()->routeIs('requester*')" wire:navigate>
                            {{ __('Requesters') }}
                        </x-nav-link>
                    @endif
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="64">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-1 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 transition duration-150 ease-in-out cursor-pointer">
                                <title>Notifications</title>
                                <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0M3.124 7.5A8.969 8.969 0 0 1 5.292 3m13.416 0a8.969 8.969 0 0 1 2.168 4.5" />
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        @if(auth()->user()->notifications->isNotEmpty())
                            @foreach(auth()->user()->notifications()->latest()->take(5)->get() as $notification)
                            <div x-data="{ read: {{ $notification->read }} }">
                                <button
                                    class=" w-full px-4 py-2 text-start text-sm leading-5 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-800 transition duration-150 ease-in-out flex justify-between items-center gap-4 whitespace-nowrap relative z-[50] data-[tooltip]:after:content-[attr(data-tooltip)] data-[tooltip]:after:invisible data-[tooltip]:after:scale-50 data-[tooltip]:after:origin-right data-[tooltip]:after:opacity-0 hover:data-[tooltip]:after:visible hover:data-[tooltip]:after:opacity-100 hover:data-[tooltip]:after:scale-100 data-[tooltip]:after:transition-all data-[tooltip]:after:absolute data-[tooltip]:after:bg-white data-[tooltip]:after:dark:bg-gray-700 data-[tooltip]:after:right-[calc(100%+4px)] data-[tooltip]:after:top-1/2 data-[tooltip]:after:-translate-y-1/2 data-[tooltip]:after:-z-[1] data-[tooltip]:after:px-1.5 data-[tooltip]:after:py-1 data-[tooltip]:after:min-h-fit data-[tooltip]:after:min-w-fit data-[tooltip]:after:rounded-md data-[tooltip]:after:drop-shadow data-[tooltip]:before:drop-shadow data-[tooltip]:after:text-center data-[tooltip]:after:text-gray-700 data-[tooltip]:after:dark:text-gray-300 data-[tooltip]:after:whitespace-nowrap data-[tooltip]:after:text-[10px] data-[tooltip]:before:invisible data-[tooltip]:before:opacity-0 hover:data-[tooltip]:before:visible hover:data-[tooltip]:before:opacity-100 data-[tooltip]:before:transition-all data-[tooltip]:before:bg-white data-[tooltip]:before:dark:bg-gray-700 data-[tooltip]:before:[clip-path:polygon(0_0,0_100%,100%_50%)] data-[tooltip]:before:absolute data-[tooltip]:before:right-full data-[tooltip]:before:top-1/2 data-[tooltip]:before:-translate-y-1/2 data-[tooltip]:before:z-0 data-[tooltip]:before:w-[4px] data-[tooltip]:before:h-3"
                                    data-tooltip="{{ $notification->content }}" @click="read = true" wire:click="markAsRead({{ $notification }})">
                                    {{ $notification->title }}
                                    <span :class="read ? 'bg-gray-500' : 'bg-green-500'" class="h-3 w-3 rounded-full"></span>
                                </button>
                            </div>
                            @endforeach
                                <x-dropdown-link :href="route('requester.requests')" class="flex justify-center uppercase tracking-widest font-semibold text-xs">
                                    view all
                                </x-dropdown-link>
                        @else
                            <x-dropdown-link>
                                {{ __('No new notification') }}
                            </x-dropdown-link>
                        @endif
                    </x-slot>
                </x-dropdown>

                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-1 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                            <div x-data="{{ json_encode(['name' => auth()->user()->name]) }}" x-text="name" x-on:profile-updated.window="name = $event.detail.name"></div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile')" wire:navigate>
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <button wire:click="logout" class="w-full text-start">
                            <x-dropdown-link>
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </button>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <x-dropdown align="right" width="56">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-1 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 transition duration-150 ease-in-out cursor-pointer">
                                <title>Notifications</title>
                                <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0M3.124 7.5A8.969 8.969 0 0 1 5.292 3m13.416 0a8.969 8.969 0 0 1 2.168 4.5" />
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        @if(auth()->user()->notifications->isNotEmpty())
                            @foreach(auth()->user()->notifications()->latest()->take(5)->get() as $notification)
                            <div x-data="{ read: {{ $notification->read }} }">
                                <button
                                    class=" w-full px-4 py-2 text-start text-sm leading-5 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-800 transition duration-150 ease-in-out flex justify-between items-center gap-4 relative z-[50] data-[tooltip]:after:content-[attr(data-tooltip)] data-[tooltip]:after:invisible data-[tooltip]:after:scale-50 data-[tooltip]:after:origin-right data-[tooltip]:after:opacity-0 hover:data-[tooltip]:after:visible hover:data-[tooltip]:after:opacity-100 hover:data-[tooltip]:after:scale-100 data-[tooltip]:after:transition-all data-[tooltip]:after:absolute data-[tooltip]:after:bg-white data-[tooltip]:after:dark:bg-gray-700 data-[tooltip]:after:right-[calc(100%+4px)] data-[tooltip]:after:top-1/2 data-[tooltip]:after:-translate-y-1/2 data-[tooltip]:after:-z-[1] data-[tooltip]:after:px-1.5 data-[tooltip]:after:py-1 data-[tooltip]:after:min-h-fit data-[tooltip]:after:min-w-fit data-[tooltip]:after:rounded-md data-[tooltip]:after:drop-shadow data-[tooltip]:before:drop-shadow data-[tooltip]:after:text-center data-[tooltip]:after:text-gray-700 data-[tooltip]:after:dark:text-gray-300 data-[tooltip]:after:whitespace-nowrap data-[tooltip]:after:text-[10px] data-[tooltip]:before:invisible data-[tooltip]:before:opacity-0 hover:data-[tooltip]:before:visible hover:data-[tooltip]:before:opacity-100 data-[tooltip]:before:transition-all data-[tooltip]:before:bg-white data-[tooltip]:before:dark:bg-gray-700 data-[tooltip]:before:[clip-path:polygon(0_0,0_100%,100%_50%)] data-[tooltip]:before:absolute data-[tooltip]:before:right-full data-[tooltip]:before:top-1/2 data-[tooltip]:before:-translate-y-1/2 data-[tooltip]:before:z-0 data-[tooltip]:before:w-[4px] data-[tooltip]:before:h-3"
                                    data-tooltip="{{ $notification->content }}" @click="read = true" wire:click="markAsRead({{ $notification }})">
                                    {{ $notification->title }}
                                    <span :class="read ? 'bg-gray-500' : 'bg-green-500'" class="min-h-3 min-w-3 rounded-full"></span>
                                </button>
                            </div>
                            @endforeach
                                <x-dropdown-link :href="route('requester.requests')" class="flex justify-center uppercase tracking-widest font-semibold text-xs">
                                    view all
                                </x-dropdown-link>
                        @else
                            <x-dropdown-link>
                                {{ __('No new notification') }}
                            </x-dropdown-link>
                        @endif
                    </x-slot>
                </x-dropdown>

                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            @if(auth()->user()->isAdmin())
                <x-responsive-nav-link :href="route('registrar.dashboard')" :active="request()->routeIs('registrar*')" wire:navigate>
                    {{ __('Registrar') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('cashier.dashboard')" :active="request()->routeIs('cashier*')" wire:navigate>
                    {{ __('Cashier') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('requester.dashboard')" :active="request()->routeIs('requester*')" wire:navigate>
                    {{ __('Requester') }}
                </x-responsive-nav-link>
            @endif
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800 dark:text-gray-200" x-data="{{ json_encode(['name' => auth()->user()->name]) }}" x-text="name" x-on:profile-updated.window="name = $event.detail.name"></div>
                <div class="font-medium text-sm text-gray-500">{{ auth()->user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile')" wire:navigate>
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <button wire:click="logout" class="w-full text-start">
                    <x-responsive-nav-link>
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </button>
            </div>
        </div>
    </div>
</nav>
