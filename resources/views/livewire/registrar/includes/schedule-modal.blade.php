<x-modal name="schedule-modal" prompt="true" disabledClose="false">
    <div class="p-6" x-show="$wire.title === 'view-schedule'">
        <form method="post" class="space-y-6">
            @csrf
            @method('patch')

            <div class="flex flex-wrap md:grid grid-cols-3 gap-4">
                <div>
                    <x-input-label for="daily_limit" :value="__('Daily Limit')" />
                    <x-text-input id="daily_limit" name="daily_limit" type="number" class="mt-1 max-w-56" value="{{ old('name', $schedule->daily_limit) }}"  required autofocus autocomplete="name" />
                </div>
                <div>
                    <x-input-label for="min" :value="__('Minimum Date')" />
                    <x-text-input id="min" name="min" type="number" class="mt-1 max-w-56" value="{{ old('name', $schedule->min) }}"  required autofocus autocomplete="name" />
                </div>
                <div>
                    <x-input-label for="max" :value="__('Maximum Date')" />
                    <x-text-input id="max" name="max" type="number" class="mt-1 max-w-56" value="{{ old('name', $schedule->max) }}" required autofocus autocomplete="name" />    
                </div>
            </div>

            <div class="flex flex-wrap text-gray-900 dark:text-gray-100 justify-evenly">
                @foreach(['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'] as $day)
                    <div class="mr-2 mb-2">
                        <label>
                            <input type="checkbox" wire:model="selectedDays" name="days[]" value="{{$loop->index + 1}}" class="rounded-full">
                            {{ $day }}
                        </label>
                    </div>
                @endforeach
            </div>
            <div class="flex items-center justify-end gap-4">
                <x-primary-button>{{ __('Update') }}</x-primary-button>
            </div>
        </form>
    </div>

    
    <div class="p-6 text-gray-900 dark:text-gray-100" x-show="$wire.title === 'create-blocked-date'">
        <form method="post" action="{{ route('create.blocked-date') }}" class="space-y-6">
            @csrf
            @method('patch')

            <div>
                <x-datetime-picker
                    name="date"
                    without-tips="true"
                    label="Appointment Date"
                    placeholder="Blocked Date"
                    :timezone="'Asia/Manila'"
                    display-format="YYYY-MM-DD HH:mm:ss"
                    wire:model="model"
                    :min="now()"
                    without-time="true"
                />
            </div>

            <div class="flex items-center justify-end gap-4">
                <x-primary-button>{{ __('Create') }}</x-primary-button>
            </div>
        </form>
    </div>
</x-modal>