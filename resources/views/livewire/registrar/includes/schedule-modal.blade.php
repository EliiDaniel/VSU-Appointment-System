<x-modal name="schedule-modal" prompt="true" disabledClose="false" maxWidth="xl">
    <div class="p-6" x-show="$wire.title === 'view-schedule'">
        <form x-data="{ openConfirmDialog() {
            window.$wireui.confirmDialog({
                title: 'Are you sure?',
                description: 'Do you really want to update setting?',
                icon: 'warning',
                accept: {
                    label: 'Yes, update it',
                    execute: () => {
                        this.$refs.form.submit();
                    }
                },
                reject: {
                    label: 'No, cancel'
                }
            });
        }}" @submit.prevent="openConfirmDialog" x-ref="form" method="post" action="{{ route('update.schedule') }}"  class="space-y-6">
            @csrf
            @method('patch')

            <div class="flex flex-wrap md:grid grid-cols-3 gap-4">
                <div>
                    <x-input-label for="daily_limit" :value="__('Daily Limit')" />
                    <x-text-input id="daily_limit" name="daily_limit" type="number" class="mt-1 w-full" value="{{ old('name', $schedule->daily_limit) }}" required autofocus />
                </div>
                <div>
                    <x-time-picker
                        label="Minimum Available Tme"
                        format="24"
                        wire:model="minTime"
                        name="min_time"
                        interval="30"
                    />
                </div>
                <div>
                    <x-time-picker
                        label="Maximum Available Tme"
                        format="24"
                        wire:model="maxTime"
                        name="max_time"
                        interval="30"
                    />
                </div>
            </div>

            <div class="flex flex-wrap md:grid grid-cols-2 gap-4">           
                <div>
                    <div class="flex gap-2">
                        <button
                            class="border h-5 w-5 rounded-full text-xs font-medium text-gray-900 dark:text-gray-100 relative z-[50] data-[tooltip]:after:content-[attr(data-tooltip)] data-[tooltip]:after:invisible data-[tooltip]:after:scale-50 data-[tooltip]:after:origin-bottom data-[tooltip]:after:opacity-0 hover:data-[tooltip]:after:visible hover:data-[tooltip]:after:opacity-100 hover:data-[tooltip]:after:scale-100 data-[tooltip]:after:transition-all data-[tooltip]:after:absolute data-[tooltip]:after:bg-gray-900 data-[tooltip]:after:bottom-[calc(100%+4px)] data-[tooltip]:after:left-1/2 data-[tooltip]:after:-translate-x-1/2 data-[tooltip]:after:-z-[1] data-[tooltip]:after:px-1.5 data-[tooltip]:after:py-1 data-[tooltip]:after:min-h-fit data-[tooltip]:after:min-w-fit data-[tooltip]:after:rounded-md data-[tooltip]:after:drop-shadow data-[tooltip]:before:drop-shadow data-[tooltip]:after:text-center data-[tooltip]:after:text-white data-[tooltip]:after:whitespace-nowrap data-[tooltip]:after:text-[10px] data-[tooltip]:before:invisible data-[tooltip]:before:opacity-0 hover:data-[tooltip]:before:visible hover:data-[tooltip]:before:opacity-100 data-[tooltip]:before:transition-all data-[tooltip]:before:bg-gray-900 data-[tooltip]:before:[clip-path:polygon(100%_0,0_0,50%_100%)] data-[tooltip]:before:absolute data-[tooltip]:before:bottom-full data-[tooltip]:before:left-1/2 data-[tooltip]:before:-translate-x-1/2 data-[tooltip]:before:z-0 data-[tooltip]:before:w-3 data-[tooltip]:before:h-[4px]"
                            data-tooltip="Number of days from day of request"
                        >
                            ?
                        </button>
                        <x-input-label for="min" :value="__('Minimum Date')" />
                    </div>
                    <x-text-input id="min" name="min" type="number" class="mt-1 w-full" value="{{ old('name', $schedule->min) }}"  required autofocus autocomplete="name" />
                </div>
                <div>
                    <div class="flex gap-2">
                        <button
                            class="border h-5 w-5 rounded-full text-xs font-medium text-gray-900 dark:text-gray-100 relative z-[50] data-[tooltip]:after:content-[attr(data-tooltip)] data-[tooltip]:after:invisible data-[tooltip]:after:scale-50 data-[tooltip]:after:origin-bottom data-[tooltip]:after:opacity-0 hover:data-[tooltip]:after:visible hover:data-[tooltip]:after:opacity-100 hover:data-[tooltip]:after:scale-100 data-[tooltip]:after:transition-all data-[tooltip]:after:absolute data-[tooltip]:after:bg-gray-900 data-[tooltip]:after:bottom-[calc(100%+4px)] data-[tooltip]:after:left-1/2 data-[tooltip]:after:-translate-x-1/2 data-[tooltip]:after:-z-[1] data-[tooltip]:after:px-1.5 data-[tooltip]:after:py-1 data-[tooltip]:after:min-h-fit data-[tooltip]:after:min-w-fit data-[tooltip]:after:rounded-md data-[tooltip]:after:drop-shadow data-[tooltip]:before:drop-shadow data-[tooltip]:after:text-center data-[tooltip]:after:text-white data-[tooltip]:after:whitespace-nowrap data-[tooltip]:after:text-[10px] data-[tooltip]:before:invisible data-[tooltip]:before:opacity-0 hover:data-[tooltip]:before:visible hover:data-[tooltip]:before:opacity-100 data-[tooltip]:before:transition-all data-[tooltip]:before:bg-gray-900 data-[tooltip]:before:[clip-path:polygon(100%_0,0_0,50%_100%)] data-[tooltip]:before:absolute data-[tooltip]:before:bottom-full data-[tooltip]:before:left-1/2 data-[tooltip]:before:-translate-x-1/2 data-[tooltip]:before:z-0 data-[tooltip]:before:w-3 data-[tooltip]:before:h-[4px]"
                            data-tooltip="Number of days from the minimum booking date"
                        >
                            ?
                        </button>
                        <x-input-label for="max" :value="__('Maximum Date')" />
                    </div>
                    <x-text-input id="max" name="max" type="number" class="mt-1  w-full" value="{{ old('name', $schedule->max) }}" required autofocus autocomplete="name" />    
                </div>
            </div>

            <div class="flex flex-wrap gap-4 text-gray-900 dark:text-gray-100">
                @foreach(['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'] as $day)
                    <div x-data="{ isChecked: false }" x-init="isChecked = {{ in_array($loop->index + 1, $selectedDays) ? 'true' : 'false' }}" class="mr-2 mb-2">
                        <label>
                            <input x-model="isChecked" type="checkbox" wire:model="selectedDays" name="days[]" value="{{$loop->index + 1}}" class="hidden">
                            <button type="button" @click="isChecked = !isChecked" x-bind:class="{ 'outline-none ring-2 ring-emerald-500 ring-offset-2 dark:ring-offset-gray-800': isChecked }" class="inline-flex items-center px-4 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-500 rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 disabled:opacity-25 transition ease-in-out duration-150">
                                {{ $day }}
                            </button>
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
        <form wire:submit.prevent="blockDate" class="space-y-6">
            @csrf
            @method('patch')

            <x-datetime-picker
                name="date"
                without-tips="true"
                label="Choose a date to block"
                placeholder="Blocked Date"
                wire:model="state.block_date"
                :timezone="'Asia/Manila'"
                display-format="YYYY-MM-DD"
                :min="now()"
                without-time="true"
            />

            <div class="flex items-center justify-end gap-4">
                <x-primary-button>{{ __('Create') }}</x-primary-button>
            </div>
        </form>
    </div>
</x-modal>

@if (session('status'))
    <div wire:ignore x-init="() => $wire.sessionNotif('{{ session('status') }}')"></div>
@endif