<x-modal name="create-request" maxWidth="3xl">
    Creating request modal
    <div class="p-6">
        <form method="post" action="">
            @csrf
            @method('patch')
            
            @livewire('requester.wizards.request-form')

            <div class="flex items-center justify-end mt-4">
                <x-primary-button class="ms-4">
                    {{ __('Create') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-modal>
