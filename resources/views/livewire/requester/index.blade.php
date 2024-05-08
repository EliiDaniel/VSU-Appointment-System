<div class="text-gray-900 dark:text-gray-100">
    <div class="hidden md:block mx-auto text-center bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden pt-8">
        <div class="text-3xl leading-5">
            AVAILABLE DOCUMENTS
        </div>

        <div class="text-gray-600 dark:text-gray-400">
            List of docs that are available to request
        </div>

        <div class="mt-4 bg-gradient-to-tl from-10% from-teal-600 to-99.99% to-yellow-500 min-w-full grid grid-cols-3 gap-1 text-white font-semibold text-lg p-4">
            @foreach ($documents as $document)
                <div class="flex items-center justify-center p-2">
                    {{$document->name}}
                </div>
            @endforeach
        </div>
    </div>

    <div class="md:flex justify-center items-center space-y-16 my-6 md:my-0 md:space-y-0 md:space-x-14 lg:space-x-24 md:py-16">
        <div class="bg-white dark:bg-gray-800 transform hover:scale-105 hover:rotate-1 rounded-lg min-h-80 md:min-h-96 max-w-60 md:min-w-72 md:max-w-72 mx-auto md:mx-0 transition-all duration-500 ease-in-out group relative">
            <x-card-link wire:click="createRequest()" class="cursor-pointer">    
                <div class="absolute inset-0 overflow-hidden rounded-lg">
                        <div class="-top-8 absolute inset-0 bg-gradient-to-tl from-teal-400 to-yellow-200 scale-0 origin-center transition-transform duration-700 group-hover:scale-150 rounded-full"></div>
                    </div>
                    <div class="absolute top-0 left-0 -translate-x-6 -translate-y-6">
                        <div class="w-28 md:w-36 h-28 md:h-36 bg-gradient-to-br from-emerald-900 to-emerald-500 rounded-full animate-updown"></div>
                    </div>

                    <div class="absolute bottom-0 right-0 translate-x-6 translate-y-6">
                        <div class="w-28 md:w-36 h-28 md:h-36 bg-gradient-to-tl from-emerald-900 to-emerald-500 rounded-full animate-downup"></div>
                    </div>
                    <div class="flex justify-center items-center min-h-80 md:min-h-96 max-w-60 md:min-w-72 md:max-w-72 backdrop-blur-xl rounded-lg group-hover:backdrop-blur-none transition-all duration-300 ease-in-out ">
                        <div>
                        <div class="relative w-36 h-36 group-hover:-translate-y-8 duration-300">
                            <div class="absolute top-0 left-0 w-36 h-36 rounded-full bg-transparent border-4 border-teal-400"></div>
                            <div class="absolute top-3 left-3 w-32 h-32 bg-teal-400 rounded-full flex items-center justify-center bg-gradient-to-tl from-teal-400 to-yellow-200 text-white group-hover:from-gray-800 group-hover:to-teal-400">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-24 h-24">
                                    <path fill-rule="evenodd" d="M17.663 3.118c.225.015.45.032.673.05C19.876 3.298 21 4.604 21 6.109v9.642a3 3 0 0 1-3 3V16.5c0-5.922-4.576-10.775-10.384-11.217.324-1.132 1.3-2.01 2.548-2.114.224-.019.448-.036.673-.051A3 3 0 0 1 13.5 1.5H15a3 3 0 0 1 2.663 1.618ZM12 4.5A1.5 1.5 0 0 1 13.5 3H15a1.5 1.5 0 0 1 1.5 1.5H12Z" clip-rule="evenodd" />
                                <path d="M3 8.625c0-1.036.84-1.875 1.875-1.875h.375A3.75 3.75 0 0 1 9 10.5v1.875c0 1.036.84 1.875 1.875 1.875h1.875A3.75 3.75 0 0 1 16.5 18v2.625c0 1.035-.84 1.875-1.875 1.875h-9.75A1.875 1.875 0 0 1 3 20.625v-12Z" />
                                <path d="M10.5 10.5a5.23 5.23 0 0 0-1.279-3.434 9.768 9.768 0 0 1 6.963 6.963 5.23 5.23 0 0 0-3.434-1.279h-1.875a.375.375 0 0 1-.375-.375V10.5Z" />
                                </svg>
                                <span class="absolute uppercase text-center group-hover:hidden mt-4 md:mt-16 text-gray-900 dark:text-gray-100 translate-y-24 duration-300 tracking-wide">
                                    Request Document
                                </span> 
                                <span class="absolute uppercase text-center opacity-0 group-hover:opacity-100 group-hover:text-gray-800 group-hover:text-xl group-hover:translate-y-24 duration-300">
                                    Request Document
                                </span> 
                                </div>
                            </div>
                        </div>
                    </div>
            </x-card-link>
        </div>

        <div class="bg-white dark:bg-gray-800 transform hover:scale-105 hover:rotate-1 rounded-lg min-h-80 md:min-h-96 max-w-60 md:min-w-72 md:max-w-72 mx-auto md:mx-0 transition-all duration-500 ease-in-out group relative">  
            <x-card-link :href="route('requester.requests')">
                <div class="absolute inset-0 overflow-hidden rounded-lg">
                        <div class="-top-8 absolute inset-0 bg-gradient-to-tl from-teal-400 to-yellow-200 scale-0 origin-center transition-transform duration-700 group-hover:scale-150 rounded-full"></div>
                    </div>
                    <div class="absolute top-0 left-0 -translate-x-6 -translate-y-6">
                        <div class="w-28 md:w-36 h-28 md:h-36 bg-gradient-to-br from-emerald-900 to-emerald-500 rounded-full animate-updown"></div>
                    </div>

                    <div class="absolute bottom-0 right-0 translate-x-6 translate-y-6">
                        <div class="w-28 md:w-36 h-28 md:h-36 bg-gradient-to-tl from-emerald-900 to-emerald-500 rounded-full animate-downup"></div>
                    </div>
                    <div class="flex justify-center items-center min-h-80 md:min-h-96 max-w-60 md:min-w-72 md:max-w-72 backdrop-blur-lg rounded-lg group-hover:backdrop-blur-none transition-all duration-300 ease-in-out ">
                        <div>
                            <div class="relative w-36 h-36 group-hover:-translate-y-8 duration-300">
                                <div class="absolute top-0 left-0 w-36 h-36 rounded-full bg-transparent border-4 border-teal-400"></div>
                                <div class="absolute top-3 left-3 w-32 h-32 bg-teal-400 rounded-full flex items-center justify-center bg-gradient-to-tl from-teal-400 to-yellow-200 text-white group-hover:from-gray-800 group-hover:to-teal-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-24 h-24">
                                        <path fill-rule="evenodd" d="M7.502 6h7.128A3.375 3.375 0 0 1 18 9.375v9.375a3 3 0 0 0 3-3V6.108c0-1.505-1.125-2.811-2.664-2.94a48.972 48.972 0 0 0-.673-.05A3 3 0 0 0 15 1.5h-1.5a3 3 0 0 0-2.663 1.618c-.225.015-.45.032-.673.05C8.662 3.295 7.554 4.542 7.502 6ZM13.5 3A1.5 1.5 0 0 0 12 4.5h4.5A1.5 1.5 0 0 0 15 3h-1.5Z" clip-rule="evenodd" />
                                    <path fill-rule="evenodd" d="M3 9.375C3 8.339 3.84 7.5 4.875 7.5h9.75c1.036 0 1.875.84 1.875 1.875v11.25c0 1.035-.84 1.875-1.875 1.875h-9.75A1.875 1.875 0 0 1 3 20.625V9.375ZM6 12a.75.75 0 0 1 .75-.75h.008a.75.75 0 0 1 .75.75v.008a.75.75 0 0 1-.75.75H6.75a.75.75 0 0 1-.75-.75V12Zm2.25 0a.75.75 0 0 1 .75-.75h3.75a.75.75 0 0 1 0 1.5H9a.75.75 0 0 1-.75-.75ZM6 15a.75.75 0 0 1 .75-.75h.008a.75.75 0 0 1 .75.75v.008a.75.75 0 0 1-.75.75H6.75a.75.75 0 0 1-.75-.75V15Zm2.25 0a.75.75 0 0 1 .75-.75h3.75a.75.75 0 0 1 0 1.5H9a.75.75 0 0 1-.75-.75ZM6 18a.75.75 0 0 1 .75-.75h.008a.75.75 0 0 1 .75.75v.008a.75.75 0 0 1-.75.75H6.75a.75.75 0 0 1-.75-.75V18Zm2.25 0a.75.75 0 0 1 .75-.75h3.75a.75.75 0 0 1 0 1.5H9a.75.75 0 0 1-.75-.75Z" clip-rule="evenodd" />
                                    </svg>
                                    <span class="absolute uppercase text-center group-hover:hidden mt-4 md:mt-16 text-gray-900 dark:text-gray-100 translate-y-24 duration-300 tracking-wide">
                                        Requested Documents
                                    </span> 
                                    <span class="absolute uppercase text-center opacity-0 group-hover:opacity-100 group-hover:text-gray-800 group-hover:text-xl group-hover:translate-y-24 duration-300">
                                        Requested Documents
                                    </span> 
                                </div>
                            </div>
                        </div>
                    </div>
            </x-card-link>
        </div>
    </div>
    
    @include('livewire.requester.includes.request-modal')
</div>