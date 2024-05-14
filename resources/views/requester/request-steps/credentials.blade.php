<div class="flex flex-col gap-2">
    <div>
        <x-input-label for="requester_name" :value="__('Name')" />
        <x-text-input id="requester_name" wire:model="state.requester_name" type="text" class="mt-1 block w-full" value="" required autofocus autocomplete="name" />
    </div>

    <div>
        <x-input-label for="school_id" :value="__('ID Number')" />
        <x-text-input id="school_id" wire:model="state.school_id" type="text" class="mt-1 block w-full" value="" required autofocus autocomplete="name" />
    </div>
    <div wire:ignore x-init="
        FilePond.registerPlugin(FilePondPluginImagePreview);
        FilePond.setOptions({
            server: {
                process: (fieldName, file, metadata, load, error, progress, abort, transfer, options) => {
                    @this.upload('state.credentials', file, load, error, progress)
                },
                revert: (filename, load) => {
                    @this.removeUpload('state.credentials', filename, load)
                },
            },
            onreorderfiles(files, origin, target){
                @this.set('state.credentials', []);
                files.forEach(function(file) {
                    @this.upload('state.credentials', file.file);
                });
            },
            oninit(){
                @this.set('state.credentials', []);
            },
            allowMultiple: true,
            allowReorder: true,
            maxFiles: 3,
        });
        
        FilePond.create($refs.input, {
            files: [
                @foreach($this->resetCredentials() as $file)// Loop through each image for the post
                    {
                        source: '{{ $file->temporaryURL() }}',
                    },
                @endforeach
            ],
        });
        ">
        <x-input-label for="name" :value="__('Upload Image for Request Verification')" />
        <input type="file" x-ref="input" data-max-file-size="10MB">
    </div>
</div>