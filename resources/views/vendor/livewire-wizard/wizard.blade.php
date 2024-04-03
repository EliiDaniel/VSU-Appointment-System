<div x-init="$watch('show', () => { $wire.resetForm() })">
    <form wire:submit="save">
        @include('livewire-wizard::steps-header')
        <div class="container p-4 mx-auto">
            {{ $this->getCurrentStep() }}
            <x-errors class="mt-4" title="Found {errors} invalid input(s) with your submission"/>
        </div>
        @include('livewire-wizard::steps-footer')
    </form>
</div>