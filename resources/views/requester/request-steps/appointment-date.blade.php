<div class="mt-4">
    <x-datetime-picker
        without-tips="true"
        placeholder="Pickup Date"
        wire:model="state.appointment_date"
        :timezone="'Asia/Manila'"
        :min="$this->dateConfigs['minDate']"
        :max="$this->dateConfigs['maxDate']"
        min-time="08:00"
        max-time="17:00"
        interval="30"
        :clearable="true"
    />
</div>