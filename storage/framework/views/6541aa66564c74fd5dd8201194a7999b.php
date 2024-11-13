<?php $__env->startSection('header-title','Admins & Employees'); ?>

<?php $__env->startSection('main'); ?>
<header class="bg-white dark:bg-gray-900 shadow">
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            <?php echo $__env->yieldContent('header-title'); ?>
        </h2>
    </div>
</header>
    <div class="container mx-auto px-4 pt-16">
        <div class="flex items-center gap-4 mb-4">
            <?php if (isset($component)) { $__componentOriginale67687e3e4e61f963b25a6bcf3983629 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale67687e3e4e61f963b25a6bcf3983629 = $attributes; } ?>
<?php $component = App\View\Components\Button::resolve(['href' => ''.e(route('users.create')).'','text' => 'Create a new User'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
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

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 xl:grid-cols-5 gap-8 mt-8">
            <?php $__currentLoopData = $staffs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $staff): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="bg-white rounded-lg overflow-hidden shadow-lg flex flex-col">
                    <div class="aspect-w-16 aspect-h-9">
                        <img src="<?php echo e($staff->photoFullUrl); ?>" class="w-full h-full object-cover" alt="<?php echo e($staff->name); ?>">
                    </div>
                    <div class="flex flex-col justify-between flex-grow p-4">
                        <div>
                            <p class="text-black text-lg font-semibold"><?php echo e($staff->name); ?></p>
                            <p class="text-gray-400"><?php echo e($staff->email); ?></p>
                        </div>
                        <div class="mt-auto">
                            <?php if($staff->type === 'E'): ?>
                                <p class="text-green-500 font-bold">Employee</p>
                            <?php elseif($staff->type === 'A'): ?>
                                <p class="text-blue-500 font-bold">Administrator</p>
                            <?php endif; ?>

                        </div>

                        <?php if(!$staff->isBlocked($staff->id)): ?>
                        <form method="POST" action="<?php echo e(route('users.block', ['user' => $staff->id])); ?>"
                            onsubmit="return confirm('Are you sure you want to block this user?')" class="inline-block">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('PATCH'); ?>
                            <?php if (isset($component)) { $__componentOriginale67687e3e4e61f963b25a6bcf3983629 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale67687e3e4e61f963b25a6bcf3983629 = $attributes; } ?>
<?php $component = App\View\Components\Button::resolve(['element' => 'submit','type' => 'danger','text' => 'Block'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
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
                        </form>
                    <?php else: ?>
                        <form method="POST" action="<?php echo e(route('users.unblock', ['user' => $staff->id])); ?>"
                            onsubmit="return confirm('Are you sure you want to unblock this user?')" class="inline-block">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('PATCH'); ?>
                            <?php if (isset($component)) { $__componentOriginale67687e3e4e61f963b25a6bcf3983629 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale67687e3e4e61f963b25a6bcf3983629 = $attributes; } ?>
<?php $component = App\View\Components\Button::resolve(['element' => 'submit','type' => 'success','text' => 'Unblock'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
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
                        </form>
                    <?php endif; ?>
                    <div class="flex items-center space-x-2 mt-2">
                        <?php if (isset($component)) { $__componentOriginalcc31472b4e152dcab763e53caf44e732 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalcc31472b4e152dcab763e53caf44e732 = $attributes; } ?>
<?php $component = App\View\Components\Table\IconShow::resolve(['href' => ''.e(route('users.show', ['user' => $staff])).''] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('table.icon-show'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Table\IconShow::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalcc31472b4e152dcab763e53caf44e732)): ?>
<?php $attributes = $__attributesOriginalcc31472b4e152dcab763e53caf44e732; ?>
<?php unset($__attributesOriginalcc31472b4e152dcab763e53caf44e732); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalcc31472b4e152dcab763e53caf44e732)): ?>
<?php $component = $__componentOriginalcc31472b4e152dcab763e53caf44e732; ?>
<?php unset($__componentOriginalcc31472b4e152dcab763e53caf44e732); ?>
<?php endif; ?>
                        <?php if (isset($component)) { $__componentOriginal44f9c11916c14e492f114196bdefa85e = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal44f9c11916c14e492f114196bdefa85e = $attributes; } ?>
<?php $component = App\View\Components\Table\IconEdit::resolve(['href' => ''.e(route('users.edit', ['user' => $staff])).''] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
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
<?php $component = App\View\Components\Table\IconDelete::resolve(['action' => ''.e(route('users.destroy', ['user' => $staff])).''] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
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
                    </div>


                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        <div class="mt-8 flex justify-center">
            <?php echo e($staffs->links()); ?>

        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/users/index.blade.php ENDPATH**/ ?>