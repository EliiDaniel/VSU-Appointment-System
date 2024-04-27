<div>
    <x-label for="email" :value="__('Email')" />
    @if(isset($this->transaction))
        <x-text-input wire:model="state.email" id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" disabled required />
    @else
        <x-text-input wire:model="state.email" id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
    @endif
</div>