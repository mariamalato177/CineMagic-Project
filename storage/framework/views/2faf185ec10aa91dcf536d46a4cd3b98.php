<div <?php echo e($attributes->merge(['class' => 'grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 relative z-10'])); ?>>
    <?php $__currentLoopData = $theaters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $theater): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 transition-transform transform hover:scale-105 flex flex-col justify-between relative z-10">
            <a href="<?php echo e(route('theaters.show', ['theater' => $theater])); ?>" class="flex justify-center">
            <h3 class="text-xl font-bold text-gray-900 dark:text-gray-50 truncate"><?php echo e($theater->name); ?></h3>
            <div class="flex justify-end mt-4 space-x-2">
                <?php if($showEdit): ?>
                    <?php if (isset($component)) { $__componentOriginal44f9c11916c14e492f114196bdefa85e = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal44f9c11916c14e492f114196bdefa85e = $attributes; } ?>
<?php $component = App\View\Components\Table\IconEdit::resolve(['href' => ''.e(route('theaters.edit', ['theater' => $theater])).''] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
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
<?php $component = App\View\Components\Table\IconDelete::resolve(['action' => ''.e(route('theaters.destroy', ['theater' => $theater])).''] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
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
            </div>
            </a>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<?php /**PATH C:\laragon\www\projeto\resources\views/components/theaters/table.blade.php ENDPATH**/ ?>