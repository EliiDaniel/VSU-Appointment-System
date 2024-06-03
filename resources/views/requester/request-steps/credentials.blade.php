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
        <div class="flex gap-2 items-center">
            <x-input-label for="name" :value="__('Please upload a valid ID')" />
            <button
                class="border h-5 w-5 rounded-full text-sm font-medium relative z-[50] data-[tooltip]:after:content-[attr(data-tooltip)] data-[tooltip]:after:invisible data-[tooltip]:after:scale-50 data-[tooltip]:after:origin-bottom data-[tooltip]:after:opacity-0 hover:data-[tooltip]:after:visible hover:data-[tooltip]:after:opacity-100 hover:data-[tooltip]:after:scale-100 data-[tooltip]:after:transition-all data-[tooltip]:after:absolute data-[tooltip]:after:bg-gray-900 data-[tooltip]:after:bottom-[calc(100%+4px)] data-[tooltip]:after:left-1/2 data-[tooltip]:after:-translate-x-1/2 data-[tooltip]:after:-z-[1] data-[tooltip]:after:px-1.5 data-[tooltip]:after:py-1 data-[tooltip]:after:min-h-fit data-[tooltip]:after:min-w-fit data-[tooltip]:after:rounded-md data-[tooltip]:after:drop-shadow data-[tooltip]:before:drop-shadow data-[tooltip]:after:text-center data-[tooltip]:after:text-white data-[tooltip]:after:w-52 sm:data-[tooltip]:after:whitespace-nowrap data-[tooltip]:after:text-[10px] data-[tooltip]:before:invisible data-[tooltip]:before:opacity-0 hover:data-[tooltip]:before:visible hover:data-[tooltip]:before:opacity-100 data-[tooltip]:before:transition-all data-[tooltip]:before:bg-gray-900 data-[tooltip]:before:[clip-path:polygon(100%_0,0_0,50%_100%)] data-[tooltip]:before:absolute data-[tooltip]:before:bottom-full data-[tooltip]:before:left-1/2 data-[tooltip]:before:-translate-x-1/2 data-[tooltip]:before:z-0 data-[tooltip]:before:w-3 data-[tooltip]:before:h-[4px]"
                data-tooltip="School ID, Driver’s License, Passport, Philippine Identification (PhilID / ePhilID), Phil-health ID, SSS ID, and Other valid government-issued IDs"
            >
                ?
            </button>

        </div>
        <input type="file" x-ref="input" class="mt-1" data-max-file-size="10MB">
    </div>
</div>