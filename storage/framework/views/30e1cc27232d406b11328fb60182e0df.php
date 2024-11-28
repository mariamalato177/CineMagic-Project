<?php $__env->startSection('header-title', 'Genres'); ?>

<?php $__env->startSection('main'); ?>

    <header class="bg-white  shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <h2 class="font-semibold text-xl text-gray-800  leading-tight">
                <?php echo $__env->yieldContent('header-title'); ?>
            </h2>
        </div>
    </header>
    <div class="flex justify-center">
        <div
            class="my-4 p-6 bg-white  overflow-hidden shadow-sm sm:rounded-lg text-gray-900 w-full max-w-6xl">
            <div class="container mx-auto px-4 pt-8">
                <div class="flex items-center gap-4 mb-4">
                    <?php if (isset($component)) { $__componentOriginale67687e3e4e61f963b25a6bcf3983629 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale67687e3e4e61f963b25a6bcf3983629 = $attributes; } ?>
<?php $component = App\View\Components\Button::resolve(['href' => ''.e(route('genres.create')).'','text' => 'Create a new Genre'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
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
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    <?php $__currentLoopData = $genres; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $genre): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div
                            class="px-6 py-4 bg-white  rounded-lg shadow-lg overflow-hidden transition-transform transform hover:scale-105 flex flex-col justify-between relative">
                            <h3 class="text-xl font-bold text-gray-900 truncate"><?php echo e($genre->name); ?></h3>
                            <p>Code: <?php echo e($genre->code); ?></p>
                            <div class="flex justify-end mt-4 space-x-2">
                                <?php if(!$genre->hasActiveScreenings()): ?>
                                    <form method="POST" action="<?php echo e(route('genres.destroy', ['genre' => $genre])); ?>">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="submit" class="text-red-500">Delete</button>
                                    </form>
                                <?php else: ?>
                                    <p><strong>Active screenings </strong></p>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/genres/index.blade.php ENDPATH**/ ?>