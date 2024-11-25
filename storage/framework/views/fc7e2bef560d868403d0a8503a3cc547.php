
<?php
    $widthClass = match ($width) {
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
?>
<div <?php echo e($attributes->merge(['class' => "$widthClass"])); ?>>
    <label class="block font-medium text-sm text-gray-700" for="id_<?php echo e($name); ?>">
        <?php echo e($label); ?>

    </label>
    <input id="id_<?php echo e($name); ?>" name="<?php echo e($name); ?>" type="<?php echo e($type); ?>" value="<?php echo e($value); ?>"
        class="appearance-none block
            mt-1 w-full
            bg-white
            text-black
            <?php $__errorArgs = [$name];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                border-red-500
            <?php else: ?>
                border-gray-300
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            focus:border-indigo-500
            focus:ring-indigo-500 
            rounded-md shadow-sm
            disabled:rounded-none disabled:shadow-none
            disabled:border-t-transparent disabled:border-x-transparent
            disabled:border-dashed
            disabled:opacity-100
            disabled:select-none"
        <?php if($required): echo 'required'; endif; ?> <?php if($readonly): echo 'disabled'; endif; ?> autofocus="autofocus">
    <?php $__errorArgs = [$name];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
        <div class="text-sm text-red-500"> <?php echo e($message); ?> </div>
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
</div>
<?php /**PATH C:\laragon\www\projeto\resources\views/components/field/input.blade.php ENDPATH**/ ?>