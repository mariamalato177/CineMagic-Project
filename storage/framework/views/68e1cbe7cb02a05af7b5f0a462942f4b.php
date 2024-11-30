<?php $__env->startSection('header-title', 'Dashboard'); ?>

<?php $__env->startSection('main'); ?>
<div class="min-h-screen flex flex-col justify-start items-center pt-6 sm:pt-0 bg-gray-100 ">
    <div class="w-full sm:max-w-xl mt-6 px-6 py-4 bg-white  shadow-md overflow-hidden sm:rounded-lg">

         <?php $__env->slot('header', null, []); ?> 
            <h2 class="font-semibold text-xl text-gray-800  leading-tight">
                <?php echo e(__('Dashboard')); ?>

            </h2>
         <?php $__env->endSlot(); ?>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white  overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 ">
                        <?php echo e(__("You're logged in!")); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/dashboard.blade.php ENDPATH**/ ?>