<div>
    <div x-data="{disableClose: false}" class="px-6 -mt-28 rounded-md sm:px-0">
        <a href="/" wire:navigate>
            <x-application-logo maxWidth="2xl" class="w-20 h-20 fill-current text-gray-500" />
        </a>

        @if (!auth()->user())

        
            <div class="relative flex max-w-lg mx-auto items-center justify-center mt-6 bg-transparent">
                    <div class="absolute top-0 left-0 -translate-x-6 -translate-y-6 animate-pulse animate-infinite animate-duration-[2500ms] animate-ease-in-out">
                        <div class="w-28 md:w-36 h-28 md:h-36 bg-gradient-to-br from-emerald-900 to-emerald-500 rounded-full animate-updown shadow-[rgba(0,0,0,0.5)_0px_0px_200px_10px] dark:shadow-green-600"></div>
                    </div>
                    <div class="absolute bottom-0 right-0 translate-x-6 translate-y-6 animate-pulse animate-infinite animate-duration-[4300ms] animate-ease-in-out">
                        <div class="w-28 md:w-36 h-28 md:h-36 bg-gradient-to-tl from-emerald-900 to-emerald-500 rounded-full animate-downup shadow-[rgba(0,0,0,0.5)_0px_0px_200px_10px] dark:shadow-green-600"></div>
                    </div>
                    
                    <div class="flex justify-center items-center w-full mx-6 my-4 backdrop-blur-xl transition-all duration-300 ease-in-out ">
                        <div class="px-6 py-4 bg-white dark:bg-gray-800 w-full rounded-lg">
                        <form wire:submit.prevent="submitForm">
                            <div>
                                <x-input-label for="tracking" :value="__('Tracking Code')" />
                                <x-text-input wire:model="trackingNumber" class="block mt-1 w-full" type="text" name="tracking" required autofocus autocomplete="off" />
                            </div>

                            <div class="grid grid-cols-2 sm:flex items-center justify-between mt-4 gap-4">
                                <x-secondary-button wire:click="createRequest" class="h-full">
                                    {{ __('Request Documents') }}
                                </x-secondary-button>
                                <x-primary-button class="h-full">
                                    {{ __('Track Request') }}
                                </x-primary-button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            
            <x-modal name="tracking-modal" maxWidth="2xl" prompt="prompt" disabledClose="disableClose">
                <div class="p-6 text-gray-900 dark:text-gray-100" x-show="$wire.title === 'create-request'">
                    <livewire:wizards.no-account-request-form :documents="$documents" :re-dir="$dir" :verified-email="$email"/>
                </div>

            @if(isset($request))
                <div class="p-6 text-gray-900 dark:text-gray-100" x-show="$wire.title === 'view-request'">
                    <div class="text-lg flex items-center justify-between">
                        <span class="text-gray-600 dark:text-gray-400">Status: {{ $request->status }}</span>
                        <span class="text-gray-600 dark:text-gray-400 whitespace-nowrap">Request #{{ $request->tracking_code }}</span>
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
                                <span class="mr-2">●</span>{{ date('F j Y \a\t h:i a', strtotime($request->appointment_date)) }}
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
                                <span class="mr-2">●</span>{{ $request->payment_type === 'Walk in' ? 'Walk in' : 'Online, Reference No: ' . $request->transaction->referenceNo() }}
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
                                @foreach ($request->documents as $document)
                                <div class="flex items-center justify-between space-x-3">
                                    <div class="flex items-center space-x-1">
                                        <x-secondary-button wire:click="viewDocumentProcess({{ $document }}, {{ $document->pivot->id }})">{{ $document->name }}</x-secondary-button>
                                        @if($request->isDocumentComplete($document->pivot->id))
                                            <span class="text-emerald-600 dark:text-emerald-400">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                                </svg>
                                            </span>
                                        @endif
                                    </div>
                                    <span class="whitespace-nowrap flex items-center gap-2">
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
                                <span> ₱ {{ $request->price }}</span>
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

            @else
                <div class="p-6 text-gray-900 dark:text-gray-100" x-show="$wire.title === 'view-request'">
                    No Request Found
                </div>

            @endif
            </x-modal>
        @endif
    </div>
</div>
