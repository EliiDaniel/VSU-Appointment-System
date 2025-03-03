<div class="w-full @if($disabled) opacity-60 @endif">
    @if ($label)
        <x-dynamic-component
            :component="WireUi::component('label')"
            class="mb-1"
            :label="$label"
            :has-error="$errors->has($name)"
            :for="$id"
        />
    @endif

    <select {{ $attributes->class([
        'form-select block w-full pl-3 pr-10 py-2 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-emerald-500 dark:focus:border-emerald-600 focus:ring-emerald-500 dark:focus:ring-emerald-600 rounded-md shadow-sm',
        $errorClasses() =>  $errors->has($name),
        $colorClasses() => !$errors->has($name),
    ]) }}>
        @if ($options->isNotEmpty())
            @if ($placeholder)
                <option value="">{{ $placeholder }}</option>
            @endif

            @forelse ($options as $key => $option)
                <option value="{{ $getOptionValue($key, $option) }}"
                    @if(data_get($option, 'disabled', false)) disabled @endif>
                    {{ $getOptionLabel($option) }}
                </option>
            @empty
                @unless ($hideEmptyMessage)
                    <option disabled>
                        {{ $emptyMessage ?? __('wireui::messages.empty_options') }}
                    </option>
                @endunless
            @endforelse
        @else {{ $slot }} @endif
    </select>

    @if ($hint)
        <label @if ($id) for="{{ $id }}" @endif class="mt-2 text-sm text-secondary-500 dark:text-secondary-400">
            {{ $hint }}
        </label>
    @endif
</div>
