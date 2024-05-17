<div x-data="{ total: 0 }" class="flex flex-col gap-2">
    @foreach($this->types as $type)
        @if ($loop->first)
            @foreach($type->documents as $document)
            <label class="grid grid-cols-4 py-1 items-center gap-2">
                <span class="col-span-2 flex items-center gap-2">
                    <input type="checkbox" :disabled="{{ isset($this->transaction) ? 'true' : 'false' }}" wire:model="state.selected_documents" value="{{ $document->id }}" class="rounded-full">
                    <span>{{ ucfirst($document->name) }}</span>
                    @if ($document->soft_copy_available)
                    <span class="h-6 w-6 rounded-full text-sm font-medium relative z-[50] data-[tooltip]:after:content-[attr(data-tooltip)] data-[tooltip]:after:invisible data-[tooltip]:after:scale-50 data-[tooltip]:after:origin-bottom data-[tooltip]:after:opacity-0 hover:data-[tooltip]:after:visible hover:data-[tooltip]:after:opacity-100 hover:data-[tooltip]:after:scale-100 data-[tooltip]:after:transition-all data-[tooltip]:after:absolute data-[tooltip]:after:bg-gray-900 data-[tooltip]:after:bottom-[calc(100%+4px)] data-[tooltip]:after:left-1/2 data-[tooltip]:after:-translate-x-1/2 data-[tooltip]:after:-z-[1] data-[tooltip]:after:px-1.5 data-[tooltip]:after:py-1 data-[tooltip]:after:min-h-fit data-[tooltip]:after:min-w-fit data-[tooltip]:after:rounded-md data-[tooltip]:after:drop-shadow data-[tooltip]:before:drop-shadow data-[tooltip]:after:text-center data-[tooltip]:after:text-white data-[tooltip]:after:whitespace-nowrap data-[tooltip]:after:text-[10px] data-[tooltip]:before:invisible data-[tooltip]:before:opacity-0 hover:data-[tooltip]:before:visible hover:data-[tooltip]:before:opacity-100 data-[tooltip]:before:transition-all data-[tooltip]:before:bg-gray-900 data-[tooltip]:before:[clip-path:polygon(100%_0,0_0,50%_100%)] data-[tooltip]:before:absolute data-[tooltip]:before:bottom-full data-[tooltip]:before:left-1/2 data-[tooltip]:before:-translate-x-1/2 data-[tooltip]:before:z-0 data-[tooltip]:before:w-3 data-[tooltip]:before:h-[4px]"
                        data-tooltip="With Soft Copy"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m3.75 9v6m3-3H9m1.5-12H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                        </svg>
                    </span>
                    @endif
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
                        @if ($document->soft_copy_available)
                        <span class="h-6 w-6 rounded-full text-sm font-medium relative z-[50] data-[tooltip]:after:content-[attr(data-tooltip)] data-[tooltip]:after:invisible data-[tooltip]:after:scale-50 data-[tooltip]:after:origin-bottom data-[tooltip]:after:opacity-0 hover:data-[tooltip]:after:visible hover:data-[tooltip]:after:opacity-100 hover:data-[tooltip]:after:scale-100 data-[tooltip]:after:transition-all data-[tooltip]:after:absolute data-[tooltip]:after:bg-gray-900 data-[tooltip]:after:bottom-[calc(100%+4px)] data-[tooltip]:after:left-1/2 data-[tooltip]:after:-translate-x-1/2 data-[tooltip]:after:-z-[1] data-[tooltip]:after:px-1.5 data-[tooltip]:after:py-1 data-[tooltip]:after:min-h-fit data-[tooltip]:after:min-w-fit data-[tooltip]:after:rounded-md data-[tooltip]:after:drop-shadow data-[tooltip]:before:drop-shadow data-[tooltip]:after:text-center data-[tooltip]:after:text-white data-[tooltip]:after:whitespace-nowrap data-[tooltip]:after:text-[10px] data-[tooltip]:before:invisible data-[tooltip]:before:opacity-0 hover:data-[tooltip]:before:visible hover:data-[tooltip]:before:opacity-100 data-[tooltip]:before:transition-all data-[tooltip]:before:bg-gray-900 data-[tooltip]:before:[clip-path:polygon(100%_0,0_0,50%_100%)] data-[tooltip]:before:absolute data-[tooltip]:before:bottom-full data-[tooltip]:before:left-1/2 data-[tooltip]:before:-translate-x-1/2 data-[tooltip]:before:z-0 data-[tooltip]:before:w-3 data-[tooltip]:before:h-[4px]"
                            data-tooltip="With Soft Copy"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m3.75 9v6m3-3H9m1.5-12H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                            </svg>
                        </span>
                        @endif
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