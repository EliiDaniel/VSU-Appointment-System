<div class="mt-4">
    <x-datetime-picker
        without-tips="true"
        placeholder="Pickup Date"
        wire:model="state.appointment_date"
        :timezone="'Asia/Manila'"
        :min="$this->dateConfigs['minDate']"
        :max="$this->dateConfigs['maxDate']"
        min-time="{{ date('H:i', strtotime($this->schedule->min_time)) }}"
        max-time="{{ date('H:i', strtotime($this->schedule->max_time)) }}"
        interval="30"
        :clearable="true"
    />
</div>