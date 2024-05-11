<div>
    <section>
        <div class="mx-auto" wire:poll.visble>
            <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
                <div class="flex flex-wrap gap-2 items-center justify-between p-4">
                    <div class="flex">
                        <div class="relative w-full">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400"
                                    fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <input
                                wire:model.live.debounce.300ms="search" 
                                type="text"
                                class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-emerald-500 dark:focus:border-emerald-600 focus:ring-emerald-500 dark:focus:ring-emerald-600 rounded-md shadow-sm pl-10"
                                placeholder="Search" required="">
                        </div>
                    </div>
                    <div class="flex flex-wrap gap-2">
                        <div class="flex">
                            <div class="flex items-center">
                                <label class="text-sm font-medium text-gray-900 dark:text-gray-100 mr-2">Show:</label>
                                <select
                                    wire:model.live="shownEntries"
                                    class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-emerald-500 dark:focus:border-emerald-600 focus:ring-emerald-500 dark:focus:ring-emerald-600 rounded-md shadow-sm">
                                    <option value="5">5</option>
                                    <option value="10">10</option>
                                    <option value="20">20</option>
                                    <option value="50">50</option>
                                </select>
                            </div>
                        </div>

                        <div class="flex space-x-3 items-center">
                            <label class="whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-100">Filter:</label>
                            <select
                                wire:model.live="read"
                                class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-emerald-500 dark:focus:border-emerald-600 focus:ring-emerald-500 dark:focus:ring-emerald-600 rounded-md shadow-sm">
                                <option value="">All</option>
                                <option value="read">Read</option>
                                <option value="unread">Unread</option>
                            </select>
                        </div>

                        <div class="flex space-x-3 items-center">
                            <label class=" whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-100">Type:</label>
                            <select
                                wire:model.live="type"
                                class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-emerald-500 dark:focus:border-emerald-600 focus:ring-emerald-500 dark:focus:ring-emerald-600 rounded-md shadow-sm">
                                <option value="">All</option>
                                <option value="request">Request</option>
                                <option value="transaction">Transactions</option>
                                <option value="user">Account</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th scope="col" class="px-4 py-3">type</th>
                                <th scope="col" class="px-4 py-3 w-1/5">title</th>
                                <th scope="col" class="px-4 py-3 w-1/5">Content</th>
                                <th scope="col" class="px-4 py-3 w-1/5 {{ $sortBy == 'read_at' ? 'bg-gray-200' : '' }} hover:bg-gray-300 ease-in-out duration-200" wire:click="setSortBy('read_at')">
                                    <div class="flex items-center justify-between">
                                        Read On
                                        <span>
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 15 12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
                                            </svg>
                                        </span>
                                    </div>
                                </th>
                                <th scope="col" class="px-4 py-3 w-1/5 {{ $sortBy == 'created_at' ? 'bg-gray-200' : '' }} hover:bg-gray-300 ease-in-out duration-200" wire:click="setSortBy('created_at')">
                                    <div class="flex items-center justify-between">
                                        Created
                                        <span>
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 15 12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
                                            </svg>
                                        </span>
                                    </div>
                                </th>
                                <th scope="col" class="px-4 py-3 w-1/5">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($notifications as $notification)
                                <tr wire:key="{{ $notification->id }}" class="border-b dark:border-gray-700">
                                    <td class="px-4 py-3">{{ ucfirst(json_decode($notification->content)[0]) }}</td>
                                    <th scope="row"
                                        class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $notification->title }}</th>
                                    <td class="px-4 py-3 flex items-center gap-2">
                                        @if (json_decode($notification->content)[0] === 'request')
                                            #{{ json_decode($notification->content)[1] }} Status: {{ json_decode($notification->content)[2] }}
                                        @elseif (json_decode($notification->content)[0] === 'transaction')
                                            Checkeout ID: {{ json_decode($notification->content)[1] }}, Reference No: {{ json_decode($notification->content)[2] }}
                                        @elseif (json_decode($notification->content)[0] === 'user')
                                            Account Role Confirmation
                                        @endif
                                    </td>
                                    <td class="px-4 py-3">{{ $notification->read_at }}</td>
                                    <td class="px-4 py-3">{{ $notification->created_at }}</td>
                                    <td class="px-4 py-3">
                                        <div class="flex items-center gap-2">
                                            <x-secondary-button wire:click="viewNotification({{ $notification }})">
                                                {{ __('View') }}
                                            </x-secondary-button>
                                            <x-danger-button wire:click="deleteNotification({{ $notification }})" wire:confirm="Are you sure you want to cancel notification?">
                                                {{ __('Delete') }}
                                            </x-danger-button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                @include('livewire.requester.includes.notification-modal')

                <div class="py-4 px-3">
                    {{ $notifications->links('vendor.livewire.pagination') }}
                </div>
            </div>
        </div>
    </section>
</div>
