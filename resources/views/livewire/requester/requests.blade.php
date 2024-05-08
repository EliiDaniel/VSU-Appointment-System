<div>
    <section>
        <div class="mx-auto">
            <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg">
                <div class="flex flex-wrap sm:flex-nowrap gap-4 lg:hidden items-center p-4 space-x-3">
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
                    
                    <div class="flex space-x-3 items-center">
                        <button wire:click="openFilters()"  class="rounded-md border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-900 px-3 py-2 text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-emerald-500 dark:focus:ring-emerald-600">Filters</button>
                    </div>

                    <div class="flex space-x-3 items-center">
                        <label class="text-sm font-medium text-gray-900 dark:text-gray-100">Show:</label>
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
                
                <div class="hidden lg:flex items-center justify-between p-4 space-x-3">
                    <div class="flex space-x-3">
                        <div class="hidden md:flex">
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
                                    class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-emerald-500 dark:focus:border-emerald-600 focus:ring-emerald-500 dark:focus:ring-emerald-600 rounded-md shadow-sm pl-10 md:max-w-52 2xl:max-w-none"
                                    placeholder="Search" required="">
                            </div>
                        </div>

                        <div x-data="{ documentsDd: false }" class="relative">
                            <button @click="documentsDd = !documentsDd" class="rounded-md border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-900 px-3 py-2 text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-emerald-500 dark:focus:ring-emerald-600">
                                <div class="flex justify-center items-center">
                                    <span class="pr-4">Documents</span>
                                    <svg class="-mr-1 ml-2 h-5 w-6 text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 18" fill="currentColor">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>

                            <div x-show="documentsDd" @click.away="documentsDd = false" class="origin-top-left absolute left-0 mt-2 rounded-md shadow-lg bg-white dark:bg-gray-900 ring-1 ring-black ring-opacity-5 divide-y divide-gray-100 dark:divide-gray-800">
                                <div class="px-4 py-3 max-h-60 overflow-y-auto">
                                    @foreach($documents as $document)
                                    <div class="flex items-center pt-1  whitespace-nowrap">
                                        <input type="checkbox" id="{{ $document->name }}" wire:model.live="selectedDocuments" value="{{ $document->name }}" class="h-4 w-4 text-emerald-600 dark:text-emerald-400 border-gray-300 dark:border-gray-700 focus:ring-emerald-500 dark:focus:ring-emerald-600 bg-white dark:bg-gray-900 rounded">
                                        <label for="{{ $document->name }}" class="ml-2 block text-gray-900 dark:text-gray-200">{{ ucfirst($document->name) }}</label>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div class="flex space-x-3 items-center">
                            <label class="whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-100">Type:</label>
                            <select
                                wire:model.live="type"
                                class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-emerald-500 dark:focus:border-emerald-600 focus:ring-emerald-500 dark:focus:ring-emerald-600 rounded-md shadow-sm">
                                <option value="">All</option>
                                <option value="Walk in">Walk in</option>
                                <option value="Online">Online</option>
                            </select>
                        </div>
                    </div>

                    <div class="flex space-x-3">
                        <div class="flex space-x-3 items-center">
                            <label class="whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-100">Status:</label>
                            <select
                                wire:model.live="status"
                                class="max-w-32 xl:max-w-none border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-emerald-500 dark:focus:border-emerald-600 focus:ring-emerald-500 dark:focus:ring-emerald-600 rounded-md shadow-sm">
                                <option value="">All</option>
                                @foreach($statuses as $status)
                                    <option value="{{ $status }}">{{ $status }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="flex space-x-3 items-center">
                            <label class="text-sm font-medium text-gray-900 dark:text-gray-100">Show:</label>
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
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th scope="col" class="px-4 py-3 w-1/6">documents</th>
                                <th scope="col" class="px-4 py-3 w-1/6">tracking code</th>
                                <th scope="col" class="px-4 py-3 w-1/6">status</th>
                                <th scope="col" class="px-4 py-3 w-1/6">payment type</th>
                                <th scope="col" class="px-4 py-3 w-1/6 {{ $sortBy == 'appointment_date' ? 'bg-gray-200' : '' }} hover:bg-gray-300 ease-in-out duration-200 cursor-pointer" wire:click="setSortBy('appointment_date')">
                                    <div class="flex items-center justify-between">
                                        date requested
                                        <span>
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 15 12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
                                            </svg>
                                        </span>
                                    </div>
                                </th>
                                <th scope="col" class="px-4 py-3 w-1/6">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($requests as $request)
                                <tr wire:key="{{ $request->id }}" class="border-b dark:border-gray-700">
                                    <td class="px-4 py-3 text-emerald-600 dark:text-emerald-400">
                                        @foreach ($request->documents as $document)
                                            {{ $document->name }}
                                            @if (!$loop->last)
                                                ●
                                            @endif
                                        @endforeach
                                    </td>
                                    <td class="px-4 py-3">{{ $request->tracking_code }}</td>
                                    <td class="px-4 py-3">{{ $request->status }}</td>
                                    <td class="px-4 py-3">{{ $request->payment_type }}</td>
                                    <td class="px-4 py-3">{{ date('Y-m-d H:i', strtotime($request->appointment_date)) }}</td>
                                    <td class="px-4 py-3">
                                        <div class="flex items-center gap-2">
                                            <x-secondary-button wire:click="viewRequest({{ $request }})">
                                                {{ __('View') }}
                                            </x-secondary-button>
                                            <x-danger-button x-show="!{{ $request->approved_at ? 'true' : 'false' }}" wire:click="cancelRequest({{ $request }})" wire:confirm="Are you sure you want to cancel request?" disabled="{{ $request->canceled_at ? 'true' : false }}">
                                                {{ __(  $request->canceled_at ? 'Canceled' : 'Cancel') }}
                                            </x-danger-button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                @include('livewire.requester.includes.request-modal')

                <div class="py-4 px-3">
                    {{ $requests->links('vendor.livewire.pagination') }}
                </div>
            </div>
        </div>
    </section>
    
    <button class="fixed bottom-4 right-4 bg-gray-300 text-gray-700 dark:bg-gray-700 dark:text-gray-300 p-2 rounded-full opacity-75 hover:opacity-100 ease-in-out duration-200"
        wire:click="createRequest()"
        >
        <svg class="fill-current h-8 w-8 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
            <title>New Request</title>
            <path d="M10 3a1 1 0 0 1 1 1v5h5a1 1 0 0 1 0 2h-5v5a1 1 0 1 1-2 0v-5H4a1 1 0 1 1 0-2h5V4a1 1 0 0 1 1-1z"/>
        </svg>
    </button>
</div>