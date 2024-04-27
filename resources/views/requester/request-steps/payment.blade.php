<div>
    @if(isset($this->transaction))
        <x-native-select
            placeholder="Select payment method"
            :options="['Walk in', 'Online']"
            wire:model="state.payment_type"
            disabled
        />
    @else
        <x-native-select
            placeholder="Select payment method"
            :options="['Walk in', 'Online']"
            wire:model="state.payment_type"
        />
    @endif

    <div class="pt-4 px-4 -mb-2 flex justify-center items-center gap-4" x-show="$wire.state.payment_type === 'Online'">
        <input wire:model="state.checkout_id" type="hidden" required>
        <a href="{{optional($this->checkout)['checkout_url']}}" target="_blank" class="inline-flex items-center px-4 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-500 rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 disabled:opacity-25 transition ease-in-out duration-150">
            checkout
        </a>
    </div>
</div>