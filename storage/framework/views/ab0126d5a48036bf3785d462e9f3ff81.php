<?php $__env->startSection('header-title', 'List of Movies'); ?>

<?php $__env->startSection('main'); ?>
<div class="container"  style="padding-left: 50px; padding-right: 50px;">
    <!-- <h1>Movies List</h1> -->

    <?php if(session('error')): ?>
        <div class="alert alert-danger"><?php echo e(session('error')); ?></div>
    <?php endif; ?>

    <?php if(!empty($movies)): ?>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-16 gap-y-12 mt-12">
                <?php $__currentLoopData = $movies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $movie): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-md-3">
                        <div class="card mb-4">
                            <img class="rounded-lg shadow-md ease-in-out duration-300 hover:opacity-50" src="https://image.tmdb.org/t/p/w500<?php echo e($movie['poster_path']); ?>" class="card-img-top" alt="<?php echo e($movie['title']); ?>">
                            <div class="text-center">
                                <h5 class="card-title"><?php echo e($movie['title']); ?></h5>
                                <a href="<?php echo e(route('movies.show', $movie['id'])); ?>" class="btn btn-primary">View Details</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            <div class="mt-6">
        <?php echo e($movies->links()); ?>

    </div>
    <?php else: ?>
        <div class="alert alert-warning">No movies found.</div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\projeto\resources\views/movies/index.blade.php ENDPATH**/ ?>