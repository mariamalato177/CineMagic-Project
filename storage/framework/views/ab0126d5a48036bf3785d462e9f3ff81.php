<?php $__env->startSection('header-title', 'List of Movies'); ?>


<?php $__env->startSection('main'); ?>
<div class="container">
    <h1>Popular Movies</h1>

    <?php if(session('error')): ?>
        <div class="alert alert-danger"><?php echo e(session('error')); ?></div>
    <?php endif; ?>

    <?php if(!empty($movies)): ?>
        <div class="row">
            <?php $__currentLoopData = $movies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $movie): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-md-3">
                    <div class="card mb-4">
                        <img src="https://image.tmdb.org/t/p/w500<?php echo e($movie['poster_path']); ?>" class="card-img-top" alt="<?php echo e($movie['title']); ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo e($movie['title']); ?></h5>
                            <p class="card-text"><?php echo e($movie['overview']); ?></p>
                            <a href="<?php echo e(route('movies.show', $movie['id'])); ?>" class="btn btn-primary">View Details</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    <?php else: ?>
        <div class="alert alert-warning">No movies found.</div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\projeto\resources\views/movies/index.blade.php ENDPATH**/ ?>