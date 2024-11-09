<?php $__env->startSection('header-title', $movie->title); ?>

<?php $__env->startSection('main'); ?>
<div class="flex flex-col space-y-6">
    <div class="p-4 sm:p-8 bg-white dark:bg-gray-900 shadow sm:rounded-lg">
        <div class="max-full">
            <section>

                <div class="mt-6 space-y-4">
                    <?php echo $__env->make('movies.shared.fields', ['mode' => 'show'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
            </section>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\projeto\resources\views/movies/show.blade.php ENDPATH**/ ?>