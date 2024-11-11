<?php $__env->startSection('header-title', 'CineMagic - Home'); ?>

<?php $__env->startSection('main'); ?>
<main>
    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        
        <!-- Welcome Section -->
        <div class="my-4 p-6 bg-white dark:bg-gray-900 shadow-lg rounded-lg text-gray-900 dark:text-gray-50">
            <h3 class="pb-3 text-2xl font-semibold text-gray-900 dark:text-gray-200 leading-tight">
                <?php if(auth()->guard()->check()): ?>
                    Welcome back, <?php echo e(Auth::user()->name); ?>!
                <?php else: ?>
                    <p class="text-lg">Welcome!</p>
                    <p class="text-lg">You can login <a href="<?php echo e(route('login')); ?>" class="text-coral">here</a>.</p>
                    <p class="text-lg">If you don't have an account, register <a href="<?php echo e(route('register')); ?>" class="text-coral">here</a>.</p>
                <?php endif; ?>
            </h3>
        </div>

        <!-- Popular Movies Section -->
        <div class="my-8">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-50 mb-4">Popular Movies</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php $__currentLoopData = $popularMovies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $movie): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-4">
                        <img src="https://image.tmdb.org/t/p/w500<?php echo e($movie['poster_path']); ?>" 
                             alt="<?php echo e($movie['title']); ?>" 
                             class="w-full h-auto object-contain rounded-lg mb-4">
                        <h3 class="text-xl font-bold text-gray-900 dark:text-gray-50"><?php echo e($movie['title']); ?></h3>
                        <p class="text-gray-700 dark:text-gray-300"><?php echo e($movie['release_date']); ?></p>
                        <p class="text-gray-700 dark:text-gray-300"><?php echo e($movie['vote_average']); ?>/10</p>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>

        <!-- Now Playing Movies Section -->
        <div class="my-8">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-50 mb-4">Now Playing Movies</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php $__currentLoopData = $nowPlayingMovies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $movie): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-4">
                        <img src="https://image.tmdb.org/t/p/w500<?php echo e($movie['poster_path']); ?>" 
                             alt="<?php echo e($movie['title']); ?>" 
                             class="w-full h-auto object-contain rounded-lg mb-4">
                        <h3 class="text-xl font-bold text-gray-900 dark:text-gray-50"><?php echo e($movie['title']); ?></h3>
                        <p class="text-gray-700 dark:text-gray-300"><?php echo e($movie['release_date']); ?></p>
                        <p class="text-gray-700 dark:text-gray-300"><?php echo e($movie['vote_average']); ?>/10</p>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>

        <!-- Upcoming Screenings Section -->
<div class="my-8">
    <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-50 mb-4">Upcoming Screenings</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <?php $__currentLoopData = $upcomingScreenings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $screening): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-4">
                <!-- Exibir a imagem do filme -->
                <img src="https://image.tmdb.org/t/p/w500<?php echo e($screening['poster_path']); ?>" alt="<?php echo e($screening['title']); ?>" class="w-full h-auto object-contain rounded-lg mb-4">
                <!-- Título do filme -->
                <h3 class="text-xl font-bold text-gray-900 dark:text-gray-50"><?php echo e($screening['title']); ?></h3>
                <!-- Data de lançamento -->
                <p class="text-gray-700 dark:text-gray-300"><?php echo e($screening['release_date']); ?></p>
                <!-- Nota do filme -->
                <p class="text-gray-700 dark:text-gray-300"><?php echo e($screening['vote_average']); ?>/10</p>
                <!-- Link para mais informações ou comprar ingressos -->
                <a href="#" class="mt-2 inline-block px-4 py-2 bg-coral text-white rounded-full hover:bg-orange-500 transition-colors">
                    Buy Tickets
                </a>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>

</main>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\projeto\resources\views/home.blade.php ENDPATH**/ ?>