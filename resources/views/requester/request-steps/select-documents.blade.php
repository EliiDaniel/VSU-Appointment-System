<div x-data="{ total: 0 }" class="flex flex-col gap-2">
    @foreach($this->types as $type)
        @if ($loop->first)
            @foreach($type->documents as $document)
            <label class="grid grid-cols-4 py-1 items-center gap-2">
                <span class="col-span-2 flex items-center gap-2">
                    <input type="checkbox" :disabled="{{ isset($this->transaction) ? 'true' : 'false' }}" wire:model="state.selected_documents" value="{{ $document->id }}" class="rounded-full">
                    <span>{{ ucfirst($document->name) }}</span>
                </span>
                <span class="text-end whitespace-nowrap">₱ <span x-text="({{ $document->price * $this->state['quantities'][$document->id] }}).toFixed(2)"></span></span>
                <div class="flex justify-end">
                    <input type="number" min="1" :disabled="{{ isset($this->transaction) ? 'true' : 'false' }}" wire:model.number.live="state.quantities.{{ $document->id }}" class="border rounded-md px-2 py-1 ml-2 w-[58px] border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-emerald-500 dark:focus:border-emerald-600 focus:ring-emerald-500 dark:focus:ring-emerald-600 shadow-sm" x-on:input="$event.target.value = Math.max(1, $event.target.value || 1); $wire.set('state.quantities.{{ $document->id }}',  parseInt($event.target.value));">
                </div>
            </label>
            @endforeach
        @else
        <div x-data="{ ddOpen: true }">
            <button type="button" class="w-full flex items-center justify-between border-b py-2 font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest shadow-sm border-gray-300 dark:border-gray-500" x-on:click="ddOpen = ! ddOpen">
                <span>{{$type->name}}</span>
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                    </svg>
                </span>
            </button>
            <div x-show="ddOpen">
                @foreach($type->documents as $document)
                <label class="grid grid-cols-4 py-1 items-center gap-2">
                    <span class="col-span-2 flex items-center gap-2">
                        <input type="checkbox" :disabled="{{ isset($this->transaction) ? 'true' : 'false' }}" wire:model="state.selected_documents" value="{{ $document->id }}" class="rounded-full">
                        <span>{{ ucfirst($document->name) }}</span>
                    </span>
                    <span class="text-end whitespace-nowrap">₱ <span x-text="({{ $document->price * $this->state['quantities'][$document->id] }}).toFixed(2)"></span></span>
                    <div class="flex justify-end">
                        <input type="number" min="1" :disabled="{{ isset($this->transaction) ? 'true' : 'false' }}" wire:model.number.live="state.quantities.{{ $document->id }}" class="border rounded-md px-2 py-1 ml-2 w-[58px] border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-emerald-500 dark:focus:border-emerald-600 focus:ring-emerald-500 dark:focus:ring-emerald-600 shadow-sm" x-on:input="$event.target.value = Math.max(1, $event.target.value || 1); $wire.set('state.quantities.{{ $document->id }}',  parseInt($event.target.value));">
                    </div>
                </label>
                @endforeach
            </div>
        </div>
        @endif
    @endforeach
</div>