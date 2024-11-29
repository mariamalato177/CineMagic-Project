<?php $__env->startSection('header-title', 'List of Screenings'); ?>

<?php $__env->startSection('main'); ?>
    <?php
        $groupedScreenings = $screenings->groupBy('custom');
        $availableDates = collect($availableDates)->map(function ($date) {
            return \Carbon\Carbon::parse($date)->format('Y-m-d');
        });
        $sortedScreenings = $groupedScreenings->sortByDesc(function ($group) {
            return $group->count();
        });
    ?>

    <header class="bg-white">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                <?php echo $__env->yieldContent('header-title'); ?>
            </h2>
            <br>
            <form action="<?php echo e(route('screenings.index')); ?>" method="GET"
                class="flex flex-wrap items-center space-y-4 md:space-y-0 md:space-x-4">
                <label for="search" class="text-black">Search:</label>
                <div class="flex flex-col space-y-2">
                    <input type="text" id="search" name="search" value="<?php echo e($searchQuery ?? ''); ?>"
                        placeholder="Screening ID" class="bg-white text-black p-2 rounded">
                </div>
                <div class="flex flex-col space-y-2">
                    <input type="text" id="movie" name="movie" value="<?php echo e($movieQuery ?? ''); ?>"
                        placeholder="Movie Title" class="bg-white text-black p-2 rounded">
                </div>
                <!-- Date Input for Filtering Screenings -->
                <div class="flex items-center space-x-4 mt-6">
                    <label for="date" class="text-black">Select Date:</label>
                    <input type="date" name="date" id="date" class="bg-white text-black p-2 rounded"
                        value="<?php echo e($selectedDate ?? ''); ?>" min="<?php echo e(now()->format('Y-m-d')); ?>">
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
        <div class="my-4 p-6 bg-white overflow-hidden shadow-sm sm:rounded-lg text-gray-900 w-full max-w-[90%] mx-auto">
            <?php $__currentLoopData = $groupedScreenings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tmdbId => $screeningsGroup): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="mb-8">
                    <?php
                        $movie = $movieData[$tmdbId] ?? null;
                    ?>

                    <?php if($movie): ?>
                        <h1 class="text-2xl font-bold mb-4 text-gray-900">
                            Movie: <?php echo e($movie['title'] ?? 'Unknown Title'); ?>

                        </h1>
                        <div class="flex flex-col md:flex-row items-start">
                            <!-- Poster Section -->
                            <div class="w-full md:w-1/4 flex justify-center items-center mb-4 md:mb-0">
                                <a href="#">
                                    <img src="<?php echo e($movie['poster_path'] ? 'https://image.tmdb.org/t/p/w500' . $movie['poster_path'] : asset('storage/posters/_no_poster_2.png')); ?>"
                                        alt="<?php echo e($movie['title'] ?? 'No Poster'); ?>"
                                        class="w-80 h-auto object-contain rounded-lg">
                                </a>
                            </div>

                            <!-- Screenings Section -->
                            <div class="w-full md:w-3/4 md:pl-4">
                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                                    <?php
                                        $sortedTheaters = $screeningsGroup
                                            ->groupBy('theaterRef.name')
                                            ->sortByDesc(function ($theaterGroup) {
                                                return $theaterGroup->count();
                                            });
                                    ?>
                                    <?php $__currentLoopData = $sortedTheaters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $theaterName => $theaterScreenings): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <!-- Theater Box -->
                                        <div
                                            class="bg-gray-100 shadow-lg rounded-md p-4 flex flex-col justify-between h-full">
                                            <h2 class="text-xl font-semibold mb-2 text-gray-900">Theater:
                                                <?php echo e($theaterName); ?></h2>
                                            <div class="space-y-4 flex-grow">
                                                <?php $__currentLoopData = $theaterScreenings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $screening): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <!-- Individual Screening Card -->
                                                    <div class="bg-white shadow-md rounded-lg p-4">
                                                        <?php
                                                        $date = \Carbon\Carbon::parse($screening->date)->format('d-m-Y');
                                                         ?>
                                                        <p class="text-xl"><strong>Date:</strong> <?php echo e($date); ?>

                                                        </p>
                                                        <p class="text-xl"><strong>Start Time:</strong>
                                                            <?php echo e($screening->start_time); ?></p>
                                                        <div class="mt-4 flex justify-end items-center space-x-2">
                                                            <?php if(auth()->check() && auth()->user()->type === 'A'): ?>
                                                                <a class="px-2 py-1 bg-yellow-400 text-white text-sm font-semibold rounded-full inline-flex items-center"
                                                                    href="<?php echo e(route('screenings.showTickets', ['screening' => $screening])); ?>">
                                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                                        class="w-4 h-4 mr-2" viewBox="0 0 24 24"
                                                                        fill="currentColor">
                                                                        <path
                                                                            d="M20 3H4c-1.1 0-2 .9-2 2v3.5c1.11 0 2 .89 2 2s-.89 2-2 2V19c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2v-3.5c-1.11 0-2-.89-2-2s.89-2 2-2V5c0-1.1-.9-2-2-2zm-5 10H9v-2h6v2zm0-4H9V7h6v2z" />
                                                                    </svg>
                                                                </a>
                                                                <?php if (isset($component)) { $__componentOriginal44f9c11916c14e492f114196bdefa85e = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal44f9c11916c14e492f114196bdefa85e = $attributes; } ?>
<?php $component = App\View\Components\Table\IconEdit::resolve(['href' => ''.e(route('screenings.edit', ['screening' => $screening])).''] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('table.icon-edit'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Table\IconEdit::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal44f9c11916c14e492f114196bdefa85e)): ?>
<?php $attributes = $__attributesOriginal44f9c11916c14e492f114196bdefa85e; ?>
<?php unset($__attributesOriginal44f9c11916c14e492f114196bdefa85e); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal44f9c11916c14e492f114196bdefa85e)): ?>
<?php $component = $__componentOriginal44f9c11916c14e492f114196bdefa85e; ?>
<?php unset($__componentOriginal44f9c11916c14e492f114196bdefa85e); ?>
<?php endif; ?>
                                                                <?php if (isset($component)) { $__componentOriginald16d466b6de69a6c808277f1bfc3f4f2 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald16d466b6de69a6c808277f1bfc3f4f2 = $attributes; } ?>
<?php $component = App\View\Components\Table\IconDelete::resolve(['action' => ''.e(route('screenings.destroy', ['screening' => $screening])).''] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('table.icon-delete'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Table\IconDelete::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald16d466b6de69a6c808277f1bfc3f4f2)): ?>
<?php $attributes = $__attributesOriginald16d466b6de69a6c808277f1bfc3f4f2; ?>
<?php unset($__attributesOriginald16d466b6de69a6c808277f1bfc3f4f2); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald16d466b6de69a6c808277f1bfc3f4f2)): ?>
<?php $component = $__componentOriginald16d466b6de69a6c808277f1bfc3f4f2; ?>
<?php unset($__componentOriginald16d466b6de69a6c808277f1bfc3f4f2); ?>
<?php endif; ?>
                                                            <?php else: ?>
                                                                <?php if(!$screening->isSoldOut($screening)): ?>
                                                                    <div class="mt-4 flex justify-end">
                                                                        <a href="<?php echo e(route('screenings.show', $screening)); ?>"
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
                                                                    <a href="<?php echo e(route('screenings.show', $screening)); ?>"
                                                                    rel="noopener noreferrer"
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
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
        </div>
    </div>
<?php else: ?>
    <p>No movie data available</p>
    <?php endif; ?>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    </div>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/screenings/index.blade.php ENDPATH**/ ?>