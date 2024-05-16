<div>
    <div class="flex flex-col md:grid grid-cols-2 gap-4 md:gap-8 text-gray-900 dark:text-gray-100 ">
        <div class="relative w-full items-center justify-center p-4 px-8 shadow-md rounded-md bg-white dark:bg-gray-800 sm:rounded-lg">
            <h1 class="font-extrabold text-3xl tracking-widest text-transparent bg-gradient-to-r from-green-500 via-blue-500 to-red-500 bg-clip-text">USERS EXPORT</h1>
            <form wire:submit.prevent="exportUsers()" class="mt-4">
                <div class="w-full">
                    <div class="md:flex justify-between gap-10">
                        <div class="w-full">
                            <x-datetime-picker
                            label="Start Date"
                            without-tips="true"
                            wire:model.live="export.users.start"
                            :timezone="'Asia/Manila'"
                            without-time
                            :clearable="true"
                            />
                            <x-input-error :messages="$errors->get('export.users.start')" class="mt-2" />
                        </div>
                        <div class="mt-4 md:mt-0 w-full">
                            <x-datetime-picker
                            label="End Date"
                            without-tips="true"
                            :min="$export['users']['start']"
                            wire:model.live="export.users.end"
                            :timezone="'Asia/Manila'"
                            without-time
                            :clearable="true"
                            />
                            <x-input-error :messages="$errors->get('export.users.end')" class="mt-2" />
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-end gap-4 -mr-4 mt-4 md:mt-10">
                    <x-primary-button>
                        EXPORT
                    </x-primary-button>
                </div>
            </form>
        </div>

        <div class="relative w-full items-center justify-center p-4 px-8 shadow-md rounded-md bg-white dark:bg-gray-800 sm:rounded-lg">
            <h1 class="font-extrabold text-3xl tracking-widest text-transparent bg-gradient-to-r from-green-500 via-blue-500 to-red-500 bg-clip-text">REQUESTS EXPORT</h1>
            <form wire:submit.prevent="exportRequests()" class="mt-4">
                <div class="w-full">
                    <div class="md:flex justify-between gap-10">
                        <div class="w-full">
                            <x-datetime-picker
                            label="Start Date"
                            without-tips="true"
                            wire:model.live="export.requests.start"
                            :timezone="'Asia/Manila'"
                            without-time
                            :clearable="true"
                            />
                            <x-input-error :messages="$errors->get('export.requests.start')" class="mt-2" />
                        </div>
                        <div class="mt-4 md:mt-0 w-full">
                            <x-datetime-picker
                            label="End Date"
                            without-tips="true"
                            :min="$export['requests']['start']"
                            wire:model.live="export.requests.end"
                            :timezone="'Asia/Manila'"
                            without-time
                            :clearable="true"
                            />
                            <x-input-error :messages="$errors->get('export.requests.end')" class="mt-2" />
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-end gap-4 -mr-4 mt-4 md:mt-10">
                    <x-primary-button>
                        EXPORT
                    </x-primary-button>
                </div>
            </form>
        </div>

        <div class="relative w-full items-center justify-center p-4 px-8 shadow-md rounded-md bg-white dark:bg-gray-800 sm:rounded-lg">
            <h1 class="font-extrabold text-3xl tracking-widest text-transparent bg-gradient-to-r from-green-500 via-blue-500 to-red-500 bg-clip-text">DOCUMENTS EXPORT</h1>
            <form wire:submit.prevent="exportDocuments()" class="mt-4">
                <div class="w-full">
                    <div class="md:flex justify-between gap-10">
                        <div class="w-full">
                            <x-datetime-picker
                            label="Start Date"
                            without-tips="true"
                            wire:model.live="export.documents.start"
                            :timezone="'Asia/Manila'"
                            without-time
                            :clearable="true"
                            />
                            <x-input-error :messages="$errors->get('export.documents.start')" class="mt-2" />
                        </div>
                        <div class="mt-4 md:mt-0 w-full">
                            <x-datetime-picker
                            label="End Date"
                            without-tips="true"
                            :min="$export['documents']['start']"
                            wire:model.live="export.documents.end"
                            :timezone="'Asia/Manila'"
                            without-time
                            :clearable="true"
                            />
                            <x-input-error :messages="$errors->get('export.documents.end')" class="mt-2" />
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-end gap-4 -mr-4 mt-4 md:mt-10">
                    <x-primary-button>
                        EXPORT
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</div>
