<div>
    <section x-data="{ procs: {{ isset($selectedDocument) ? $selectedDocument->processes->pluck('name') : '[]' }} }">     
        <div class="mx-auto">
            <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
                <div class="flex items-center justify-between p-4">
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
                                <th scope="col" class="px-4 py-3 w-1/5 {{ $sortBy == 'name' ? 'bg-gray-200' : '' }} hover:bg-gray-300 ease-in-out duration-200" wire:click="setSortBy('name')">
                                    <div class="flex items-center justify-between">
                                        name
                                        <span>
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 15 12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
                                            </svg>
                                        </span>
                                    </div>
                                </th>
                                <th scope="col" class="px-4 py-3 w-1/5 {{ $sortBy == 'price' ? 'bg-gray-200' : '' }} hover:bg-gray-300 ease-in-out duration-200" wire:click="setSortBy('price')">
                                    <div class="flex items-center justify-between">
                                        price
                                        <span>
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 15 12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
                                            </svg>
                                        </span>
                                    </div>
                                </th>
                                <th scope="col" class="px-4 py-3 w-1/5 {{ $sortBy == 'created_at' ? 'bg-gray-200' : '' }} hover:bg-gray-300 ease-in-out duration-200" wire:click="setSortBy('created_at')">
                                    <div class="flex items-center justify-between">
                                        created
                                        <span>
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 15 12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
                                            </svg>
                                        </span>
                                    </div>
                                </th>
                                <th scope="col" class="px-4 py-3 w-1/5 {{ $sortBy == 'updated_at' ? 'bg-gray-200' : '' }} hover:bg-gray-300 ease-in-out duration-200" wire:click="setSortBy('updated_at')">
                                    <div class="flex items-center justify-between">
                                        last updated
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
                            @foreach($documents as $document)
                                <tr wire:key="{{ $document->id }}" class="border-b dark:border-gray-700">
                                    <td class="px-4 py-3">{{ $document->id }}</td>
                                    <th scope="row"
                                        class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $document->name }}</th>
                                    <td class="px-4 py-3">{{ $document->price }}</td>
                                    <td class="px-4 py-3">{{ $document->created_at }}</td>
                                    <td class="px-4 py-3">{{ $document->updated_at }}</td>
                                    <td class="px-4 py-3 flex items-center gap-2">
                                        <x-secondary-button wire:click="showDocument({{ $document }})" @click="procs = {{ $document->processes->pluck('name') }}">
                                            {{ __('View') }}
                                        </x-secondary-button>
                                        <x-danger-button wire:click="deleteDocument({{ $document }})" wire:confirm="Are you sure you want to delete {{ $document->name }}?">
                                            {{ __('Delete') }}
                                        </x-danger-button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                @include('livewire.registrar.includes.document-modal')

                <div class="py-4 px-3">
                    {{ $documents->links('vendor.livewire.pagination') }}
                </div>
            </div>
            <div class="fixed bottom-4 right-4">
                <x-dropdown-reversed align="right" width="48">
                    <x-slot name="trigger">
                        <button class="bg-gray-300 text-gray-700 dark:bg-gray-700 dark:text-gray-300 p-2 rounded-full z-50 opacity-75 hover:opacity-100 ease-in-out duration-200"
                            >
                            <svg class="fill-current h-8 w-8 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <title>New Supplier/Type</title>
                                <path d="M10 3a1 1 0 0 1 1 1v5h5a1 1 0 0 1 0 2h-5v5a1 1 0 1 1-2 0v-5H4a1 1 0 1 1 0-2h5V4a1 1 0 0 1 1-1z"/>
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link wire:click="createProcess()">
                            {{ __('Process') }}
                        </x-dropdown-link>
                        <x-dropdown-link wire:click="createDocument()" @click="procs = []">
                            {{ __('Document') }}
                        </x-dropdown-link>
                    </x-slot>
                </x-dropdown-reversed>
            </div>
        </div>
    </section>
</div>