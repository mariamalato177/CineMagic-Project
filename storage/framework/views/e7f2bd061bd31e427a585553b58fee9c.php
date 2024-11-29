<?php $__env->startSection('header-title', 'My Purchases'); ?>

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
            <div class="container mx-auto px-4 pt-16">

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 py-4">
                    <?php $__currentLoopData = $purchases; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $purchase): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                            $date = \Carbon\Carbon::parse($purchase->date)->format('d-m-Y');
                        ?>
                        <div
                            class="px-6 py-4 bg-white  rounded-lg shadow-lg overflow-hidden transition-transform transform hover:scale-105 flex flex-col justify-between relative">
                            <h3 class="text-xl font-bold text-gray-900  truncate"> Date <?php echo e($date); ?></h3>
                            <p><strong>Id:</strong> <?php echo e($purchase->id); ?></p>
                            <p> <strong> Price: </strong> <?php echo e($purchase->total_price); ?> €</p>
                            <?php if($purchase->receipt_pdf_filename): ?>
                                <div class="flex items-center space-x-4">
                                    <a href="<?php echo e(url('/pdf_purchases/' . $purchase->receipt_pdf_filename)); ?>" target="_blank"
                                        class="text-lg font-bold text-blue-500 hover:text-blue-700">
                                        <strong>View PDF</strong>
                                    </a>
                                </div>
                            <?php else: ?>
                                <span class="text-lg font-bold text-red-300">Receipt not available</span>
                            <?php endif; ?>
                            <div class="flex justify-end mt-4 space-x-2">
                                <a class="text-lg font-bold text-green-500 hover:text-green-700"
                                    href="<?php echo e(route('tickets.showTickets', ['purchase' => $purchase])); ?>">
                                    <strong>View Tickets</strong>
                                </a>
                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>

            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/pdf/myPdf.blade.php ENDPATH**/ ?>