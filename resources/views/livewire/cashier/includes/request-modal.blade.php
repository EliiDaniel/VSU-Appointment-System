<x-modal name="request-modal" maxWidth="2xl" prompt="$wire.title !== 'filters'" disabledClose="false">

    @if(isset($selectedRequest))
        <div class="p-6 pb-0 text-gray-900 dark:text-gray-100" x-show="$wire.title === 'view-request'">
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
                    <div class="ml-2 my-4">
                        <span class="mr-2">●</span>{{ $selectedRequest->user ? $selectedRequest->user->name : $selectedRequest->verified_email->email }}
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
                                class="border h-7 w-7 rounded-full text-sm font-medium relative z-[50] data-[tooltip]:after:content-[attr(data-tooltip)] data-[tooltip]:after:invisible data-[tooltip]:after:scale-50 data-[tooltip]:after:origin-bottom data-[tooltip]:after:opacity-0 hover:data-[tooltip]:after:visible hover:data-[tooltip]:after:opacity-100 hover:data-[tooltip]:after:scale-100 data-[tooltip]:after:transition-all data-[tooltip]:after:absolute data-[tooltip]:after:bg-gray-900 data-[tooltip]:after:bottom-[calc(100%+4px)] data-[tooltip]:after:left-1/2 data-[tooltip]:after:-translate-x-1/2 data-[tooltip]:after:-z-[1] data-[tooltip]:after:px-1.5 data-[tooltip]:after:py-1 data-[tooltip]:after:min-h-fit data-[tooltip]:after:min-w-fit data-[tooltip]:after:rounded-md data-[tooltip]:after:drop-shadow data-[tooltip]:before:drop-shadow data-[tooltip]:after:text-center data-[tooltip]:after:text-white data-[tooltip]:after:whitespace-nowrap data-[tooltip]:after:text-[10px] data-[tooltip]:before:invisible data-[tooltip]:before:opacity-0 hover:data-[tooltip]:before:visible hover:data-[tooltip]:before:opacity-100 data-[tooltip]:before:transition-all data-[tooltip]:before:bg-gray-900 data-[tooltip]:before:[clip-path:polygon(100%_0,0_0,50%_100%)] data-[tooltip]:before:absolute data-[tooltip]:before:bottom-full data-[tooltip]:before:left-1/2 data-[tooltip]:before:-translate-x-1/2 data-[tooltip]:before:z-0 data-[tooltip]:before:w-3 data-[tooltip]:before:h-[4px]"
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
                                <x-secondary-button wire:click="viewDocumentProcess({{ $document }}, {{ $document->pivot->id }})">
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
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                        </svg>
                                    </span>
                                @endif
                            </div>
                            <span class="whitespace-nowrap flex items-center justify-end  gap-2">
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
                    <div class="flex text-xl pt-3 border-t-2 border-gray-300 dark:border-gray-500 mt-2 items-center justify-between my-4">
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
                            
                            <div :class="{ 'p-2 border border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm ring-emerald-500 ring-offset-2 dark:ring-offset-gray-800 transition ease-in-out duration-75': true, 'ring-2 animate-jump animate-once animate-ease-in-out': {{ in_array($process->pivot->document_process_id, $completedProcesses->toArray()) ? 'true' : 'false' }} }">
                                {{ $process->name }}
                            </div>
                        </div>
                    @endforeach
                    </div>
                @endif
            </x-modal-second>
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

    @if(!$selectedRequest->paid_at && !$selectedRequest->canceled_at)
        <div class="flex items-center justify-end">
            <x-primary-button class="ms-4 mb-4 mr-4" @click="$dispatch('confirm-approve')">
                {{ __('Approve') }}
            </x-primary-button>
        </div>
    @else
        <div class="flex items-center justify-end">
            <x-primary-button class="ms-4 mb-4 mr-4" @click="show = false">
                {{ __('Done') }}
            </x-primary-button>
        </div>
    @endif
</x-modal>

@if (session('status'))
    <div
        wire:ignore
        x-data="{ show: true }"
        x-show="show"
        x-transition
        x-init="setTimeout(() => show = false, 4000)"
        class="fixed top-4 right-4 bg-green-300 text-gray-700 dark:bg-green-700 dark:text-gray-300 pl-3 pr-20 py-3 rounded-lg z-50 opacity-75 hover:opacity-100 ease-in-out duration-200"
        role="alert"
    >
        <span class="block sm:inline tracking-widest font-extrabold text-sm">{{ __(session('status')) }}</span>
        <span class="absolute top-0 bottom-0 right-0 pt-[9.80px] pr-3 cursor-pointer" @click="show = false">
            <svg class="fill-current h-6 w-5 text-gray-200" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 1.697l-2.651-2.65-2.65 2.65a1.2 1.2 0 1 1-1.697-1.697l2.65-2.651-2.65-2.65a1.2 1.2 0 1 1 1.697-1.697l2.651 2.65 2.65-2.65a1.2 1.2 0 1 1 1.697 1.697l-2.65 2.651 2.65 2.65z"/></svg>
        </span>
    </div>
@endif