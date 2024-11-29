<?php $__env->startSection('header-title', 'Profile'); ?>

<?php $__env->startSection('main'); ?>
    <div class="min-h-screen flex flex-col justify-start items-center pt-6 sm:pt-0 bg-gray-100 ">
        <div class="w-full sm mt-6 px-6 py-4 bg-white  shadow-md overflow-hidden sm:rounded-lg">
             <?php $__env->slot('header', null, []); ?> 
                <h2 class="font-semibold text-xl text-gray-800  leading-tight">
                    <?php echo e(__('Profile')); ?>

                </h2>
             <?php $__env->endSlot(); ?>

            <div class="py-12">
                <?php if($user->type != 'E'): ?>
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                        <div class="p-4 sm:p-8">
                            <div class="max-w-lg">
                                <?php echo $__env->make('profile.partials.update-profile-information-form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            </div>
                        </div>
                <?php endif; ?>
                <div class="p-4 sm:p-8 bg-white  ">
                    <div class="max-w-xl">
                        <?php echo $__env->make('profile.partials.update-password-form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                </div>
                <?php if($user->type != 'E'): ?>
                <div class="p-4 sm:p-8 bg-white  ">
                    <div class="max-w-xl">
                        <?php echo $__env->make('profile.partials.delete-user-form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/profile/edit.blade.php ENDPATH**/ ?>