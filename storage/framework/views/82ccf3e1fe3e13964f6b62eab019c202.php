<?php $__env->startSection('main'); ?>
    <div>
        <canvas id="salesChart"></canvas>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Defining month names
        var monthNames = ["Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho",
                          "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro"];

        // Assuming $months contains month numbers (1 to 12)
        var months = <?php echo json_encode($months); ?>;

        // Mapping month numbers to month names
        var monthLabels = months.map(function(month) {
            return monthNames[month - 1]; // Adjusting index to start from 0
        });

        var ctx = document.getElementById('salesChart').getContext('2d');
        var salesChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: monthLabels, // Using month names instead of numbers
                datasets: [{
                    label: 'Total Sales',
                    data: <?php echo json_encode($totals); ?>,
                    backgroundColor: 'rgba(255, 206, 86, 0.2)', // Yellow color with alpha transparency
                    borderColor: 'rgba(255, 206, 86, 1)', // Yellow color
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