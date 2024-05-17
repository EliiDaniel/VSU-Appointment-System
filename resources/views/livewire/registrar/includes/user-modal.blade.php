@if($selectedUser)
    <x-modal name="view-user" prompt="true" disabledClose="false" maxWidth="xl">
        <div class="p-6">
            <form method="post" action="{{ route('update.user', ['id' => $selectedUser->id]) }}" class="space-y-6" onsubmit="return confirm('Are you sure you want to update {{ $selectedUser->name }}?');">
                @csrf
                @method('patch')

                <div>
                    <x-input-label for="name" :value="__('Name')" />
                    <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" value="{{ old('name', $selectedUser->name) }}" required autofocus autocomplete="name" />
                </div>

                <div>
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" value="{{ old('email', $selectedUser->email) }}" required autocomplete="email" />
                </div>
                
                <div>
                    <x-input-label for="role" :value="__('Role')" />
                    <div class="flex flex-wrap justify-evenly gap-x-2">
                        @foreach(['admin', 'registrar', 'cashier', 'requester', 'confirmation'] as $role)
                            <div :class="{ 'my-1 min-w-28 max-w-32 sm:max-w-28 flex-1 items-center border border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm ring-green-600 transition ease-in-out duration-150': true, 'ring-[3px] animate-jump animate-once animate-duration-300': selectedRole === '{{ $role }}' }" x-on:click="selectedRole = '{{ $role }}'">
                                <label class="block w-full text-center py-3">
                                    <input type="radio" name="role" value="{{ $role }}" class="hidden" x-model="selectedRole">
                                    {{ ucfirst($role) }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>
                
                <div class="flex items-center justify-between">
                    <x-secondary-button class=" border-none" wire:click="downloadCredentials()">
                        <div class="flex gap-2 items-center text-green-600">
                            Credentials 
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m20.25 7.5-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5m8.25 3v6.75m0 0-3-3m3 3 3-3M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z" />
                            </svg>
                        </div>
                    </x-secondary-button>
                    <div class="flex items-center justify-end gap-4">
                        <x-primary-button>{{ __('Update') }}</x-primary-button>
                    </div>
                </div>
            </form>
        </div>
    </x-modal>
@endif

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
