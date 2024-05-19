@if($selectedUser)
    <x-modal name="view-user" prompt="true" disabledClose="false" maxWidth="xl">
        <div class="p-6">
            <form wire:submit.prevent="update" class="space-y-6">
                @csrf
                @method('patch')

                <div>
                    <x-input-label for="name" :value="__('Name')" />
                    <x-text-input id="name" name="name" wire:model="user_state.name" type="text" class="mt-1 block w-full" required autofocus autocomplete="name" />
                </div>

                <div>
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" wire:model="user_state.email"  required autocomplete="email" />
                </div>
                
                <div>
                    <x-input-label for="role" :value="__('Role')" />
                    <div class="flex flex-wrap justify-evenly gap-x-2">
                        @foreach(['admin', 'registrar', 'cashier', 'requester', 'confirmation'] as $role)
                                <label for="{{$role}}" class="cursor-pointer my-1 min-w-28 max-w-32 sm:max-w-28 flex-1 items-center border border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm ring-green-600 transition ease-in-out duration-150 has-[:checked]:ring-[3px] has-[:checked]:animate-jump has-[:checked]:animate-once has-[:checked]:animate-duration-300 block w-full text-center py-3">
                                    {{ucfirst($role)}}
                                    <input type="radio" id="{{$role}}" wire:model="user_state.role" value="{{ $role }}" class="hidden"/>
                                </label>
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