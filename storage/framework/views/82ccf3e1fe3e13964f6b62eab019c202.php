<?php $__env->startSection('header-title', 'Sales by Month'); ?>

<?php $__env->startSection('main'); ?>

<header class="bg-white  shadow">
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <h2 class="font-semibold text-xl text-gray-800  leading-tight">
            <?php echo $__env->yieldContent('header-title'); ?>
        </h2>
    </div>
</header>
<div class="flex justify-center">
    <div class="my-4 p-6 bg-white overflow-hidden shadow-sm sm:rounded-lg text-gray-900 w-full max-w-[90%] mx-auto">

        <canvas id="salesChart"></canvas>
    </div>
</div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        var monthNames = ["January", "February", "March", "April", "May", "June",
                  "July", "August", "September", "October", "November", "December"];

        var months = <?php echo json_encode($months); ?>;

        var monthLabels = months.map(function(month) {
            return monthNames[month - 1];
        });

        var ctx = document.getElementById('salesChart').getContext('2d');
        var salesChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: monthLabels,
                datasets: [{
                    label: 'Total Sales',
                    data: <?php echo json_encode($totals); ?>,
                    backgroundColor: 'rgba(255, 206, 86, 0.2)',
                    borderColor: 'rgba(255, 206, 86, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                var label = context.dataset.label || '';
                                if (label) {
                                    label += ': ';
                                }
                                if (context.parsed.y !== null) {
                                    label += context.parsed.y.toFixed(2);
                                }
                                return label;
                            }
                        }
                    }
                },
                responsive: true,
                interaction: {
                    mode: 'index',
                    intersect: false,
                },
            }
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/reports/sales_by_month.blade.php ENDPATH**/ ?>