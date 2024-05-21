<div class="fixed inset-0 flex items-end overflow-y-auto sm:pt-16 justify-center {{ $align }} {{ $zIndex }}"
    x-data="wireui_dialog({ id: '{{ $dialog }}' })"
    x-show="show"
    x-on:wireui:{{ $dialog }}.window="showDialog($event.detail)"
    x-on:wireui:confirm-{{ $dialog }}.window="confirmDialog($event.detail)"
    x-on:keydown.escape.window="handleEscape"
    style="display: none"
    x-cloak>
    <div class="fixed inset-0 bg-gray-400 bg-opacity-60 transform transition-opacity
        {{ $dialog }}-backdrop @if ($blur) {{ $blur }} @endif dark:bg-gray-700 dark:bg-opacity-60"
        x-show="show"
        x-on:click="dismiss"
        x-transition:enter="ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0">
    </div>

    <div class="w-full transition-all p-4 sm:max-w-lg"
        x-show="show"
        x-transition:enter="ease-out duration-300"
        x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
        x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
        x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
        x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
        x-on:mouseenter="pauseTimeout"
        x-on:mouseleave="resumeTimeout">
        <div class="relative shadow-md bg-white dark:bg-gray-800 rounded-xl space-y-4 p-4"
            :class="{
                'sm:p-5 sm:pt-7': style === 'center',
                'sm:p-0 sm:pt-1': style === 'inline',
            }">
            <div class="bg-gray-300 dark:bg-gray-600 rounded-full transition-all duration-150 ease-linear absolute top-0 left-0"
                style="height: 2px; width: 100%;"
                x-ref="progressbar"
                x-show="dialog && dialog.progressbar && dialog.timeout">
            </div>

            <div x-show="dialog && dialog.closeButton" class="absolute right-2 -top-2">
                <button class="{{ $dialog }}-button-close focus:outline-none p-1 focus:ring-2 focus:ring-gray-200 rounded-full text-gray-300"
                    x-on:click="close"
                    type="button">
                    <span class="sr-only">close</span>
                    <x-dynamic-component
                        :component="WireUi::component('icon')"
                        class="w-5 h-5"
                        name="x"
                    />
                </button>
            </div>

            <div class="space-y-4" :class="{ 'sm:space-x-4 sm:flex sm:items-center sm:space-y-0 sm:px-5 sm:py-2': style === 'inline' }">
                <div class="mx-auto flex items-center self-start justify-center shrink-0"
                    :class="{ 'sm:items-start sm:mx-0': style === 'inline' }"
                    x-show="dialog && dialog.icon">
                    <div x-ref="iconContainer"></div>
                </div>

                <div class="mt-4 w-full" :class="{ 'sm:mt-5': style === 'center' }">
                    <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-gray-400 text-center"
                        :class="{ 'sm:text-left': style === 'inline' }"
                        @unless($title) x-ref="title" @endunless>
                        {{ $title }}
                    </h3>

                    <p class="mt-2 text-sm text-gray-500 text-center"
                        :class="{ 'sm:text-left': style === 'inline' }"
                        @unless($description) x-ref="description" @endunless>
                        {{ $description }}
                    </p>

                    {{ $slot }}
                </div>
            </div>

            @if ($dialog !== 'dialog:request-rejection')
            <div class="grid grid-cols-1 gap-y-2 sm:gap-x-3 rounded-b-xl"
            :class="{
                'sm:grid-cols-2 sm:gap-y-0': style === 'center',
                'sm:p-4 sm:bg-gray-100 sm:dark:bg-gray-800 sm:grid-cols-none sm:flex sm:justify-end': style === 'inline',
            }"
            x-show="dialog && (dialog.accept || dialog.reject)">
            <div x-show="dialog && dialog.accept" class="sm:order-last dialog-accept-btn" x-ref="accept"></div>
            <div x-show="dialog && dialog.reject" class="dialog-reject-btn" x-ref="reject"></div>
        </div>
            @else
                <div class="grid grid-cols-1 gap-y-2 sm:gap-x-3 rounded-b-xl"
                :class="{
                    'sm:grid-cols-2 sm:gap-y-0': style === 'center',
                    'sm:p-4 sm:bg-gray-100 sm:dark:bg-gray-800 sm:grid-cols-none sm:flex sm:justify-end': style === 'inline',
                }">
                <div class="sm:order-last dialog-accept-btn">
                    <button wire:loading.attr="disabled" wire:loading.class="!cursor-waitz" class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 outline-none justify-center group transition-all ease-in duration-150 hover:shadow-sm disabled:opacity-80 disabled:cursor-not-allowed rounded gap-x-2 text-sm ring-warning-500 bg-warning-500 hover:bg-warning-600 hover:ring-warning-600 dark:ring-offset-slate-800 dark:bg-warning-700 dark:ring-warning-700 dark:hover:bg-warning-600 dark:hover:ring-warning-600 w-full dark:border-0 dark:hover:bg-secondary-700" type="submit">
                        Confirm
                    </button>
                </div>
                <div x-show="false" class="sm:order-last dialog-accept-btn" x-ref="accept"></div>
                <div x-show="dialog && dialog.reject" class="dialog-reject-btn" x-ref="reject"></div>
            </div>
            @endif
        </div>

            <div class="flex justify-center"
                x-show="dialog && dialog.close && !dialog.accept && !dialog.accept"
                x-ref="close">
            </div>
        </div>
    </div>
</div>
