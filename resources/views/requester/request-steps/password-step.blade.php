<div class="mt-4">
    <x-label for="pickup_date" :value="__('Pickup Date')" />
    <x-datetime-picker
        without-tips="true"
        placeholder="Pickup Date"
        wire:model.defer="dateConfigs"
        :timezone="'Asia/Manila'"
        min-time="08:00"
        max-time="17:00"
        interval="30"
        :clearable="false"
    />
</div>