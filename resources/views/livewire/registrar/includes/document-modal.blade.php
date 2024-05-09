<x-modal name="document-modal" prompt="true" disabledClose="false" maxWidth="xl">
    @if($selectedDocument)
        <div class="p-6" x-show="$wire.title === 'view-document'">
            <form method="post" action="{{ route('update.document', ['id' => $selectedDocument->id]) }}" class="space-y-6" onsubmit="return confirm('Are you sure you want to update {{ $selectedDocument->name }}?');">
                @csrf
                @method('patch')

                <div>
                    <x-input-label for="name" :value="__('Name')" />
                    <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" value="{{ old('name', $selectedDocument->name) }}" required autofocus autocomplete="name" />
                </div>

                <div>
                    <x-input-label for="price" :value="__('Price')" />
                    <x-text-input id="price" name="price" type="number" class="mt-1 block w-full" value="{{ old('price', $selectedDocument->price) }}" required autocomplete="price" />
                </div>
                
                <div class="text-gray-700 dark:text-gray-300 whitespace-nowrap">
                    <x-input-label for="process" :value="__('Select process in order')" />
                    <div class="flex flex-wrap pt-1 gap-2">
                        @foreach($processes as $process)
                        <div x-data="{ isChecked: false }" x-init="$watch('show', () => { isChecked = procs.includes('{{ $process->name }}') })" class="mr-2 mb-2">
                            <label>
                                <input x-model="isChecked" type="checkbox" name="processes[]" value="{{ $process->id }}" class="hidden">
                                <button type="button" @click="isChecked = !isChecked; isChecked ? procs.push('{{ $process->name }}') : procs = procs.filter(item => item !== '{{ $process->name }}');" x-bind:class="{ 'outline-none ring-2 ring-emerald-500 ring-offset-2 dark:ring-offset-gray-800': isChecked }" class="inline-flex items-center px-4 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-500 rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 disabled:opacity-25 transition ease-in-out duration-150">
                                    {{ ucfirst($process->name)  }}
                                </button>
                            </label>
                        </div>
                        @endforeach
                    </div>

                    <x-input-label :value="__('Order')" class="mt-4"/>
                    <div class="flex flex-wrap ml-4">
                        <template x-for="(process, index) in procs" :key="index">
                            <div class="flex items-center pt-1">
                                <div class="p-2 border border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm"><div x-text="process" class="animate-jump animate-once animate-ease-in-out"></div></div>
                                <span x-show="index < procs.length - 1" class="px-1 animate-jump animate-once animate-ease-in-out">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m12.75 15 3-3m0 0-3-3m3 3h-7.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                    </svg>
                                </span>
                            </div>
                        </template>
                    </div>
                </div>

                <div class="flex items-center justify-end gap-4">
                    <x-primary-button>{{ __('Update') }}</x-primary-button>
                </div>
            </form>
        </div>
    @endif

    <div class="p-6" x-show="$wire.title === 'create-document'">
        <form method="post" action="{{ route('create.document') }}">
            @csrf
            @method('patch')

            <div class="mt-4">
                <x-input-label for="name" :value="__('Name')" />
                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" required autofocus autocomplete="name" />
            </div>

            <div class="mt-4">
                <x-input-label for="price" :value="__('Price')" />
                <x-text-input id="price" name="price" type="number" value="0" class="mt-1 block w-full" required autocomplete="price" />
            </div>
        
            <div class="text-gray-700 dark:text-gray-300 mt-4">
                <x-input-label for="process" :value="__('Select process in order')" />
                <div class="flex flex-wrap pt-1 gap-2">
                    @foreach($processes as $process)
                        <div x-data="{ isChecked: false }" x-init="$watch('show', () => { isChecked = procs.includes('{{ $process->name }}') })" class="mr-2 mb-2">
                            <label>
                                <input x-model="isChecked" type="checkbox" name="processes[]" value="{{ $process->id }}" class="hidden">
                                <button type="button" @click="isChecked = !isChecked; isChecked ? procs.push('{{ $process->name }}') : procs = procs.filter(item => item !== '{{ $process->name }}');" :class="{ 'outline-none ring-2 ring-emerald-500 ring-offset-2 dark:ring-offset-gray-800': isChecked }" class="inline-flex items-center px-4 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-500 rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 disabled:opacity-25 transition ease-in-out duration-150">
                                    {{ ucfirst($process->name)  }}
                                </button>
                            </label>
                        </div>
                    @endforeach
                </div>

                <x-input-label :value="__('Order')" class="mt-4"/>
                <div class="flex flex-wrap ml-4">
                    <template x-for="(process, index) in procs" :key="index">
                        <div class="flex items-center pt-1">
                            <div class="p-2 border border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm"><div x-text="process" class="animate-jump animate-once animate-ease-in-out"></div></div>
                            <span x-show="index < procs.length - 1" class="px-1 animate-jump animate-once animate-ease-in-out">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m12.75 15 3-3m0 0-3-3m3 3h-7.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                </svg>
                            </span>
                        </div>
                    </template>
                </div>
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-primary-button class="ms-4">
                    {{ __('Create') }}
                </x-primary-button>
            </div>
        </form>
    </div>

    <div class="p-6" x-show="$wire.title === 'create-process'">
        <form method="post" action="{{ route('create.process') }}">
            @csrf
            @method('patch')

            <div class="mt-4">
                <x-input-label for="name" :value="__('Name')" />
                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" required autofocus autocomplete="name" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-primary-button class="ms-4">
                    {{ __('Create') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-modal>

@if (session('status') === 'document-updated')
    <div 
        x-data="{ show: true }"
        x-show="show"
        x-transition
        x-init="setTimeout(() => show = false, 4000)"
        class="fixed top-4 right-4 bg-green-300 text-gray-700 dark:bg-green-700 dark:text-gray-300 pl-3 pr-20 py-3 rounded-lg z-50 opacity-75 hover:opacity-100 ease-in-out duration-200"
        role="alert"
    >
        <span class="block sm:inline tracking-widest font-extrabold text-sm">{{ __('Successfully updated!') }}</span>
        <span class="absolute top-0 bottom-0 right-0 pt-[9.80px] pr-3 cursor-pointer" @click="show = false">
            <svg class="fill-current h-6 w-5 text-gray-200" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 1.697l-2.651-2.65-2.65 2.65a1.2 1.2 0 1 1-1.697-1.697l2.65-2.651-2.65-2.65a1.2 1.2 0 1 1 1.697-1.697l2.651 2.65 2.65-2.65a1.2 1.2 0 1 1 1.697 1.697l-2.65 2.651 2.65 2.65z"/></svg>
        </span>
    </div>
@endif