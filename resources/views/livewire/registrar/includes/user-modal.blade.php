@if($selectedUser)
    <x-modal name="view-user">
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

                <div class="flex items-center justify-end gap-4">
                    <x-primary-button>{{ __('Update') }}</x-primary-button>
                </div>
            </form>
        </div>
    </x-modal>
@endif

@if (session('status') === 'user-updated')
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
