<x-modal name="request-modal" maxWidth="2xl" prompt="$wire.selectedRequestStatus !== 'Canceled'" disabledClose="false">
    @if(isset($selectedRequest))
        <div class="p-6 text-gray-900 dark:text-gray-100" x-show="$wire.title === 'view-request'">
            <div class="text-lg flex items-center justify-between">
                <span class="text-gray-600 dark:text-gray-400">Status: {{ $selectedRequest->status }}</span>
                <span class="text-gray-600 dark:text-gray-400 whitespace-nowrap">Request #{{ $selectedRequest->tracking_code }}</span>
            </div>
            <div class="mt-2">
                <div>
                    <div class="flex text-xl items-center">
                        <span class="mr-1">Requester</span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                        </svg>
                    </div>
                    <div class="flex ml-2 my-4">
                        @if ($selectedRequest->user)
                            ●
                            <div class="ml-2 flex items-center gap-1">
                                {{ $selectedRequest->user->name }}
                                @if ($selectedRequest->user->role !== 'confirmation')
                                    <span class="text-blue-500 flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 0 1-1.043 3.296 3.745 3.745 0 0 1-3.296 1.043A3.745 3.745 0 0 1 12 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 0 1-3.296-1.043 3.745 3.745 0 0 1-1.043-3.296A3.745 3.745 0 0 1 3 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 0 1 1.043-3.296 3.746 3.746 0 0 1 3.296-1.043A3.746 3.746 0 0 1 12 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 0 1 3.296 1.043 3.746 3.746 0 0 1 1.043 3.296A3.745 3.745 0 0 1 21 12Z" />
                                        </svg>
                                        <span class="text-xs uppercase tracking-widest font-semibold">verified</span>
                                    </span>
                                @endif
                            </div>
                        @else
                            <span class="mr-2">●</span>{{ $selectedRequest->verified_email->email }}
                        @endif
                    </div>
                </div>
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
                        <span class="mr-1">Payment Type:</span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 0 0-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 0 1-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 0 0 3 15h-.75M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm3 0h.008v.008H18V10.5Zm-12 0h.008v.008H6V10.5Z" />
                        </svg>
                    </div>
                    <div class="ml-2 my-4">
                        <span class="mr-2">●</span>{{ $selectedRequest->payment_type === 'Walk in' ? 'Walk in' : 'Online, Reference No: ' . $selectedRequest->transaction->reference_no }}
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
                        <div class="grid grid-cols-2 gap-2">
                            <div class="flex items-center space-x-1">
                                <x-secondary-button wire:click="viewDocumentProcess({{ $document }}, {{ $document->pivot->id }})" class="gap-2">
                                    {{ $document->name }}
                                    @if(($selectedRequest->user?->hasVerifiedEmail() || $selectedRequest->verfied_email) && $document->soft_copy_available )
                                        <span class="h-6 w-6 rounded-full text-sm font-medium relative z-[50] data-[tooltip]:after:content-[attr(data-tooltip)] data-[tooltip]:after:invisible data-[tooltip]:after:scale-50 data-[tooltip]:after:origin-bottom data-[tooltip]:after:opacity-0 hover:data-[tooltip]:after:visible hover:data-[tooltip]:after:opacity-100 hover:data-[tooltip]:after:scale-100 data-[tooltip]:after:transition-all data-[tooltip]:after:absolute data-[tooltip]:after:bg-gray-900 data-[tooltip]:after:bottom-[calc(100%+4px)] data-[tooltip]:after:left-1/2 data-[tooltip]:after:-translate-x-1/2 data-[tooltip]:after:-z-[1] data-[tooltip]:after:px-1.5 data-[tooltip]:after:py-1 data-[tooltip]:after:min-h-fit data-[tooltip]:after:min-w-fit data-[tooltip]:after:rounded-md data-[tooltip]:after:drop-shadow data-[tooltip]:before:drop-shadow data-[tooltip]:after:text-center data-[tooltip]:after:text-white data-[tooltip]:after:whitespace-nowrap data-[tooltip]:after:text-[10px] data-[tooltip]:before:invisible data-[tooltip]:before:opacity-0 hover:data-[tooltip]:before:visible hover:data-[tooltip]:before:opacity-100 data-[tooltip]:before:transition-all data-[tooltip]:before:bg-gray-900 data-[tooltip]:before:[clip-path:polygon(100%_0,0_0,50%_100%)] data-[tooltip]:before:absolute data-[tooltip]:before:bottom-full data-[tooltip]:before:left-1/2 data-[tooltip]:before:-translate-x-1/2 data-[tooltip]:before:z-0 data-[tooltip]:before:w-3 data-[tooltip]:before:h-[4px]"
                                        data-tooltip="With Soft Copy"
                                    >
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m3.75 9v6m3-3H9m1.5-12H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                                        </svg>
                                    </span>
                                    @endif
                                </x-secondary-button>
                                @if($selectedRequest->isDocumentComplete($document->pivot->id))
                                    <span class="text-emerald-600 dark:text-emerald-400">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                        </svg>
                                    </span>
                                @endif
                            </div>
                            <span class="whitespace-nowrap flex items-center justify-end gap-2">
                                    ₱ {{ $document->pivot->price }} 
                                <span>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                                    </svg>
                                </span>
                                {{ $document->pivot->quantity }}
                            </span>
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
                <div class="p-6 flex flex-col gap-4" wire:poll.visible.10s>
                    <div class="flex flex-wrap justify-center gap-2">
                        @foreach($selectedDocument->processes as $process)
                            <div class="flex items-center pt-1">
                                @if (!$loop->first)
                                    <span class="px-1 animate-jump animate-once animate-ease-in-out">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m12.75 15 3-3m0 0-3-3m3 3h-7.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                        </svg>
                                    </span>
                                @endif
                                @if ($selectedRequest->status === 'In Progress')
                                    <input type="checkbox" id="process-{{$loop->index}}" wire:model="completedProcesses" value="{{ $process->pivot->document_process_id }}" class="hidden peer"/>
                                @else
                                    <input disabled type="checkbox" id="process-{{$loop->index}}" wire:model="completedProcesses" value="{{ $process->pivot->document_process_id }}" class="hidden peer"/>
                                @endif
                                <label for="process-{{$loop->index}}" class="cursor-pointer peer-checked:outline-none peer-checked:ring-2 peer-checked:ring-emerald-500 peer-checked:ring-offset-2 dark:peer-checked:ring-offset-gray-800 inline-flex items-center px-4 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-500 rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 disabled:opacity-25 transition ease-in-out duration-150">
                                    {{$process->name}}
                                </label>
                            </div>
                        @endforeach
                        </div>
                    <div class="flex items-center justify-end -mb-2 -mr-2">
                        @if ($selectedRequest->status === 'In Progress')
                            <x-button primary type="submit" spinner="modifyDocProcess" :label="__('update')" wire:ignore x-on:confirm="{
                                title: 'Update?',
                                icon: 'warning',
                                method: 'modifyDocProcess',
                            }"/>
                        @endif
                    </div>
                </div>
                    
                @endif
            </x-modal-second>
        </div>

        <div class="flex justify-between">
            <div class="flex items-center justify-start">
                @if (!$selectedRequest->user || $selectedRequest->user?->role === 'confirmation')
                <x-secondary-button class="ms-4 mb-4 mr-4 border-none" wire:click="downloadCredentials()">
                    <div class="flex gap-2 items-center text-green-600">
                        Credentials 
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m20.25 7.5-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5m8.25 3v6.75m0 0-3-3m3 3 3-3M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z" />
                        </svg>
                    </div>
                </x-secondary-button>
                @endif
            </div>

            @if($selectedRequest->status !== 'Canceled')
                @if($selectedRequest->status === 'Pending Approval')
                    <div class="flex items-center justify-end">
                        <x-primary-button class="ms-4 mb-4 mr-4" @click="$dispatch('confirm-approve')">
                            {{ __('Approve') }}
                        </x-primary-button>
                    </div>
                @elseif($selectedRequest->status === 'Ready for Collection')
                    <div class="flex items-center justify-end">
                        <x-primary-button class="ms-4 mb-4 mr-4" @click="$dispatch('confirm-complete')">
                            {{ __('Complete Request') }}
                        </x-primary-button>
                    </div>
                @else
                    <div class="flex items-center justify-end">
                        <x-primary-button class="ms-4 mb-4 mr-4" @click="show = false">
                            {{ __('Done') }}
                        </x-primary-button>
                    </div>
                @endif
            @endif
        </div>
    @endif

    @if(isset($statuses))
            <div class="p-6 text-gray-900 dark:text-gray-100" x-show="$wire.title === 'filters'">
                <label class="whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-100">Documents:</label>
                <div class="flex flex-wrap pt-1">
                    @foreach($documents as $document)
                        <div class="flex items-center ml-4 whitespace-nowrap">
                            <input type="checkbox" id="{{ $document->name }}" wire:model.live="selectedDocuments" value="{{ $document->name }}" class="h-4 w-4 text-emerald-600 dark:text-emerald-400 border-gray-300 dark:border-gray-700 focus:ring-emerald-500 dark:focus:ring-emerald-600 bg-white dark:bg-gray-900 rounded">
                            <label for="{{ $document->name }}" class="ml-2 block text-gray-900 dark:text-gray-200">{{ ucfirst($document->name) }}</label>
                        </div>
                    @endforeach
                </div>

                <div class="sm:flex sm:space-x-3 items-center mt-4">
                    <div class="flex space-x-3 items-center">
                        <label class="whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-100">Type:</label>
                        <select
                            wire:model.live="type"
                            class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-emerald-500 dark:focus:border-emerald-600 focus:ring-emerald-500 dark:focus:ring-emerald-600 rounded-md shadow-sm">
                            <option value="">All</option>
                            <option value="Walk in">Walk in</option>
                            <option value="Online">Online</option>
                        </select>
                    </div>
                    
                    <div class="flex space-x-3 mt-2 sm:mt-0 items-center">
                        <label class="whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-100">Status:</label>
                        <select
                            wire:model.live="status"
                            class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-emerald-500 dark:focus:border-emerald-600 focus:ring-emerald-500 dark:focus:ring-emerald-600 rounded-md shadow-sm">
                            <option value="">All</option>
                            @foreach($statuses as $status)
                                <option value="{{ $status }}">{{ $status }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        @endif
</x-modal>