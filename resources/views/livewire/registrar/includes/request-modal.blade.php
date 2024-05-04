<x-modal name="request-modal" maxWidth="2xl" prompt="$wire.selectedRequestStatus !== 'Canceled'" disabledClose="false">
    @if(isset($selectedRequest))
        <div class="p-6 text-gray-900 dark:text-gray-100">
            <div class="text-lg flex items-center justify-between">
                <span class="text-gray-600 dark:text-gray-400">Status: {{ $selectedRequest->status }}</span>
                <span class="text-gray-600 dark:text-gray-400 whitespace-nowrap">Request #{{ $selectedRequest->tracking_code }}</span>
            </div>
            <div class="mt-2">
                <div>
                    <div class="flex text-xl items-center">
                        <span class="mr-1">Appointment Date</span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                    </div>
                    <div class="ml-2 my-4">
                        <span class="mr-2">●</span>{{ date('F j Y \a\t h:i a', strtotime($selectedRequest->appointment_date)) }}
                    </div>
                </div>
                <div>
                    <div class="flex text-xl items-center">
                        <span class="mr-1">Requested Documents</span>
                        <div class="flex flex-col gap-3 text-center items-center">
                            <button
                                class="border h-6 w-6 rounded-full text-sm font-medium relative z-[50] data-[tooltip]:after:content-[attr(data-tooltip)] data-[tooltip]:after:invisible data-[tooltip]:after:scale-50 data-[tooltip]:after:origin-bottom data-[tooltip]:after:opacity-0 hover:data-[tooltip]:after:visible hover:data-[tooltip]:after:opacity-100 hover:data-[tooltip]:after:scale-100 data-[tooltip]:after:transition-all data-[tooltip]:after:absolute data-[tooltip]:after:bg-gray-900 data-[tooltip]:after:bottom-[calc(100%+4px)] data-[tooltip]:after:left-1/2 data-[tooltip]:after:-translate-x-1/2 data-[tooltip]:after:-z-[1] data-[tooltip]:after:px-1.5 data-[tooltip]:after:py-1 data-[tooltip]:after:min-h-fit data-[tooltip]:after:min-w-fit data-[tooltip]:after:rounded-md data-[tooltip]:after:drop-shadow data-[tooltip]:before:drop-shadow data-[tooltip]:after:text-center data-[tooltip]:after:text-white data-[tooltip]:after:whitespace-nowrap data-[tooltip]:after:text-[10px] data-[tooltip]:before:invisible data-[tooltip]:before:opacity-0 hover:data-[tooltip]:before:visible hover:data-[tooltip]:before:opacity-100 data-[tooltip]:before:transition-all data-[tooltip]:before:bg-gray-900 data-[tooltip]:before:[clip-path:polygon(100%_0,0_0,50%_100%)] data-[tooltip]:before:absolute data-[tooltip]:before:bottom-full data-[tooltip]:before:left-1/2 data-[tooltip]:before:-translate-x-1/2 data-[tooltip]:before:z-0 data-[tooltip]:before:w-3 data-[tooltip]:before:h-[4px]"
                                data-tooltip="Click on document to view status"
                            >
                                ?
                            </button>
                        </div>

                    </div>
                    <div class="my-4 space-y-2">
                        @foreach ($selectedRequest->documents as $document)
                        <div class="flex items-center justify-between space-x-3">
                            <div class="flex items-center space-x-1">
                                <x-secondary-button wire:click="viewDocumentProcess({{ $document }}, {{ $document->pivot->id }})">{{ $document->name }}</x-secondary-button>
                                @if($selectedRequest->isDocumentComplete($document->pivot->id))
                                    <span class="text-emerald-600 dark:text-emerald-400">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                        </svg>
                                    </span>
                                @endif
                            </div>
                            <span class="whitespace-nowrap">₱ {{ $document->price }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>

                <div>
                    <div class="flex text-xl pt-3 border-t-2 border-gray-300 dark:border-gray-500 items-center justify-between my-4 mb-0">
                        <span class="mr-1">Request Price:</span>
                        <span> ₱ {{ $selectedRequest->price }}</span>
                    </div>
                </div>
            </div>
            
            <x-modal-second name="view-document" maxWidth="lg">
                @if(isset($selectedDocument))
                    <div class="flex flex-wrap p-6 justify-center">
                    @foreach($selectedDocument->processes as $process)
                        <div class="flex items-center pt-1">
                            @if (!$loop->first)
                                <span class="px-1 animate-jump animate-once animate-ease-in-out">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m12.75 15 3-3m0 0-3-3m3 3h-7.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                    </svg>
                                </span>
                            @endif
                            
                            <button {{ in_array($selectedRequest->status, ['Pending Approval' ,'Canceled', 'Completed']) ? 'disabled' : '' }} :class="{ 'p-2 border border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm ring-emerald-500 ring-offset-2 dark:ring-offset-gray-800 transition ease-in-out duration-75': true, 'ring-2 animate-jump animate-once animate-ease-in-out': {{ in_array($process->pivot->document_process_id, $completedProcesses->toArray()) ? 'true' : 'false' }} }" wire:click="modifyProcess({{ $process->pivot->document_process_id }})" wire:confirm="Are you sure you want mark this step as {{ in_array($process->pivot->document_process_id, $completedProcesses->toArray()) ? 'unfinished' : 'complete'}}?">
                                {{ $process->name }}
                            </button>

                        </div>
                    @endforeach
                    </div>
                @endif
            </x-modal-second>
        </div>

        @if($selectedRequest->status !== 'Canceled')
            @if($selectedRequest->status === 'Pending Approval')
                <div class="flex items-center justify-end">
                    <x-primary-button class="ms-4 mb-4 mr-4" wire:click="approveRequest()" wire:confirm="Are you sure you want to approve request?">
                        {{ __('Approve') }}
                    </x-primary-button>
                </div>
            @else
                <div class="flex items-center justify-end">
                    <x-primary-button class="ms-4 mb-4 mr-4" @click="$dispatch('confirm-close')">
                        {{ __('Done') }}
                    </x-primary-button>
                </div>
            @endif
        @endif
    @endif
</x-modal>