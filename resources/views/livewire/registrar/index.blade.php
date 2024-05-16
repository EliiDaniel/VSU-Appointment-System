<div>
    <div class="text-gray-900 dark:text-gray-100">
        <div class="hidden lg:grid grid-cols-5 gap-4 p-3">
            <div class="flex items-center justify-between p-4 px-8 shadow-md rounded-md h-28 bg-white dark:bg-gray-800 overflow-hidden sm:rounded-lg">
            <div class="text-xl">
                <p>{{ $usersCount }}</p>
                <p class="text-gray-400">Users</p>
            </div>
            <div>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                </svg>
            </div>
            </div>

            <div class="flex items-center justify-between p-4 px-8 shadow-md rounded-md h-28 bg-white dark:bg-gray-800 overflow-hidden sm:rounded-lg">
            <div class="text-xl">
                <p>{{ $requestsCount }}</p>
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
                <p>{{ $documentsCount }}</p>
                <p class="text-gray-400">Documents</p>
            </div>
            <div>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 17.25v3.375c0 .621-.504 1.125-1.125 1.125h-9.75a1.125 1.125 0 0 1-1.125-1.125V7.875c0-.621.504-1.125 1.125-1.125H6.75a9.06 9.06 0 0 1 1.5.124m7.5 10.376h3.375c.621 0 1.125-.504 1.125-1.125V11.25c0-4.46-3.243-8.161-7.5-8.876a9.06 9.06 0 0 0-1.5-.124H9.375c-.621 0-1.125.504-1.125 1.125v3.5m7.5 10.375H9.375a1.125 1.125 0 0 1-1.125-1.125v-9.25m12 6.625v-1.875a3.375 3.375 0 0 0-3.375-3.375h-1.5a1.125 1.125 0 0 1-1.125-1.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H9.75" />
                </svg>
            </div>
            </div>

            <div class="flex items-center justify-between p-4 px-8 shadow-md rounded-md h-28 bg-white dark:bg-gray-800 overflow-hidden sm:rounded-lg">
            <div class="text-xl">
                <p>{{ $blockedDatesCount }}</p>
                <p class="text-gray-400">Blocked Dates</p>
            </div>
            <div>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
                </svg>
            </div>
            </div>

            <div class="flex items-center justify-between p-4 px-8 shadow-md rounded-md h-28 bg-white dark:bg-gray-800 overflow-hidden sm:rounded-lg">
            <div class="text-xl">
                <p>{{ $notificationsCount }}</p>
                <p class="text-gray-400">Notifications</p>
            </div>
            <div>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12">
                <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0M3.124 7.5A8.969 8.969 0 0 1 5.292 3m13.416 0a8.969 8.969 0 0 1 2.168 4.5" />
                </svg>
            </div>
            </div>
        </div>
        <div class="p-6 lg:grid grid-cols-2 gap-8 space-y-8 lg:space-y-0">
            <div class="block md:grid grid-cols-3 gap-4 justify-center lg:flex">
                <div class="hidden md:flex flex-wrap lg:hidden grid-cols-5 gap-4 p-3">
                    <div class="flex items-center justify-between p-4 px-8 shadow-md rounded-md h-28 bg-white dark:bg-gray-800 overflow-hidden sm:rounded-lg w-full">
                        <div class="text-xl">
                            <p>{{ $usersCount }}</p>
                            <p class="text-gray-400">Users</p>
                        </div>
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                            </svg>
                        </div>
                        </div>

                        <div class="flex items-center justify-between p-4 px-8 shadow-md rounded-md h-28 bg-white dark:bg-gray-800 overflow-hidden sm:rounded-lg w-full">
                        <div class="text-xl">
                            <p>{{ $requestsCount }}</p>
                            <p class="text-gray-400">Requests</p>
                        </div>
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m20.25 7.5-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z" />
                            </svg>
                        </div>
                        </div>

                        <div class="flex items-center justify-between p-4 px-8 shadow-md rounded-md h-28 bg-white dark:bg-gray-800 overflow-hidden sm:rounded-lg w-full">
                        <div class="text-xl">
                            <p>{{ $documentsCount }}</p>
                            <p class="text-gray-400">Documents</p>
                        </div>
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 17.25v3.375c0 .621-.504 1.125-1.125 1.125h-9.75a1.125 1.125 0 0 1-1.125-1.125V7.875c0-.621.504-1.125 1.125-1.125H6.75a9.06 9.06 0 0 1 1.5.124m7.5 10.376h3.375c.621 0 1.125-.504 1.125-1.125V11.25c0-4.46-3.243-8.161-7.5-8.876a9.06 9.06 0 0 0-1.5-.124H9.375c-.621 0-1.125.504-1.125 1.125v3.5m7.5 10.375H9.375a1.125 1.125 0 0 1-1.125-1.125v-9.25m12 6.625v-1.875a3.375 3.375 0 0 0-3.375-3.375h-1.5a1.125 1.125 0 0 1-1.125-1.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H9.75" />
                            </svg>
                        </div>
                        </div>

                        <div class="flex items-center justify-between p-4 px-8 shadow-md rounded-md h-28 bg-white dark:bg-gray-800 overflow-hidden sm:rounded-lg w-full">
                        <div class="text-xl">
                            <p>{{ $blockedDatesCount }}</p>
                            <p class="text-gray-400">Blocked Dates</p>
                        </div>
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
                            </svg>
                        </div>
                        </div>

                        <div class="flex items-center justify-between p-4 px-8 shadow-md rounded-md h-28 bg-white dark:bg-gray-800 overflow-hidden sm:rounded-lg w-full">
                        <div class="text-xl">
                            <p>{{ $notificationsCount }}</p>
                            <p class="text-gray-400">Notifications</p>
                        </div>
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0M3.124 7.5A8.969 8.969 0 0 1 5.292 3m13.416 0a8.969 8.969 0 0 1 2.168 4.5" />
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="col-span-2 w-full grid grid-rows-2 gap-4">
                    <div class="min-w-96 mx-auto w-full min-h-full bg-white dark:bg-gray-800 overflow-hidden shadow-md sm:rounded-lg py-8">
                        <canvas id="users-chart" class="p-2" style="min-height: 250px; min-width: 250px;max-height: 300px; max-width: 100%"></canvas>
                    </div>
                    <div class="min-w-96 mx-auto w-full px-6 min-h-full bg-white dark:bg-gray-800 overflow-hidden shadow-md sm:rounded-lg py-8">
                        <canvas id="requests-statistics-chart" class="p-2" style="min-height: 250px; min-width: 250px;max-height: 500px; max-width: 100%"></canvas>
                    </div>
                </div>
            </div>
            <div class="min-w-96 min-h-56 max-w-[800px] max-h-[800px] flex justify-center bg-white dark:bg-gray-800 overflow-hidden shadow-md sm:rounded-lg py-8">
                <canvas id="requests-chart" class="p-2" style="min-height: 250px; min-width: 250px;max-height: 800px; max-width: 100%"></canvas>
            </div>
        </div>
    </div>
</div>

<script>
    var usersChart = document.getElementById('users-chart').getContext('2d');
    var requestsChart = document.getElementById('requests-chart').getContext('2d');

    document.addEventListener('DOMContentLoaded', function () {
        var adminsCount = @json($users['admin']);
        var registrarsCount = @json($users['registrar']);
        var cashiersCount = @json($users['cashier']);
        var requestersCount = @json($users['requester']);
        var confirmationsCount = @json($users['confirmation']);

        new Chart(usersChart, {
        type: 'doughnut',
        data: {
            labels: ['Admins', 'Registrars', 'Cashiers', 'Requesters', 'Confirmations'],
            datasets: [{
            label: 'Users',
            data: [adminsCount, registrarsCount, cashiersCount, requestersCount, confirmationsCount],
            backgroundColor: [
                'rgba(128, 128, 128, 0.75)',
                'rgba(0, 128, 0, 0.75)',         // Green border color
                'rgba(0, 128, 128, 0.75)',    // Teal
                'rgba(54, 162, 235, 0.75)', // Cashiers color
                'rgba(255, 0, 0, 0.75)', // Cashiers color
            ],
            borderColor: [
                'rgba(128, 128, 128, 1)',
                'rgba(0, 128, 0, 1)',         // Green border color
                'rgba(0, 128, 128, 1)',       // Teal border color
                'rgba(54, 162, 235, 1)', // Cashiers border color
                'rgba(255, 0, 0, 1)', // Cashiers color
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
                text: (adminsCount + registrarsCount + cashiersCount + requestersCount + confirmationsCount) + ' Total Users' 
            }
            }
        }
        });

        // for requests
        var pendingApprovalCount = @json($requests['pending_approval']);
        var inProgressCount = @json($requests['in_progress']);
        var paymentApprovalCount = @json($requests['payment_approval']);
        var awaitingPaymentCount = @json($requests['awaiting_payment']);
        var forCollectionCount = @json($requests['for_collection']);
        var completedCount = @json($requests['completed']);
        var canceledCount = @json($requests['canceled']);

        new Chart(requestsChart, {
        type: 'polarArea',
        data: {
            labels: ['Pending Approval', 'In Progress', 'Payment Approval', 'Awaiting Payment', 'Ready for Collection', 'Completed', 'Canceled'],
            datasets: [{
            label: 'Users',
            data: [pendingApprovalCount, inProgressCount, paymentApprovalCount, awaitingPaymentCount, forCollectionCount, completedCount, canceledCount],
            backgroundColor: [
                'rgba(128, 128, 128, 0.75)',
                'rgba(0, 128, 128, 0.75)',    // Teal
                'rgba(238, 130, 238, 0.75)', // Violet
                'rgba(0, 0, 255, 0.75)',      // Blue
                'rgba(255, 165, 0, 0.75)',    // Orange
                'rgba(0, 128, 0, 0.75)',      // Green
                'rgba(255, 0, 0, 0.75)',      // Red
            ],
            borderColor: [
                'rgba(128, 128, 128, 1)',
                'rgba(0, 128, 128, 1)',       // Teal border color
                'rgba(238, 130, 238, 1)',     // Violet border color
                'rgba(0, 0, 255, 1)',         // Blue border color
                'rgba(255, 165, 0, 1)',       // Orange border color
                'rgba(0, 128, 0, 1)',         // Green border color
                'rgba(255, 0, 0, 1)',         // Red border color
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
                text: (pendingApprovalCount + inProgressCount + paymentApprovalCount + awaitingPaymentCount + forCollectionCount + completedCount + canceledCount) + ' Total Requests' 
            }
            }
        }
        });

        var requestStatisticsChart = document.getElementById('requests-statistics-chart').getContext('2d');
        
        var requestsPerDay = @json($requestsPerDay);
        var labels = @json($dayLabels);
        var requestsPerDayData = labels.map(label => requestsPerDay[label] || 0);

        new Chart(requestStatisticsChart, {
        type: 'line',
        data: {
      labels: labels,
      datasets: [{
        label: 'Number of Requests',
        data: requestsPerDayData,
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
    });
</script>