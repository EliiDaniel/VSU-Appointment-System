<div x-data="{ total: 0 }">
    <x-label for="name" :value="__('Name')" />
    @foreach($this->documents as $document)
        <label class="flex justify-between py-1">
            <span>
                <input type="checkbox" wire:model="state.selectedDocs" value="{{ $document->id }}" class="rounded-full" x-init="total += $el.checked ? {{ $document->price }} : 0" x-on:click="$event.target.checked ? total += {{ $document->price }} : total -= {{ $document->price }};">
                {{ ucfirst($document->name) }}
            </span>
            <span>₱ {{ $document->price }}</span>
        </label>
    @endforeach

    <div class="text-right p-1 border-t-2 mt-2">
        <input type="hidden" wire:model="state.price" :value="total">
        Total Price: ₱ <span x-text="total.toFixed(2)"></span>
    </div>
</div>