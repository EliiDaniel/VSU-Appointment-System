<x-modal name="create-request" maxWidth="2xl">
    <div class="p-6">
        <form method="post" action="">
            @csrf
            @method('patch')

            <livewire:requester.wizards.request-form :documents="$documents"/>
        </form>
    </div>
</x-modal>
