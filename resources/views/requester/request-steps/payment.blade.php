<div>    
    <x-native-select
    label="Payment Method"
        :options="[
            ['name' => 'Walk in',  'id' => 1],
            ['name' => 'Online', 'id' => 2],
        ]"
        option-label="name"
        option-value="id"
    />
</div>