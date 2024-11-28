<?php $__env->startSection('header-title', 'Purchases'); ?>

<?php $__env->startSection('main'); ?>

<header class="bg-white  shadow">
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <h2 class="font-semibold text-xl text-gray-800  leading-tight">
            <?php echo $__env->yieldContent('header-title'); ?>
        </h2>
    </div>
</header>
<div class="flex justify-center">
    <div class="my-4 p-6 bg-white  overflow-hidden shadow-sm sm:rounded-lg text-gray-900  w-full max-w-6xl">
        <div class="bg-white rounded-lg p-4 mb-8">
            <form action="<?php echo e(route('purchases.index')); ?>" method="GET" class="flex flex-wrap items-center space-y-4 md:space-y-0 md:space-x-4">
                <div class="flex flex-col space-y-2">
                    <label for="search" class="text-black">Search by Purchase ID:</label>
                    <input type="text" id="search" name="search" value="<?php echo e($searchQuery ?? ''); ?>" placeholder="Enter Purchase ID" class="bg-white text-black p-2 rounded">
                </div>

                <div class="flex flex-col space-y-2">
                    <label for="startDate" class="text-black ">Start Date:</label>
                    <input type="date" id="startDate" name="startDate" value="<?php echo e($startDate ?? ''); ?>" class="bg-white text-black p-2 rounded">
                </div>

                <div class="flex flex-col space-y-2">
                    <label for="endDate" class="text-black ">End Date:</label>
                    <input type="date" id="endDate" name="endDate" value="<?php echo e($endDate ?? ''); ?>" class="bg-white text-black p-2 rounded">
                </div>

                <div class="flex flex-col space-y-2 w-60">
                    <label for="sortDate" class="text-black ">Sort by:</label>
                    <select id="sortDate" name="sortDate" class="bg-white text-black p-2 rounded w-full full">
                        <option value="desc" <?php echo e($sortDate == 'desc' ? 'selected' : ''); ?>>Newest First</option>
                        <option value="asc" <?php echo e($sortDate == 'asc' ? 'selected' : ''); ?>>Oldest First</option>
                    </select>
                </div>

                <div class="flex">
                    <button type="submit" class="bg-coral text-white px-6 py-2 rounded">Search</button>
                </div>
            </form>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php $__currentLoopData = $purchases; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $purchase): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="px-6 py-4 bg-white rounded-lg shadow-lg overflow-hidden transition-transform transform hover:scale-105 flex flex-col justify-between relative">
                    <h3 class="text-xl font-bold text-gray-900  truncate"><strong> Date: </strong> <?php echo e($purchase->date); ?></h3>
                    <p><strong>Customer : </strong><?php echo e($purchase->customer_name); ?></p>
                    <p><strong> Purchase Id:</strong> <?php echo e($purchase->id); ?></p>
                    <?php if($purchase->receipt_pdf_filename): ?>
                        <div class="flex items-center space-x-4">
                            <a href="<?php echo e(url('/pdf_purchases/' . $purchase->receipt_pdf_filename)); ?>" target="_blank" class="text-lg font-bold text-blue-500 hover:text-blue-700">
                                <strong>View PDF</strong>
                            </a>
                        </div>
                    <?php else: ?>
                        <span class="text-lg font-bold text-red-300">Receipt not available</span>
                    <?php endif; ?>
                    <div class="flex justify-end mt-4 space-x-2">
                        <a class="text-lg font-bold text-green-500 hover:text-green-700" href="<?php echo e(route('tickets.showTickets', ['purchase' => $purchase])); ?>">
                            <strong>View Tickets</strong>
                        </a>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</div>
<div class="flex justify-center mb-8">
    <?php echo e($purchases->links()); ?>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/purchases/index.blade.php ENDPATH**/ ?>