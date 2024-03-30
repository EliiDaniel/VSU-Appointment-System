<div>    
    <x-native-select
    placeholder="Select payment method"
    :options="['Walk in', 'Online']"
    wire:model="state.payment_type"
    />
</div>