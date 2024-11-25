<?php $__env->startSection('header-title', 'List of Theaters'); ?>

<?php $__env->startSection('main'); ?>
    <div class="flex justify-center">
        <div
            class="my-4 p-6 bg-white  overflow-hidden shadow-sm sm:rounded-lg text-gray-900  w-full max-w-6xl">
                <div class="flex items-center justify-between mb-4">
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create', App\Models\Theater::class)): ?>
                        <div class="flex items-center gap-4 mb-4">
                            <?php if (isset($component)) { $__componentOriginale67687e3e4e61f963b25a6bcf3983629 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale67687e3e4e61f963b25a6bcf3983629 = $attributes; } ?>
<?php $component = App\View\Components\Button::resolve(['href' => ''.e(route('theaters.create')).'','text' => 'Create a new theater'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
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
                </div>
            <div class="grid grid-cols-1 gap-6">
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('update', App\Models\Theater::class)): ?>
                        <?php if (isset($component)) { $__componentOriginal74f311e7b6979d5c7520fa7ce086cc26 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal74f311e7b6979d5c7520fa7ce086cc26 = $attributes; } ?>
<?php $component = App\View\Components\Theaters\Table::resolve(['theaters' => $theaters,'showView' => true,'showEdit' => true,'showDelete' => true] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('theaters.table'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Theaters\Table::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal74f311e7b6979d5c7520fa7ce086cc26)): ?>
<?php $attributes = $__attributesOriginal74f311e7b6979d5c7520fa7ce086cc26; ?>
<?php unset($__attributesOriginal74f311e7b6979d5c7520fa7ce086cc26); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal74f311e7b6979d5c7520fa7ce086cc26)): ?>
<?php $component = $__componentOriginal74f311e7b6979d5c7520fa7ce086cc26; ?>
<?php unset($__componentOriginal74f311e7b6979d5c7520fa7ce086cc26); ?>
<?php endif; ?>
                    <?php else: ?>
                        <?php if (isset($component)) { $__componentOriginal74f311e7b6979d5c7520fa7ce086cc26 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal74f311e7b6979d5c7520fa7ce086cc26 = $attributes; } ?>
<?php $component = App\View\Components\Theaters\Table::resolve(['theaters' => $theaters,'showView' => true,'showEdit' => false,'showDelete' => false] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('theaters.table'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Theaters\Table::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal74f311e7b6979d5c7520fa7ce086cc26)): ?>
<?php $attributes = $__attributesOriginal74f311e7b6979d5c7520fa7ce086cc26; ?>
<?php unset($__attributesOriginal74f311e7b6979d5c7520fa7ce086cc26); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal74f311e7b6979d5c7520fa7ce086cc26)): ?>
<?php $component = $__componentOriginal74f311e7b6979d5c7520fa7ce086cc26; ?>
<?php unset($__componentOriginal74f311e7b6979d5c7520fa7ce086cc26); ?>
<?php endif; ?>
                <?php endif; ?>
            </div>
            <div class="mt-6">
                <?php echo e($theaters->links()); ?>

            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\projeto\resources\views/theaters/index.blade.php ENDPATH**/ ?>