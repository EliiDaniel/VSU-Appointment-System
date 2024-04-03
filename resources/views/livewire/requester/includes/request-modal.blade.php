<x-modal name="request-modal" maxWidth="2xl" prompt="$wire.title !== 'filters'">
    <div class="p-6 text-gray-900 dark:text-gray-100" x-show="$wire.title === 'create-request'">
        <livewire:requester.wizards.request-form :documents="$documents"/>
    </div>

    @if($statuses)
    <div class="p-6 text-gray-900 dark:text-gray-100" x-show="$wire.title === 'filters'">
        <label class="whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-100">Documents:</label>
        <div class="flex flex-wrap pt-1">
            @foreach($documents as $document)
                <div class="flex items-center ml-4 whitespace-nowrap">
                    <input type="checkbox" id="{{ $document->name }}" wire:model.live="selectedDocuments" value="{{ $document->name }}" class="h-4 w-4 text-emerald-600 dark:text-emerald-400 border-gray-300 dark:border-gray-700 focus:ring-emerald-500 dark:focus:ring-emerald-600 bg-white dark:bg-gray-900 rounded">
                    <label for="{{ $document->name }}" class="ml-2 block text-gray-900 dark:text-gray-200">{{ ucfirst($document->name) }}</label>
                </div>
            @endforeach
        </div>

        <div class="sm:flex sm:space-x-3 items-center mt-4">
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
            
            <div class="flex space-x-3 mt-2 sm:mt-0 items-center">
                <label class="whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-100">Status:</label>
                <select
                    wire:model.live="status"
                    class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-emerald-500 dark:focus:border-emerald-600 focus:ring-emerald-500 dark:focus:ring-emerald-600 rounded-md shadow-sm">
                    <option value="">All</option>
                    @foreach($statuses as $status)
                        <option value="{{ $status }}">{{ $status }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    @endif
</x-modal>
