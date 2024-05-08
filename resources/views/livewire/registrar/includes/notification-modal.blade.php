<x-modal name="notification-modal" prompt="false" disabledClose="false" maxWidth="xl">
    @if(isset($selectedNotification))
        @if (json_decode($selectedNotification->content)[0] === 'request')
        <div class="p-6 text-gray-900 dark:text-gray-100">
            <div class="text-lg flex items-center justify-between">
                <span class="text-gray-600 dark:text-gray-400">Type: {{ ucfirst(json_decode($selectedNotification->content)[0]) }}</span>
                <span class="text-gray-600 dark:text-gray-400 whitespace-nowrap">Request #{{ json_decode($selectedNotification->content)[1] }}</span>
            </div>
            <div class="mt-2 space-y-2">
                <div>
                    <div class="flex text-xl items-center">
                        <span class="mr-1">Title: Request Status Update</span>
                    </div>
                </div>
                <div class="space-y-4">
                    <div class="flex text-xl items-center">
                        <span class="mr-1">Content:</span>
                    </div>
                    <div class="mx-2 p-6 pt-2 pl-2 bg-gray-100 dark:bg-gray-900 rounded-md shadow-sm">
                        On {{ $selectedNotification->created_at }} Request #{{ json_decode($selectedNotification->content)[1] }} status has been updated to {{ json_decode($selectedNotification->content)[2] }}
                    </div>
                </div>
            </div>
        </div>
        @elseif (json_decode($selectedNotification->content)[0] === 'transaction')
        <div class="p-6 text-gray-900 dark:text-gray-100">
            <div class="text-lg flex items-center justify-between">
                <span class="text-gray-600 dark:text-gray-400">Type: {{ ucfirst(json_decode($selectedNotification->content)[0]) }}</span>
            </div>
            <div class="mt-2 space-y-2">
                <div>
                    <div class="flex text-xl items-center">
                        <span class="mr-1">Title: Transaction Complete</span>
                    </div>
                </div>
                <div class="space-y-4">
                    <div class="flex text-xl items-center">
                        <span class="mr-1">Content:</span>
                    </div>
                    <div class="mx-2 p-6 pt-2 pl-2 bg-gray-100 dark:bg-gray-900 rounded-md shadow-sm">
                        Transaction made on {{ $selectedNotification->created_at }}, Details: Checkout ID: {{ json_decode($selectedNotification->content)[1] }}, Reference No: {{ json_decode($selectedNotification->content)[2] }}
                    </div>
                </div>
            </div>
        </div>
        @endif
    @endif
    <div class="flex items-center justify-end">
        <x-primary-button class="ms-4 mb-4 mr-4" @click="$dispatch('close')">
            {{ __('Done') }}
        </x-primary-button>
    </div>
</x-modal>