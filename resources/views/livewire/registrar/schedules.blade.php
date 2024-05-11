<div>
    <div class="mx-auto mb-4" wire:poll.visble>
        <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden p-4 flex">
            <div class="w-full md:grid md:grid-cols-10 gap-4 text-gray-900 dark:text-gray-100">
                <div class="col-span-9 space-y-4">
                    <div class="text-3xl flex flex-wrap gap-4 md:flex-nowrap items-center justify-between">
                        Appointment Settings
                        <div class="block lg:flex text-xl gap-4 whitespace-nowrap">
                            <div class="flex text-xl items-center gap-1">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 22 22" stroke-width="1.5" stroke="currentColor" class="min-w-6 min-h-6 max-w-6 max-h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                                </svg>
                                <span>Daily Limit: {{ $schedule->daily_limit }}</span>
                            </div>
                            <div class="flex text-xl items-center gap-1 whitespace-normal">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 22 22" stroke-width="1.5" stroke="currentColor" class="min-w-6 min-h-6 max-w-6 max-h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                </svg>
                                <span>Available times: {{ \Carbon\Carbon::createFromFormat('H:i:s', $schedule->min_time)->format('h:i A') }} - {{ \Carbon\Carbon::createFromFormat('H:i:s', $schedule->max_time)->format('h:i A') }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-wrap sm:flex-nowrap sm:grid grid-cols-4 gap-4 items-center">
                        <div class="col-span-2">
                            <div class="text-lg md:text-xl flex items-center gap-1 mb-2">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="min-w-6 min-h-6 max-w-6 max-h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5m-9-6h.008v.008H12v-.008ZM12 15h.008v.008H12V15Zm0 2.25h.008v.008H12v-.008ZM9.75 15h.008v.008H9.75V15Zm0 2.25h.008v.008H9.75v-.008ZM7.5 15h.008v.008H7.5V15Zm0 2.25h.008v.008H7.5v-.008Zm6.75-4.5h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V15Zm0 2.25h.008v.008h-.008v-.008Zm2.25-4.5h.008v.008H16.5v-.008Zm0 2.25h.008v.008H16.5V15Z" />
                                </svg>
                                Enabled Days
                            </div>
                            <div class="flex flex-wrap gap-2 md:text-md dark:text-gray-900 text-gray-100">
                                @foreach(json_decode($schedule->enabled_days) as $day)
                                <span class="bg-emerald-600 dark:bg-emerald-400 rounded-full">
                                    <span class="hidden md:inline p-1 px-6 ">{{ $dayNames[$day] }}</span>
                                    <span class="md:hidden p-1 px-3 ">{{ substr($dayNames[$day], 0, 3) }}</span>
                                </span>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-span-2 2xl:flex justify-end gap-4 space-y-1 2xl:space-y-0">
                            <div class="text-lg md:text-xl flex items-center gap-1">
                                <button
                                    class="border min-h-7 min-w-7 rounded-full text-sm font-medium relative z-[30] data-[tooltip]:after:content-[attr(data-tooltip)] data-[tooltip]:after:invisible data-[tooltip]:after:scale-50 data-[tooltip]:after:origin-bottom data-[tooltip]:after:opacity-0 hover:data-[tooltip]:after:visible hover:data-[tooltip]:after:opacity-100 hover:data-[tooltip]:after:scale-100 data-[tooltip]:after:transition-all data-[tooltip]:after:absolute data-[tooltip]:after:bg-gray-900 data-[tooltip]:after:bottom-[calc(100%+4px)] data-[tooltip]:after:left-1/2 data-[tooltip]:after:-translate-x-1/2 data-[tooltip]:after:-z-[1] data-[tooltip]:after:px-1.5 data-[tooltip]:after:py-1 data-[tooltip]:after:min-h-fit data-[tooltip]:after:min-w-fit data-[tooltip]:after:rounded-md data-[tooltip]:after:drop-shadow data-[tooltip]:before:drop-shadow data-[tooltip]:after:text-center data-[tooltip]:after:text-white data-[tooltip]:after:whitespace-nowrap data-[tooltip]:after:text-[10px] data-[tooltip]:before:invisible data-[tooltip]:before:opacity-0 hover:data-[tooltip]:before:visible hover:data-[tooltip]:before:opacity-100 data-[tooltip]:before:transition-all data-[tooltip]:before:bg-gray-900 data-[tooltip]:before:[clip-path:polygon(100%_0,0_0,50%_100%)] data-[tooltip]:before:absolute data-[tooltip]:before:bottom-full data-[tooltip]:before:left-1/2 data-[tooltip]:before:-translate-x-1/2 data-[tooltip]:before:z-0 data-[tooltip]:before:w-3 data-[tooltip]:before:h-[4px]"
                                    data-tooltip="Number of days from day of request"
                                >
                                    ?
                                </button>
                                Minimum Booking Date: {{ $schedule->min }}
                            </div>

                            <div class="text-lg md:text-xl flex items-center gap-1">
                                <button
                                    class="border min-h-7 min-w-7 rounded-full text-sm font-medium relative z-[30] data-[tooltip]:after:content-[attr(data-tooltip)] data-[tooltip]:after:invisible data-[tooltip]:after:scale-50 data-[tooltip]:after:origin-bottom data-[tooltip]:after:opacity-0 hover:data-[tooltip]:after:visible hover:data-[tooltip]:after:opacity-100 hover:data-[tooltip]:after:scale-100 data-[tooltip]:after:transition-all data-[tooltip]:after:absolute data-[tooltip]:after:bg-gray-900 data-[tooltip]:after:bottom-[calc(100%+4px)] data-[tooltip]:after:left-1/2 data-[tooltip]:after:-translate-x-1/2 data-[tooltip]:after:-z-[1] data-[tooltip]:after:px-1.5 data-[tooltip]:after:py-1 data-[tooltip]:after:min-h-fit data-[tooltip]:after:min-w-fit data-[tooltip]:after:rounded-md data-[tooltip]:after:drop-shadow data-[tooltip]:before:drop-shadow data-[tooltip]:after:text-center data-[tooltip]:after:text-white data-[tooltip]:after:whitespace-nowrap data-[tooltip]:after:text-[10px] data-[tooltip]:before:invisible data-[tooltip]:before:opacity-0 hover:data-[tooltip]:before:visible hover:data-[tooltip]:before:opacity-100 data-[tooltip]:before:transition-all data-[tooltip]:before:bg-gray-900 data-[tooltip]:before:[clip-path:polygon(100%_0,0_0,50%_100%)] data-[tooltip]:before:absolute data-[tooltip]:before:bottom-full data-[tooltip]:before:left-1/2 data-[tooltip]:before:-translate-x-1/2 data-[tooltip]:before:z-0 data-[tooltip]:before:w-3 data-[tooltip]:before:h-[4px]"
                                    data-tooltip="Number of days from the minimum booking date"
                                >
                                    ?
                                </button>
                                Maximum Booking Date: {{ $schedule->max }}
                            </div>
                        </div>
                        <div>
                            
                        </div>
                    </div>
                </div>
                <div class="flex items-center justify-center">
                    <x-secondary-button wire:click="viewSchedule">
                        edit
                    </x-secondary-button>
                </div>
            </div>
        </div>
    </div>
    <section>
        <div class="mx-auto">
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
                    <div class="flex space-x-3">
                        <div class="px-3">
                            <div class="flex ">
                                <div class="flex space-x-4 items-center">
                                    <label class="text-sm font-medium text-gray-900 dark:text-gray-100">Show</label>
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
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th scope="col" class="px-4 py-3 {{ $sortBy == 'id' ? 'bg-gray-200' : '' }} hover:bg-gray-300 ease-in-out duration-200" wire:click="setSortBy('id')">
                                    <div class="flex items-center justify-between">
                                        id
                                        <span>
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 15 12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
                                            </svg>
                                        </span>
                                    </div>
                                </th>
                                <th scope="col" class="px-4 py-3 w-1/4 {{ $sortBy == 'name' ? 'bg-gray-200' : '' }} hover:bg-gray-300 ease-in-out duration-200" wire:click="setSortBy('date')">
                                    <div class="flex items-center justify-between">
                                        blocked date
                                        <span>
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 15 12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
                                            </svg>
                                        </span>
                                    </div>
                                </th>
                                <th scope="col" class="px-4 py-3 w-1/4 {{ $sortBy == 'created_at' ? 'bg-gray-200' : '' }} hover:bg-gray-300 ease-in-out duration-200" wire:click="setSortBy('created_at')">
                                    <div class="flex items-center justify-between">
                                        created
                                        <span>
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 15 12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
                                            </svg>
                                        </span>
                                    </div>
                                </th>
                                <th scope="col" class="px-4 py-3 w-1/4 {{ $sortBy == 'updated_at' ? 'bg-gray-200' : '' }} hover:bg-gray-300 ease-in-out duration-200" wire:click="setSortBy('updated_at')">
                                    <div class="flex items-center justify-between">
                                        last updated
                                        <span>
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 15 12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
                                            </svg>
                                        </span>
                                    </div>
                                </th>
                                <th scope="col" class="px-4 py-3 w-1/4">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($blocked_dates as $blocked_date)
                                <tr wire:key="{{ $blocked_date->id }}" class="border-b dark:border-gray-700">
                                    <td class="px-4 py-3">{{ $blocked_date->id }}</td>
                                    <th scope="row"
                                        class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ date("Y-m-d", strtotime($blocked_date->date)) }}</th>
                                    <td class="px-4 py-3">{{ $blocked_date->created_at }}</td>
                                    <td class="px-4 py-3">{{ $blocked_date->updated_at }}</td>
                                    <td class="px-4 py-3 flex items-center gap-2">
                                        <x-danger-button wire:click="deleteBlockedDate({{ $blocked_date }})" wire:confirm="Are you sure you want to delete blocked date on {{ $blocked_date->date }}?">
                                            {{ __('Delete') }}
                                        </x-danger-button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                @include('livewire.registrar.includes.schedule-modal')

                <div class="py-4 px-3">
                    {{ $blocked_dates->links('vendor.livewire.pagination') }}
                </div>
            </div>
        </div>
    </section>

    
    <button class="fixed bottom-4 right-4 bg-gray-300 text-gray-700 dark:bg-gray-700 dark:text-gray-300 p-2 rounded-full opacity-75 hover:opacity-100 ease-in-out duration-200"
        wire:click="createBlockedDate()"
        >
        <svg class="fill-current h-8 w-8 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
            <title>New Product</title>
            <path d="M10 3a1 1 0 0 1 1 1v5h5a1 1 0 0 1 0 2h-5v5a1 1 0 1 1-2 0v-5H4a1 1 0 1 1 0-2h5V4a1 1 0 0 1 1-1z"/>
        </svg>
    </button>
</div>
