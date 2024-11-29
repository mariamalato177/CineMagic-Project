
<?php
    $widthClass = match($width) {
        'full' => 'w-full',
        'xs' => 'w-20',
        'sm' => 'w-32',
        'md' => 'w-64',
        'lg' => 'w-96',
        'xl' => 'w-[48rem]',
        '1/3' => 'w-1/3',
        '2/3' => 'w-2/3',
        '1/4' => 'w-1/4',
        '2/4' => 'w-2/4',
        '3/4' => 'w-3/4',
        '1/5' => 'w-1/5',
        '2/5' => 'w-2/5',
        '3/5' => 'w-3/5',
        '4/5' => 'w-4/5',
    };

    $maxHeightClass = match($width) {
        'full' => 'max-h-full',
        'xs' => 'max-h-32',
        'sm' => 'max-h-48',
        'md' => 'max-h-96',
        'lg' => 'max-h-[36rem]',
        'xl' => 'max-h-[72rem]',
        '1/3', '2/3', '1/4', '2/4', '3/4', '1/5', '2/5', '3/5', '4/5'  => 'max-h-full',
    };
?>
<div <?php echo e($attributes); ?>>
    <div class="flex-col">
        <div class="block font-medium text-sm text-gray-700 mt-6">
            <?php echo e($label); ?>

        </div>
        <img class="<?php echo e($widthClass); ?> <?php echo e($maxHeightClass); ?> aspect-auto"
             src="<?php echo e($imageUrl); ?>">
        <?php if(!$readonly): ?>
        <div class="<?php echo e($widthClass); ?> flex-col space-y-4 items-stretch mt-4">
            <div>
                <div class="flex flex-row items-center">
                    <input id="id_<?php echo e($name); ?>" name="<?php echo e($name); ?>" type="file"
                        accept="image/png, image/jpeg"
                        onchange="document.getElementById('id_<?php echo e($name); ?>_selected_file').innerHTML= document.getElementById('id_<?php echo e($name); ?>').files[0].name ?? ''"
                        class="hidden"/>
                        <label for="id_<?php echo e($name); ?>"
                            class="min-w-32
                            px-4 py-2 mr-2 inline-block border border-transparent
                            rounded-md
                            font-medium text-sm tracking-widest
                            focus:outline-none focus:ring-2
                            focus:ring-indigo-500
                            focus:ring-offset-2 transition ease-in-out duration-150
                            text-white
                            bg-gray-800
                            hover:bg-gray-900
                            focus:bg-gray-900
                            active:bg-gray-950
                            cursor-pointer"
                        >Choose file</label>
                        <label id="id_<?php echo e($name); ?>_selected_file"
                            class="text-sm text-slate-500 truncate"></label>
                    </div>
                <?php $__errorArgs = [ $name ];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="text-sm text-red-500">
                        <?php echo e($message); ?>

                    </div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <?php if($deleteAllow): ?>
            <div>
                <?php if (isset($component)) { $__componentOriginale67687e3e4e61f963b25a6bcf3983629 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale67687e3e4e61f963b25a6bcf3983629 = $attributes; } ?>
<?php $component = App\View\Components\Button::resolve(['element' => 'submit','text' => $deleteTitle,'type' => 'danger'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Button::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['form' => ''.e($deleteForm).'']); ?>
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
        <?php endif; ?>
    </div>
</div>
<?php /**PATH /var/www/html/resources/views/components/field/image.blade.php ENDPATH**/ ?>