
    <div class="container mx-auto py-8">
        <h1 class="text-2xl font-bold mb-6">Monthly Sales Report</h1>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white dark:bg-gray-800 rounded-lg shadow overflow-hidden">
                <thead class="bg-gray-200 dark:bg-gray-700">
                    <tr>
                        <th class="px-4 py-2 text-left text-gray-600 dark:text-gray-300 font-medium">Year</th>
                        <th class="px-4 py-2 text-left text-gray-600 dark:text-gray-300 font-medium">Month</th>
                        <th class="px-4 py-2 text-left text-gray-600 dark:text-gray-300 font-medium">Total Sales</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $item)
                        <tr class="border-b border-gray-200 dark:border-gray-700">
                            <td class="px-4 py-2 text-gray-700 dark:text-gray-300">{{ $item->year }}</td>
                            <td class="px-4 py-2 text-gray-700 dark:text-gray-300">{{ $item->month }}</td>
                            <td class="px-4 py-2 text-gray-700 dark:text-gray-300">{{ number_format($item->total, 2) }} €</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
