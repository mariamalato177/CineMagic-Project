<?php $__env->startSection('header-title', 'List of Screenings'); ?>

<?php $__env->startSection('main'); ?>

    <header class="bg-white dark:bg-gray-900 shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                <?php echo $__env->yieldContent('header-title'); ?>
            </h2>
            <br>
            <form action="<?php echo e(route('screenings.index')); ?>" method="GET"
                class="flex flex-wrap items-center space-y-4 md:space-y-0 md:space-x-4">
                <label for="search" class="text-black dark:text-white">Search:</label>
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
            class="my-4 p-6 bg-white dark:bg-gray-900 overflow-hidden shadow-sm sm:rounded-lg text-gray-900 dark:text-gray-50 w-full max-w-7xl">

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



            <div class="font-base text-sm text-gray-700 dark:text-gray-300">

                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('update', App\Models\Screening::class)): ?>
                    <?php if (isset($component)) { $__componentOriginal617e16b714af794b5f18d6f0ea8ac36b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal617e16b714af794b5f18d6f0ea8ac36b = $attributes; } ?>
<?php $component = App\View\Components\Screenings\Table::resolve(['screenings' => $screenings,'showView' => true,'showEdit' => true,'showDelete' => true] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('screenings.table'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Screenings\Table::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['showMovie' => true]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal617e16b714af794b5f18d6f0ea8ac36b)): ?>
<?php $attributes = $__attributesOriginal617e16b714af794b5f18d6f0ea8ac36b; ?>
<?php unset($__attributesOriginal617e16b714af794b5f18d6f0ea8ac36b); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal617e16b714af794b5f18d6f0ea8ac36b)): ?>
<?php $component = $__componentOriginal617e16b714af794b5f18d6f0ea8ac36b; ?>
<?php unset($__componentOriginal617e16b714af794b5f18d6f0ea8ac36b); ?>
<?php endif; ?>
                <?php else: ?>
                    <?php if(auth()->check() && auth()->user()->type !== 'C'): ?>
                        <?php if (isset($component)) { $__componentOriginal617e16b714af794b5f18d6f0ea8ac36b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal617e16b714af794b5f18d6f0ea8ac36b = $attributes; } ?>
<?php $component = App\View\Components\Screenings\Table::resolve(['screenings' => $screenings,'showView' => true,'showEdit' => false,'showDelete' => false] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('screenings.table'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Screenings\Table::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['showMovie' => true]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal617e16b714af794b5f18d6f0ea8ac36b)): ?>
<?php $attributes = $__attributesOriginal617e16b714af794b5f18d6f0ea8ac36b; ?>
<?php unset($__attributesOriginal617e16b714af794b5f18d6f0ea8ac36b); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal617e16b714af794b5f18d6f0ea8ac36b)): ?>
<?php $component = $__componentOriginal617e16b714af794b5f18d6f0ea8ac36b; ?>
<?php unset($__componentOriginal617e16b714af794b5f18d6f0ea8ac36b); ?>
<?php endif; ?>
                    <?php else: ?>
                        <?php if (isset($component)) { $__componentOriginal617e16b714af794b5f18d6f0ea8ac36b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal617e16b714af794b5f18d6f0ea8ac36b = $attributes; } ?>
<?php $component = App\View\Components\Screenings\Table::resolve(['screenings' => $screenings,'showView' => false,'showEdit' => false,'showDelete' => false] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('screenings.table'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Screenings\Table::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['showMovie' => true]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal617e16b714af794b5f18d6f0ea8ac36b)): ?>
<?php $attributes = $__attributesOriginal617e16b714af794b5f18d6f0ea8ac36b; ?>
<?php unset($__attributesOriginal617e16b714af794b5f18d6f0ea8ac36b); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal617e16b714af794b5f18d6f0ea8ac36b)): ?>
<?php $component = $__componentOriginal617e16b714af794b5f18d6f0ea8ac36b; ?>
<?php unset($__componentOriginal617e16b714af794b5f18d6f0ea8ac36b); ?>
<?php endif; ?>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
            <div class="mt-4">
                <?php echo e($screenings->links()); ?>

            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/screenings/index.blade.php ENDPATH**/ ?>