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
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th scope="col" class="px-4 py-3">id</th>
                                <th scope="col" class="px-4 py-3 w-1/2">Date</th>
                                <th scope="col" class="px-4 py-3 w-1/5">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($logs as $log)
                                <tr wire:key="{{ $log->id }}" class="border-b dark:border-gray-700">
                                    <td class="px-4 py-3">{{ $log->id }}</td>
                                    <td class="px-4 py-3">{{ $log->created_at }}</td>
                                    <td class="px-4 py-3">
                                        <div class="flex items-center gap-2">
                                            <x-secondary-button wire:click="viewLog({{ $log }})">
                                                {{ __('View') }}
                                            </x-secondary-button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="py-4 px-3">
                    {{ $logs->links('vendor.livewire.pagination') }}
                </div>
            </div>
        </div>
    </section>

    <x-modal name="log-modal" prompt="false" disabledClose="false" maxWidth="none">
        @if(isset($selectedLog))
        <div class="p-6">
            <div class="relative mx-2 max-h-[800px] bg-gray-100 dark:bg-gray-900 rounded-md shadow-sm text-gray-600 dark:text-gray-400 overflow-auto">
                <table class="w-full text-xs text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                        <tr>
                            <th scope="col" class="px-3 py-2">Type</th>
                            <th scope="col" class="px-3 py-2">Time</th>
                            <th scope="col" class="px-3 py-2">Description</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach (json_decode($selectedLog->activity) as $logInfo)
                            <tr wire:key="{{ $log->id }}" class="border-b dark:border-gray-700">
                                <td class="py-1 px-3">{{ $logInfo->type }}</td>
                                <td class="py-1 px-3">{{ $logInfo->time }}</td>
                                <td class="py-1 px-3">{{ $logInfo->description }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @endif
        <div class="flex items-center justify-end">
            <x-primary-button class="ms-4 mb-4 mr-4" @click="$dispatch('close')">
                {{ __('Done') }}
            </x-primary-button>
        </div>
    </x-modal>
</div>