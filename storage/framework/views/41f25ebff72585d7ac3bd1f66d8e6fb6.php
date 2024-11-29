<?php $__env->startSection('header-title', 'CineMagic - Home'); ?>

<?php $__env->startSection('main'); ?>
    <!-- Welcome Section -->
    <div class="my-4 p-6 bg-white overflow-hidden shadow-sm sm:rounded-lg text-gray-900 w-full max-w-[90%] mx-auto">
        <h3 class="pb-3 text-2xl font-semibold text-gray-900 leading-tight">
            <?php if(auth()->guard()->check()): ?>
                Welcome back, <?php echo e(Auth::user()->name); ?>!
            <?php else: ?>
                <p class="text-lg">Welcome!</p>
                <p class="text-lg">You can login <a href="<?php echo e(route('login')); ?>" class="text-coral">here</a>.</p>
                <p class="text-lg">If you don't have an account, register <a href="<?php echo e(route('register')); ?>"
                        class="text-coral">here</a>.</p>
            <?php endif; ?>
        </h3>
    </div>

    <div class="flex justify-center">
        <div class="my-4 p-6 bg-white overflow-hidden shadow-sm sm:rounded-lg text-gray-900 w-full max-w-[90%] mx-auto">
            <!-- Upcoming Movies Carousel -->
            <div class="my-8 mb-12 relative">
                <h2 class="text-2xl font-bold text-gray-900 mb-4">Upcoming Movies</h2>

                <div class="flex overflow-x-auto scroll-smooth space-x-4">
                    <?php $__currentLoopData = $upcomingMovies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $movie): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="w-full sm:w-1/4 flex-shrink-0 pb-4">
                            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                                <div class="relative pb-[150%]">
                                    <img src="https://image.tmdb.org/t/p/w500<?php echo e($movie['poster_path']); ?>"
                                        alt="<?php echo e($movie['title']); ?>"
                                        class="absolute top-0 left-0 w-full h-full object-cover rounded-t-lg">
                                </div>
                                <div class="p-4">
                                    <h3 class="text-lg font-semibold text-gray-900"><?php echo e($movie['title']); ?></h3>
                                    <p class="text-sm text-gray-600">
                                        <?php echo e(\Carbon\Carbon::parse($movie['release_date'])->format('d-m-Y')); ?>

                                    </p>
                                    <p class="text-sm text-gray-400">Rating:
                                        <?php echo e(number_format($movie['vote_average'], 1)); ?>/10</p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
            <!-- Now Playing Movies Carousel -->
            <div class="my-8 mb-12 relative">
                <h2 class="text-2xl font-bold text-gray-900 mb-4">Now Playing Movies</h2>

                <div id="nowPlayingCarousel" class="flex overflow-x-auto scroll-smooth space-x-4">
                    <?php $__currentLoopData = $nowPlayingMovies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $movie): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="w-full sm:w-1/4 flex-shrink-0 pb-4">
                            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                                <div class="relative pb-[150%]">
                                    <img src="https://image.tmdb.org/t/p/w500<?php echo e($movie['poster_path']); ?>"
                                        alt="<?php echo e($movie['title']); ?>"
                                        class="absolute top-0 left-0 w-full h-full object-cover rounded-t-lg">
                                </div>
                                <div class="p-4">
                                    <h3 class="text-lg font-semibold text-gray-900"><?php echo e($movie['title']); ?></h3>
                                    <p class="text-sm text-gray-600">
                                        <?php echo e(\Carbon\Carbon::parse($movie['release_date'])->format('d-m-Y')); ?>

                                    </p>
                                    <p class="text-sm text-gray-400">Rating:
                                        <?php echo e(number_format($movie['vote_average'], 1)); ?>/10</p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>

            <!-- Upcoming Screenings Section -->
            <div class="my-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-4">Upcoming Screenings</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <?php $__currentLoopData = $screeningsByMovie; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $movieGroup): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="bg-white rounded-lg shadow-sm p-4">
                            <img src="https://image.tmdb.org/t/p/w500<?php echo e($movieGroup['movie']['poster_path']); ?>"
                                alt="<?php echo e($movieGroup['movie']['title']); ?>"
                                class="w-full h-auto object-contain rounded-lg mb-4">
                            <h3 class="text-lg font-semibold text-gray-900"><?php echo e($movieGroup['movie']['title']); ?></h3>

                            <?php
                                $date = \Carbon\Carbon::parse($movieGroup['screening']['date'])->format('d-m-Y');
                            ?>
                            <p class="text-sm text-gray-600"><strong>Date:</strong> <?php echo e($date); ?></p>
                            <p class="text-sm text-gray-600"><strong>Time:
                                </strong><?php echo e($movieGroup['screening']['start_time']); ?></p>
                            <?php if(!$movieGroup['screening']->isSoldOut($movieGroup['screening'])): ?>
                                <div class="mt-4 flex justify-end">
                                    <a href="<?php echo e(route('screenings.show', $movieGroup['screening'])); ?>"
                                        class="px-4 py-2 bg-coral text-white rounded-full"
                                        style=" color: white; transition: background-color 0.3s ease-in-out;">
                                        <?php if(auth()->check() && auth()->user()->type !== 'C'): ?>
                                            See info
                                        <?php else: ?>
                                            Buy Tickets
                                        <?php endif; ?>
                                    </a>
                                </div>
                            <?php else: ?>
                                <?php if(auth()->check() && auth()->user()->type !== 'A'): ?>
                                    <a href="<?php echo e(route('screenings.show', $movieGroup['screening'])); ?>" rel="noopener noreferrer"
                                        class="px-2 py-1 font-semibold rounded-full bg-coral"
                                        style="color: white; transition: background-color 0.3s ease-in-out;">
                                        See Info
                                    </a>
                                    <div class="absolute top-2 right-2">
                                        <span
                                            class="px-2 py-1 bg-red-500 text-white text-xl font-semibold rounded-full">Sold
                                            Out</span>
                                    </div>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    </div>
    </div>
    </main>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/home.blade.php ENDPATH**/ ?>