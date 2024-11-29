<?php $__env->startSection('header-title', 'Occupancy Rate'); ?>

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
            <div class="container mx-auto mt-6">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                    <?php $__currentLoopData = $occupancy->sortByDesc('occupancy_rate'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="bg-white  rounded-lg shadow-lg p-4 transition-transform transform hover:scale-105 flex">
                            <div class="w-1/3 h-full overflow-hidden flex justify-center items-center">
                                <?php if($item['img']): ?>
                                    <img src="<?php echo e($item['img']); ?>" alt="<?php echo e($item['movie']); ?>"
                                        class="w-full h-auto object-contain rounded-lg">
                                <?php else: ?>
                                    <span>No Image Available</span>
                                <?php endif; ?>
                            </div>

                            <div class="w-2/3 pl-4 flex flex-col justify-between">
                                <div class="flex flex-col justify-between h-full">
                                    <div class="mb-2">
                                        <h3 class="text-lg font-bold text-gray-900 "><?php echo e($item['movie']); ?></h3>
                                    </div>
                                    <div class="relative">
                                        <div class="w-full h-4 bg-gray-300 rounded-full">
                                            <div class="h-4 bg-green-500 rounded-full text-white text-sm text-center leading-none"
                                                style="width: <?php echo e($item['occupancy_rate']); ?>%">
                                                <?php echo e(number_format($item['occupancy_rate'], 2)); ?>%
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/reports/occupancy_rate.blade.php ENDPATH**/ ?>