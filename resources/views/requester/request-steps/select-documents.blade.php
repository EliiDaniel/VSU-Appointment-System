<div>
    <x-label for="name" :value="__('Name')" />
    <x-text-input wire:model="state.name" id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
    
    <x-datetime-picker
        without-tips="true"
        placeholder="Pickup Date"
        wire:model.defer="dateConfigs.minDate"
        :timezone="'Asia/Manila'"
        :min="$this->dateConfigs['minDate']"
        :max="$this->dateConfigs['maxDate']"
        min-time="08:00"
        max-time="17:00"
        interval="30"
        :clearable="false"
    />
</div>