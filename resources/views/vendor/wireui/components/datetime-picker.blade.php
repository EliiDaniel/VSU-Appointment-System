<div
    x-data="wireui_datetime_picker({
        model: @entangleable($attributes->wire('model')),
    })"
    x-props="{
        config: {
            interval: @toJs($interval),
            is12H:    @boolean($timeFormat == '12'),
            readonly: @boolean($readonly),
            disabled: @boolean($disabled),
            min: @toJs($min ? $min->format('Y-m-d\TH:i') : null),
            max: @toJs($max ? $max->format('Y-m-d\TH:i') : null),
            minTime: @toJs($minTime),
            maxTime: @toJs($maxTime),
        },
        withoutTimezone: @boolean($withoutTimezone),
        timezone:      @toJs($timezone),
        userTimezone:  @toJs($userTimezone ?? ''),
        parseFormat:   @toJs($parseFormat ?? ''),
        displayFormat: @toJs($displayFormat ?? ''),
        weekDays:      @lang('wireui::messages.datePicker.days'),
        monthNames:    @lang('wireui::messages.datePicker.months'),
        withoutTime:   @boolean($withoutTime),
    }"
    {{ $attributes
        ->only('wire:key')
        ->class('relative w-full')
        ->merge(['wire:key' => "datepicker::{$name}"]) }}
>
    <x-dynamic-component
        :component="WireUi::component('input')"
        {{ $attributes->whereDoesntStartWith(['wire:model', 'x-model', 'wire:key', 'readonly']) }}
        :borderless="$borderless"
        :shadowless="$shadowless"
        :label="$label"
        :hint="$hint"
        :corner-hint="$cornerHint"
        :icon="$icon"
        :prefix="$prefix"
        :prepend="$prepend"
        class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-emerald-500 dark:focus:border-emerald-600 focus:ring-emerald-500 dark:focus:ring-emerald-600 rounded-md shadow-sm0"
        readonly
        x-on:click="toggle"
        x-bind:value="model ? getDisplayValue() : model">
        @if (!$readonly && !$disabled)
            <x-slot name="append">
                <div class="absolute inset-y-0 right-3 z-5 flex items-center justify-center">
                    <div class="flex items-center gap-x-2 my-auto
                        {{ $errors->has($name) ? 'text-negative-400 dark:text-negative-600' : 'text-gray-400' }}">

                        @if ($clearable)
                            <x-dynamic-component
                                :component="WireUi::component('icon')"
                                class="cursor-pointer w-4 h-4 hover:text-negative-500 transition-colors ease-in-out duration-150"
                                x-cloak
                                name="x"
                                x-show="model"
                                x-on:click="clearDate()"
                            />
                        @endif
                        <x-dynamic-component
                            :component="WireUi::component('icon')"
                            class="cursor-pointer w-5 h-5"
                            :name="$rightIcon"
                            x-on:click="toggle"
                        />
                    </div>
                </div>
            </x-slot>
        @endif
    </x-dynamic-component>

    <x-wireui::parts.popover
        :margin="(bool) $label"
        root-class="sm:!w-72 ml-auto"
        class="max-h-96 overflow-y-auto p-3 sm:w-72 bg-white dark:bg-gray-700 border-none"
    >
        <div x-show="tab === 'date'" class="space-y-5">
            @unless ($withoutTips)
                <div class="grid grid-cols-3 gap-x-2 text-center text-gray-600">
                    <x-dynamic-component
                        :component="WireUi::component('button')"
                        class="bg-gray-100 border-none dark:bg-gray-800"
                        x-on:click="selectYesterday"
                        :label="__('wireui::messages.datePicker.yesterday')"
                    />
                    <x-dynamic-component
                        :component="WireUi::component('button')"
                        class="bg-gray-100 border-none dark:bg-gray-800"
                        x-on:click="selectToday"
                        :label="__('wireui::messages.datePicker.today')"
                    />

                    <x-dynamic-component
                        :component="WireUi::component('button')"
                        class="bg-gray-100 border-none dark:bg-gray-800"
                        x-on:click="selectTomorrow"
                        :label="__('wireui::messages.datePicker.tomorrow')"
                    />
                </div>
            @endunless

            <div class="flex items-center justify-between">
                <x-dynamic-component
                    :component="WireUi::component('button')"
                    class="rounded-lg shrink-0"
                    x-show="!monthsPicker"
                    x-on:click="previousMonth"
                    icon="chevron-left"
                    primary
                />

                <div class="w-full flex items-center justify-center gap-x-2 text-gray-600 dark:text-gray-100">
                    <button class="focus:outline-none focus:underline"
                            x-text="monthNames[month]"
                            x-on:click="monthsPicker = !monthsPicker"
                            type="button">
                    </button>
                    <input class="w-16 appearance-none p-0 pl-1 ring-0 border-none rounded-md focus:ring-0 focus:outline-none dark:bg-gray-800"
                           x-model="year"
                           x-on:input.debounce.500ms="if (year.length === 4) fillPickerDates()"
                           type="number"
                    />
                </div>

                <x-dynamic-component
                    :component="WireUi::component('button')"
                    class="rounded-lg shrink-0"
                    x-show="!monthsPicker"
                    x-on:click="nextMonth"
                    icon="chevron-right"
                    primary
                />
            </div>

            <div class="relative">
                <div class="absolute inset-0 bg-white dark:bg-gray-700 grid grid-cols-3 gap-3"
                     x-show="monthsPicker"
                     x-transition>
                    <template x-for="(monthName, index) in monthNames" :key="`month.${monthName}`">
                        <x-dynamic-component
                            :component="WireUi::component('button')"
                            class="text-gray-400 dark:border-0 dark:hover:bg-gray-700 uppercase"
                            x-on:click="selectMonth(index)"
                            x-text="monthName"
                            xs
                            gray
                        />
                    </template>
                </div>

                <div class="grid grid-cols-7 gap-2">
                    <template x-for="day in weekDays" :key="`week-day.${day}`">
                        <span class="text-gray-600 dark:text-gray-200 text-xs text-center uppercase pointer-events-none"
                            x-text="day">
                        </span>
                    </template>

                    <template
                        x-for="(date, index) in dates"
                        :key="`date.${date.day}.${date.month}`"
                    >
                        <div class="flex justify-center picker-days">
                            <button class="text-sm w-7 h-6 focus:outline-none rounded-md focus:ring-2 focus:ring-ofsset-2 focus:ring-gray-600
                                         hover:bg-gray-100 dark:hover:bg-gray-800 dark:focus:ring-gray-400
                                          disabled:cursor-not-allowed"
                                :class="{
                                    'text-gray-600 dark:text-gray-100': !(date.isDisabled || `${date.year}-${date.month + 1}-${date.day}` === '{{$this->dateConfigs['blockedDates']}}' || !{{ json_encode($this->schedule->enabled_days) }}.includes((index % 7))) && !date.isSelected && date.month === month,
                                    'text-gray-400 dark:text-gray-500': date.isDisabled || `${date.year}-${date.month + 1}-${date.day}` === '{{$this->dateConfigs['blockedDates']}}' || date.month !== month || !{{ json_encode($this->schedule->enabled_days) }}.includes((index % 7)),
                                    '!text-green-500 bg-gray-600 font-semibold border border-gray-600': date.isSelected,
                                    'disabled:bg-gray-400 disabled:border-gray-400': date.isSelected,
                                    'hover:bg-gray-600 dark:bg-gray-700 dark:border-green-400': date.isSelected,
                                }"
                                :disabled="date.isDisabled || `${date.year}-${date.month + 1}-${date.day}` === '{{$this->dateConfigs['blockedDates']}}' || !{{ json_encode($this->schedule->enabled_days) }}.includes((index % 7))"
                                x-on:click="selectDate(date)"
                                x-text="date.day"
                                type="button">
                            </button>
                        </div>
                    </template>
                </div>
            </div>
        </div>

        <div x-show="tab === 'time'" x-transition>
            <div x-ref="timesContainer"
                 class="mt-1 w-full max-h-52 pb-1 pt-2 overflow-y-auto flex flex-col picker-times">
                <template x-for="time in filteredTimes" :key="time.value">
                    <button class="group rounded-md focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-700
                                   relative py-2 pl-2 pr-9 text-left transition-colors ease-in-out duration-100 cursor-pointer select-none
                                   hover:text-white hover:bg-gray-600 dark:hover:bg-gray-700 dark:text-gray-400"
                            :class="{
                            'text-gray-600': modelTime === time.value,
                            'text-gray-700': modelTime !== time.value,
                        }"
                        :name="`times.${time.value}`"
                        type="button"
                        x-on:click="selectTime(time)">
                        <span x-text="time.label"></span>
                        <span class="text-gray-600 dark:text-gray-400 group-hover:text-white
                                     absolute inset-y-0 right-0 flex items-center pr-4"
                              x-show="modelTime === time.value">
                            <x-dynamic-component
                                :component="WireUi::component('icon')"
                                name="check"
                                class="h-5 w-5"
                            />
                        </span>
                    </button>
                </template>
            </div>
        </div>
    </x-wireui::parts.popover>
</div>
