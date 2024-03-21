<div>
    <form wire:submit="save">
        @include('livewire-wizard::steps-header')
        <div class="container p-4 mx-auto">
            {{ $this->getCurrentStep() }}
            <x-errors class="mt-4"/>
        </div>
        @include('livewire-wizard::steps-footer')
    </form>
</div>
