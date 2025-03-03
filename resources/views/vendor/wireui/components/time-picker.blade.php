<div
    x-data="wireui_timepicker({
        model: @entangleable($attributes->wire('model')),
        config: {
            isBlur:   @boolean($attributes->wire('model')->hasModifier('blur')),
            interval: @toJs($interval),
            format:   @toJs($format),
            is12H:    @boolean($format == '12'),
            readonly: @boolean($readonly),
            disabled: @boolean($disabled),
        },
    })"
    {{ $attributes
        ->only('wire:key')
        ->class('w-full relative')
        ->merge(['wire:key' => "timepicker::{$name}"]) }}
>
    <div class="relative">
        <x-dynamic-component
            :component="WireUi::component('input')"
            {{ $attributes->whereDoesntStartWith(['wire:model', 'x-model', 'wire:key']) }}
            :borderless="$borderless"
            :shadowless="$shadowless"
            :label="$label"
            :hint="$hint"
            :corner-hint="$cornerHint"
            :icon="$icon"
            :prefix="$prefix"
            :prepend="$prepend"
            x-model="input"
            class="py-[10px] border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-emerald-500 dark:focus:border-emerald-600 focus:ring-emerald-500 dark:focus:ring-emerald-600 rounded-md shadow-sm0"
            x-on:input.debounce.150ms="onInput($event.target.value)"
            x-on:blur="emitInput">
            <x-slot name="append">
                <div class="absolute inset-y-0 right-3 z-5 flex items-center justify-center">
                    <div @class([
                        'flex items-center gap-x-2 my-auto dark:text-gray-300',
                        'text-negative-400 dark:text-negative-600' => $name && $errors->has($name),
                        'text-gray-400'                         => $name && $errors->has($name),
                    ])>
                        <x-dynamic-component
                            :component="WireUi::component('icon')"
                            class="cursor-pointer w-4 h-4 hover:text-negative-500 transition-colors ease-in-out duration-150"
                            x-cloak
                            name="x"
                            x-show="!config.readonly && !config.disabled && input"
                            x-on:click="clearInput"
                        />

                        <x-dynamic-component
                            :component="WireUi::component('icon')"
                            class="cursor-pointer w-5 h-5"
                            name="clock"
                            x-show="!config.readonly && !config.disabled"
                            x-on:click="toggle"
                        />
                    </div>
                </div>
            </x-slot>
        </x-dynamic-component>
    </div>

    <x-wireui::parts.popover
        class="p-2.5 sm:max-w-[15rem] border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300"
        :margin="(bool) $label"
        x-on:keydown.tab.prevent="$event.shiftKey || getNextFocusable().focus()"
        x-on:keydown.arrow-down.prevent="$event.shiftKey || getNextFocusable().focus()"
        x-on:keydown.shift.tab.prevent="getPrevFocusable().focus()"
        x-on:keydown.arrow-up.prevent="getPrevFocusable().focus()"
    >   

    <x-dynamic-component
            :component="WireUi::component('input')"
            :label="trans('wireui::messages.selectTime')"
            tabindex="0"
            x-model="search"
            x-bind:placeholder="input ? input : '12:00'"
            x-ref="search"
            x-on:input.debounce.150ms="onSearch($event.target.value)"
            class="hidden"
        />
        <ul class="mt-1 w-full h-64 sm:h-32 pb-1 pt-2 overflow-y-auto soft-scrollbar">
            <template x-for="time in filteredTimes">
                <li class="group rounded-md focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-700
                                   relative py-2 pl-2 pr-9 text-left transition-colors ease-in-out duration-100 cursor-pointer select-none
                                   hover:text-white hover:bg-gray-600 dark:hover:bg-gray-700 dark:text-gray-400"
                    :class="{
                        'text-gray-600':   input === time.value,
                        'text-gray-700': input !== time.value,
                    }"
                    tabindex="0"
                    x-on:keydown.enter="selectTime(time)"
                    x-on:click="selectTime(time)">
                    <span x-text="time.label" class="font-normal block truncate
                    z"></span>
                    <span
                        class="
                            absolute text-gray-600 group-hover:text-white inset-y-0
                            right-0 flex items-center pr-4 dark:text-gray-400
                        "
                        x-show="input === time.value">
                        <x-dynamic-component
                            :component="WireUi::component('icon')"
                            name="check"
                            class="h-5 w-5"
                        />
                    </span>
                </li>
            </template>
        </ul>
    </x-wireui::parts.popover>
</div>
