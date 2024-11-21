<div>
    <?php
        // Group screenings by a custom attribute (e.g., tmdbId)
        $groupedScreenings = $screenings->groupBy('custom');
    ?>

    <?php $__currentLoopData = $groupedScreenings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tmdbId => $screeningsGroup): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="mb-8">
            <?php
                // Get the movie data for the current tmdbId
                $movie = $movieData[$tmdbId] ?? null;
            ?>

            <?php if($movie): ?>
                <h1 class="text-2xl font-bold mb-4 text-gray-900">
                    Movie: <?php echo e($movie['title'] ?? 'Unknown Title'); ?>

                </h1>
                <div class="flex items-start">
                    <div class="w-1/4 h-full overflow-hidden flex justify-center items-center mb-4">
                        <a href="#">
                            <img src="<?php echo e($movie['poster_path'] ? 'https://image.tmdb.org/t/p/w500' . $movie['poster_path'] : asset('storage/posters/_no_poster_2.png')); ?>"
                                 alt="<?php echo e($movie['title'] ?? 'No Poster'); ?>"
                                 class="w-full h-auto object-contain rounded-lg">
                        </a>
                    </div>
                    <div class="w-3/4 pl-4">
                        <?php $__currentLoopData = $screeningsGroup; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $screening): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                $theater = $screening->theaterRef;
                            ?>
                            <div class="mb-4">
                                <a href="<?php echo e(route('theaters.show', ['theater' => $theater])); ?>">
                                    <h2 class="text-xl font-semibold mb-2 text-gray-900">
                                        Theater: <?php echo e($theater->name); ?>

                                    </h2>
                                </a>
                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                                    <div class="session-card bg-white shadow-md rounded-lg p-4 relative">
                                        <div class="movie-info text-gray-700">
                                            <p class="text-xl">
                                                <strong>Date:</strong> <?php echo e($screening->date); ?>

                                            </p>
                                            <p class="text-xl">
                                                <strong>Start Time:</strong> <?php echo e($screening->start_time); ?>

                                            </p>
                                        </div>
                                        <div class="actions mt-4 flex justify-end gap-2">
                                            <?php if($showView): ?>
                                                <a class="px-2 py-1 bg-yellow-400 text-white text-sm font-semibold rounded-full flex items-center"
                                                   href="<?php echo e(route('screenings.showTickets', ['screening' => $screening])); ?>">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" viewBox="0 0 24 24" fill="currentColor">
                                                        <path d="M20 3H4c-1.1 0-2 .9-2 2v3.5c1.11 0 2 .89 2 2s-.89 2-2 2V19c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2v-3.5c-1.11 0-2-.89-2-2s.89-2 2-2V5c0-1.1-.9-2-2-2zm-5 10H9v-2h6v2zm0-4H9V7h6v2z"/>
                                                    </svg>
                                                </a>
                                            <?php endif; ?>
                                            <?php if($showEdit): ?>
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
                                            <?php endif; ?>
                                            <?php if($showDelete): ?>
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
                                            <?php endif; ?>
                                            <?php if($screening->hasPassed()): ?>
                                                <div class="absolute top-2 right-2">
                                                    <span
                                                        class="px-2 py-1 bg-red-500 text-white text-sm font-semibold rounded-full">Unavailable</span>
                                                </div>
                                            <?php else: ?>
                                                <?php if(!$screening->isSoldOut($screening)): ?>
                                                    <a href="<?php echo e(route('screenings.show', $screening)); ?>"
                                                       class="px-2 py-1 font-semibold rounded-full"
                                                       style="background-color: coral; color: white;">
                                                        <?php echo e(auth()->check() && auth()->user()->type !== 'C' ? 'See Info' : 'Buy Ticket'); ?>

                                                    </a>
                                                <?php else: ?>
                                                    <?php if(auth()->check() && auth()->user()->type !== 'A'): ?>
                                                        <a href="<?php echo e(route('screenings.show', $screening)); ?>"
                                                           class="px-2 py-1 font-semibold rounded-full"
                                                           style="background-color: coral; color: white;">
                                                           See Info
                                                        </a>
                                                        <div class="absolute top-2 right-2">
                                                            <span class="px-2 py-1 bg-red-500 text-white text-xl font-semibold rounded-full">Sold Out</span>
                                                        </div>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            <?php else: ?>
                <p>No movie data available</p>
            <?php endif; ?>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<?php /**PATH /var/www/html/resources/views/components/screenings/table.blade.php ENDPATH**/ ?>