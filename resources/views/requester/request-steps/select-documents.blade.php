<div x-data="{ total: 0 }">
    @foreach($this->documents as $document)
        <label class="grid grid-cols-4 py-1 items-center gap-2">
            <span class="col-span-2 flex items-center gap-2">
                <input type="checkbox" wire:model="state.selected_documents" value="{{ $document->id }}" class="rounded-full">
                <span>{{ ucfirst($document->name) }}</span>
            </span>
            <span class="text-end whitespace-nowrap">₱ <span x-text="({{ $document->price * $this->state['quantities'][$document->id] }}).toFixed(2)"></span></span>
            <div class="flex justify-end">
                <input type="number" min="1" wire:model.number.live="state.quantities.{{ $document->id }}" class="border rounded-md px-2 py-1 ml-2 w-[58px] border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-emerald-500 dark:focus:border-emerald-600 focus:ring-emerald-500 dark:focus:ring-emerald-600 shadow-sm">
            </div>
        </label>
    @endforeach
</div>