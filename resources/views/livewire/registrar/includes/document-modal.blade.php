<x-modal name="document-modal" prompt="true" disabledClose="false" maxWidth="xl">
    @if($selectedDocument)
        <div class="p-6" x-show="$wire.title === 'view-document'">
            <form x-data="{ openConfirmDialog() {
                window.$wireui.confirmDialog({
                    title: 'Are you sure?',
                    description: 'Do you really want to update document?',
                    icon: 'warning',
                    accept: {
                        label: 'Yes, update it',
                        execute: () => {
                            this.$refs.form.submit();
                        }
                    },
                    reject: {
                        label: 'No, cancel'
                    }
                });
            }}" @submit.prevent="openConfirmDialog" x-ref="form" method="post" action="{{ route('update.document', ['id' => $selectedDocument->id]) }}" class="space-y-6">
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

                <div>
                    <x-input-label for="type" :value="__('Type')" />
                    <select id="type" name="type" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                            @foreach($document_types as $type)
                                <option value="{{ $type->id }}" {{ $selectedDocument->document_type_id == $type->id ? 'selected' : '' }}>{{ ucfirst($type->name) }}</option>
                            @endforeach
                    </select>
                </div>

                <div>
                    <div class="whitespace-nowrap">
                        <label class="text-gray-900 dark:text-gray-200">
                            <input id="soft_copy_available" name="soft_copy_available" checked="{{$selectedDocument->soft_copy_available}}" type="checkbox" class="h-4 w-4 text-emerald-600 dark:text-emerald-400 border-gray-300 dark:border-gray-700 focus:ring-emerald-500 dark:focus:ring-emerald-600 bg-white dark:bg-gray-900 rounded"> Available in Soft Copy
                        </label>
                    </div>
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

            <div class="mt-4">
                <x-input-label for="type" :value="__('Type')" />
                <select id="type" name="type" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                        @foreach($document_types as $type)
                            <option value="{{ $type->id }}">{{ ucfirst($type->name) }}</option>
                        @endforeach
                </select>
            </div>

            <div class="mt-4">
                <div class="whitespace-nowrap">
                    <label class="text-gray-900 dark:text-gray-200">
                        <input id="soft_copy_available" name="soft_copy_available" type="checkbox" class="h-4 w-4 text-emerald-600 dark:text-emerald-400 border-gray-300 dark:border-gray-700 focus:ring-emerald-500 dark:focus:ring-emerald-600 bg-white dark:bg-gray-900 rounded"> Available in Soft Copy
                    </label>
                </div>
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

    <div class="p-6" x-show="$wire.title === 'create-document-type'">
        <form method="post" action="{{ route('create.type') }}">
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

@if (session('status'))
    <div wire:ignore x-init="() => $wire.sessionNotif('{{ session('status') }}')"></div>
@endif