<?php $__env->startSection('header-title', 'List of Screenings'); ?>

<?php $__env->startSection('main'); ?>
<?php
    $groupedScreenings = $screenings->groupBy('custom');
?>

<header class="bg-white ">
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <h2 class="font-semibold text-xl text-gray-800  leading-tight">
            <?php echo $__env->yieldContent('header-title'); ?>
        </h2>
        <br>
        <form action="<?php echo e(route('screenings.index')); ?>" method="GET"
            class="flex flex-wrap items-center space-y-4 md:space-y-0 md:space-x-4">
            <label for="search" class="text-black ">Search:</label>
            <div class="flex flex-col space-y-2">

                <input type="text" id="search" name="search" value="<?php echo e($searchQuery ?? ''); ?>"
                    placeholder="Screening ID" class="bg-white text-black p-2 rounded">
            </div>
            <div class="flex flex-col space-y-2">
                <input type="text" id="movie" name="movie" value="<?php echo e($searchQuery ?? ''); ?>"
                    placeholder="Movie Title" class="bg-white text-black p-2 rounded">

            </div>
            <div class="flex">
                <button type="submit" class="bg-coral text-white px-6 py-2 rounded">Search</button>
            </div>
            <div>
                <a href="<?php echo e(route('screenings.index')); ?>" class="bg-gray-200 text-black px-6 py-3 rounded">Cancel</a>
            </div>
        </form>
    </div>
</header>
<div class="flex justify-center">
    <div
        class="my-4 p-6 bg-white  overflow-hidden shadow-sm sm:rounded-lg text-gray-900  w-full max-w-7xl">

        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create', App\Models\Screening::class)): ?>
            <div class="flex items-center gap-4 mb-4">
                <?php if (isset($component)) { $__componentOriginale67687e3e4e61f963b25a6bcf3983629 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale67687e3e4e61f963b25a6bcf3983629 = $attributes; } ?>
<?php $component = App\View\Components\Button::resolve(['href' => ''.e(route('screenings.create')).'','text' => 'Create a new Screening'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Button::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale67687e3e4e61f963b25a6bcf3983629)): ?>
<?php $attributes = $__attributesOriginale67687e3e4e61f963b25a6bcf3983629; ?>
<?php unset($__attributesOriginale67687e3e4e61f963b25a6bcf3983629); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale67687e3e4e61f963b25a6bcf3983629)): ?>
<?php $component = $__componentOriginale67687e3e4e61f963b25a6bcf3983629; ?>
<?php unset($__componentOriginale67687e3e4e61f963b25a6bcf3983629); ?>
<?php endif; ?>
            </div>
        <?php endif; ?>
        <div class="font-base text-sm text-gray-700 ">
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('update', App\Models\Screening::class)): ?>
                <x-screenings.table :screenings="$screenings" :$movie="$movieData" :showMovie="true" :showView="true" :showEdit="true"
                    :showDelete="true" />
            <?php else: ?>
                <?php if(auth()->check() && auth()->user()->type !== 'C'): ?>
                    <x-screenings.table :screenings="$screenings" :$movie="$movieData" :showMovie="true" :showView="true" :showEdit="false"
                        :showDelete="false" />
                <?php else: ?>
                    <x-screenings.table :screenings="$screenings" :$movie="$movieData" :showMovie="true" :showView="false" :showEdit="false"
                        :showDelete="false" />
                <?php endif; ?>
            <?php endif; ?>
        </div>
        <div class="mt-4">
            <?php echo e($screenings->links()); ?>

        </div>
    </div>
</div>
<?php $__currentLoopData = $groupedScreenings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tmdbId => $screeningsGroup): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php
        // Get the movie data for the current tmdbId
        $movie = $movieData[$tmdbId] ?? null;
    ?>

    <div class="movie-group">
        <?php if($movie): ?>
            <h2><?php echo e($movie['title'] ?? 'Unknown Movie'); ?></h2>
            <img src="https://image.tmdb.org/t/p/w200/<?php echo e($movie['poster_path'] ?? 'default-poster.jpg'); ?>" alt="<?php echo e($movie['title'] ?? 'Unknown Movie'); ?> poster">
        <?php else: ?>
            <p>No movie data available</p>
        <?php endif; ?>

        <div class="screenings">
            <?php $__currentLoopData = $screeningsGroup; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $screening): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="screening">
                    <div class="screening-details">
                        <p><strong>Theater:</strong> <?php echo e($screening->theaterRef->name); ?></p>
                        <p><strong>Date:</strong> <?php echo e($screening->date); ?></p>
                        <p><strong>Start Time:</strong> <?php echo e($screening->start_time); ?></p>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


    <div class="mt-4">
        <?php echo e($screenings->links()); ?>

    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/screenings/index.blade.php ENDPATH**/ ?>