<div>
    <div class="text-gray-900 dark:text-gray-100">
        <div class="flex flex-wrap justify-center lg:grid grid-cols-3 gap-4 p-3">
            <div class="flex items-center justify-between p-4 px-8 shadow-md rounded-md h-28 bg-white dark:bg-gray-800 overflow-hidden sm:rounded-lg">
            <div class="text-xl">
                <p>1</p>
                <p class="text-gray-400">Requests</p>
            </div>
            <div>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12">
                <path stroke-linecap="round" stroke-linejoin="round" d="m20.25 7.5-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z" />
                </svg>
            </div>
            </div>

            <div class="flex items-center justify-between p-4 px-8 shadow-md rounded-md h-28 bg-white dark:bg-gray-800 overflow-hidden sm:rounded-lg">
            <div class="text-xl">
                    <p>1</p>
                <p class="text-gray-400">Notifications</p>
            </div>
            <div>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12">
                <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0M3.124 7.5A8.969 8.969 0 0 1 5.292 3m13.416 0a8.969 8.969 0 0 1 2.168 4.5" />
                </svg>
            </div>
            </div>

            <div class="flex items-center justify-between p-4 px-8 shadow-md rounded-md h-28 bg-white dark:bg-gray-800 overflow-hidden sm:rounded-lg">
            <div class="text-xl">
                <p>1</p>
                <p class="text-gray-400">Approved Payments</p>
            </div>
            <div>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12">
                <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0M3.124 7.5A8.969 8.969 0 0 1 5.292 3m13.416 0a8.969 8.969 0 0 1 2.168 4.5" />
                </svg>
            </div>
            </div>
        </div>

        <div class="block lg:grid grid-cols-2 gap-8 py-6">
            <div class="lg:grid grid-rows-2 gap-4">
                <div class="mx-auto w-full min-w-96 min-h-full bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg py-8">
                    <canvas id="users-chart" class="p-2" style="min-height: 250px; min-width: 250px;max-height: 300px; max-width: 100%"></canvas>
                </div>
            </div>

            <div class="mt-8 lg:mt-0 w-full min-w-96 min-h-56 max-w-full max-h-[800px] flex justify-center bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg py-8">
                <canvas id="requests-chart" class="p-2" style="min-height: 250px; min-width: 250px;max-height: 800px; max-width: 100%"></canvas>
            </div>
        </div>
    </div>
</div>