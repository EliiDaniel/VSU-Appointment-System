<div>
    <div class="text-gray-900 dark:text-gray-100">
        <div class="flex flex-wrap justify-center md:grid grid-cols-3 gap-4 p-3">
            <div class="flex items-center justify-between p-4 px-8 shadow-md rounded-md h-28 bg-white dark:bg-gray-800 overflow-hidden sm:rounded-lg w-full">
            <div class="text-xl">
                <p>{{ $approvedCount }}</p>
                <p class="text-gray-400">Requests For Approval</p>
            </div>
            <div>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12">
                <path stroke-linecap="round" stroke-linejoin="round" d="m20.25 7.5-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z" />
                </svg>
            </div>
            </div>

            <div class="flex items-center justify-between p-4 px-8 shadow-md rounded-md h-28 bg-white dark:bg-gray-800 overflow-hidden sm:rounded-lg w-full">
            <div class="text-xl">
                    <p>{{ $forApprovalCount }}</p>
                <p class="text-gray-400">Notifications</p>
            </div>
            <div>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12">
                <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0M3.124 7.5A8.969 8.969 0 0 1 5.292 3m13.416 0a8.969 8.969 0 0 1 2.168 4.5" />
                </svg>
            </div>
            </div>

            <div class="flex items-center justify-between p-4 px-8 shadow-md rounded-md h-28 bg-white dark:bg-gray-800 overflow-hidden sm:rounded-lg w-full">
            <div class="text-xl">
                <p>{{ $notificationsCount }}</p>
                <p class="text-gray-400">Approved Payments</p>
            </div>
            <div>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12">
                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 0 0-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 0 1-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 0 0 3 15h-.75M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm3 0h.008v.008H18V10.5Zm-12 0h.008v.008H6V10.5Z" />
                </svg>
            </div>
            </div>
        </div>

        <div class="block lg:grid grid-cols-2 gap-4 lg:gap-8 py-6">
            <div class="flex flex-col lg:grid grid-rows-2 gap-4">
                <div wire:ignore class="mx-auto w-full min-w-96 min-h-full bg-white dark:bg-gray-800 overflow-hidden shadow-md rounded-lg py-8">
                    <canvas id="earnings-chart" class="p-2" style="min-height: 250px; min-width: 250px;max-height: 300px; max-width: 100%"></canvas>
                </div>
                <div class="relative flex flex-col w-full items-center justify-center p-4 px-8 shadow-md rounded-md bg-white dark:bg-gray-800 sm:rounded-lg">
                    <h1 class="font-extrabold text-3xl tracking-widest text-transparent bg-gradient-to-r from-green-500 via-blue-500 to-red-500 bg-clip-text">TRANSACTIONS EXPORT</h1>
                    <form wire:submit.prevent="exportTransactions()" class="mt-4">
                        <div class="w-full">
                            <div class="md:flex justify-between gap-10">
                                <div class="w-full">
                                    <x-datetime-picker
                                    label="Start Date"
                                    without-tips="true"
                                    wire:model.live="export.transactions.start"
                                    :timezone="'Asia/Manila'"
                                    without-time
                                    :clearable="true"
                                    />
                                    <x-input-error :messages="$errors->get('export.transactions.start')" class="mt-2" />
                                </div>
                                <div class="mt-4 md:mt-0 w-full">
                                    <x-datetime-picker
                                    label="End Date"
                                    without-tips="true"
                                    :min="$export['transactions']['start']"
                                    wire:model.live="export.transactions.end"
                                    :timezone="'Asia/Manila'"
                                    without-time
                                    :clearable="true"
                                    />
                                    <x-input-error :messages="$errors->get('export.transactions.end')" class="mt-2" />
                                </div>
                            </div>
                        </div>
        
                        <div class="flex items-center justify-center gap-4 mt-4 md:mt-10">
                            <x-primary-button>
                                EXPORT
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>

            <div wire:ignore class="mt-4 lg:mt-0 w-full min-w-96 min-h-56 max-w-full max-h-[800px] flex justify-center bg-white dark:bg-gray-800 overflow-hidden shadow-md rounded-lg py-8">
                <canvas id="request-documents-chart" class="p-2" style="min-height: 250px; min-width: 250px;max-height: 800px; max-width: 100%"></canvas>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var earningsChart = document.getElementById('earnings-chart').getContext('2d');
        
        var earnings = @json($earnings);
        var monthLabels = @json($monthLabels);
        var earningsData = monthLabels.map(label => earnings[label] || 0);

        new Chart(earningsChart, {
        type: 'line',
        data: {
      labels: monthLabels,
      datasets: [{
        label: 'Number of Requests',
        data: earningsData,
        fill: true,
        borderColor: 'rgb(75, 192, 192)',
        backgroundColor: 'rgba(54, 162, 235, 0.3)',
        lineTension: 0.1
      }]
    },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
            title: {
                display: true,
                text: 'Requests Statistics'
            }
            }
        }
        });
        
        var requestDocumentsChart = document.getElementById('request-documents-chart').getContext('2d');
        var documentLabels = @json($documentLabels);
        var documents = @json($documents);
        var documentsData = documentLabels.map(label => documents[label] || 0);
        var totalQuantity = 0;

        documentLabels.forEach(label => {
            if (documents[label]) {
                totalQuantity += documents[label];
            }
        });

        new Chart(requestDocumentsChart, {
        type: 'polarArea',
        data: {
            labels: documentLabels,
            datasets: [{
            label: 'Users',
            data: documentsData,
            backgroundColor: [
                'rgba(128, 128, 128, 0.75)',
                'rgba(0, 128, 128, 0.75)',    // Teal
                'rgba(238, 130, 238, 0.75)', // Violet
                'rgba(0, 0, 255, 0.75)',      // Blue
                'rgba(255, 165, 0, 0.75)',    // Orange
                'rgba(0, 128, 0, 0.75)',      // Green
                'rgba(255, 0, 0, 0.75)',      // Red
                'rgba(255, 192, 203, 0.75)',  // Pink
                'rgba(255, 255, 0, 0.75)',    // Yellow
                'rgba(128, 0, 128, 0.75)',    // Purple
                'rgba(210, 105, 30, 0.75)',   // Chocolate
                'rgba(255, 140, 0, 0.75)',    // Dark Orange
                'rgba(0, 255, 255, 0.75)',    // Cyan
                'rgba(128, 0, 0, 0.75)',      // Maroon
                'rgba(128, 0, 0, 0.75)',      // Olive
                'rgba(255, 192, 203, 0.75)',  // Peach
                'rgba(173, 255, 47, 0.75)',   // Green Yellow
                'rgba(219, 112, 147, 0.75)',  // Pale Violet Red
                'rgba(144, 238, 144, 0.75)',  // Light Green
                'rgba(255, 215, 0, 0.75)',    // Gold
            ],
            borderColor: [
                'rgba(128, 128, 128, 1)',
                'rgba(0, 128, 128, 1)',    // Teal
                'rgba(238, 130, 238, 1)', // Violet
                'rgba(0, 0, 255, 1)',      // Blue
                'rgba(255, 165, 0, 1)',    // Orange
                'rgba(0, 128, 0, 1)',      // Green
                'rgba(255, 0, 0, 1)',      // Red
                'rgba(255, 192, 203, 1)',  // Pink
                'rgba(255, 255, 0, 1)',    // Yellow
                'rgba(128, 0, 128, 1)',    // Purple
                'rgba(210, 105, 30, 1)',   // Chocolate
                'rgba(255, 140, 0, 1)',    // Dark Orange
                'rgba(0, 255, 255, 1)',    // Cyan
                'rgba(128, 0, 0, 1)',      // Maroon
                'rgba(128, 0, 0, 1)',      // Olive
                'rgba(255, 192, 203, 1)',  // Peach
                'rgba(173, 255, 47, 1)',   // Green Yellow
                'rgba(219, 112, 147, 1)',  // Pale Violet Red
                'rgba(144, 238, 144, 1)',  // Light Green
                'rgba(255, 215, 0, 1)',    // Gold
            ],
            borderWidth: 3,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
            title: {
                display: true,
                text: (totalQuantity) + ' Total Requests' 
            }
            }
        }
        });
    });
</script>