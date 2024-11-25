
<?php
    $colors = match($type) {
        'primary' => 'text-white
                        bg-blue-600
                        hover:bg-blue-700
                        focus:bg-blue-700
                        active:bg-blue-800',
        'secondary' => 'text-white
                        bg-gray-500
                        hover:bg-gray-600
                        focus:bg-gray-600
                        active:bg-gray-700 ',
        'success' => 'text-white
                        bg-green-700
                        hover:bg-green-800
                        focus:bg-green-800
                        active:bg-green-900',
        'danger' => 'text-white
                        bg-red-600
                        hover:bg-red-700
                        focus:bg-red-700
                        active:bg-red-800 ',
        'warning' => 'text-gray-900
                        bg-amber-400
                        hover:bg-amber-300
                        focus:bg-amber-300
                        active:bg-amber-300',
        'info' => 'text-gray-900
                        bg-cyan-400
                        hover:bg-cyan-300
                        focus:bg-cyan-300
                        active:bg-cyan-300 ',
        'light' => 'text-gray-900
                        bg-slate-50
                        hover:bg-slate-200
                        focus:bg-slate-200
                        active:bg-slate-200 ',
        'link' => 'text-blue-500
                        border-gray-200',
        default => 'text-white
                        bg-gray-800
                        hover:bg-gray-900
                        focus:bg-gray-900
                        active:bg-gray-950',
    }
?>
<div <?php echo e($attributes); ?>>
    <?php if($element == 'a'): ?>
        <a href="<?php echo e($href); ?>"
            class="px-4 py-2 inline-block border border-transparent rounded-md
                    font-medium text-sm tracking-widest
                    focus:outline-none focus:ring-2
                    focus:ring-indigo-500
                    focus:ring-offset-2 transition ease-in-out duration-150 <?php echo e($colors); ?>">
            <?php echo e($text); ?>

        </a>
    <?php else: ?>
        <button type="<?php echo e($element); ?>" <?php echo e($buttonName ? "name='$buttonName'" : ''); ?>

            class="px-4 py-2 inline-block border border-transparent rounded-md
                    font-medium text-sm tracking-widest
                    focus:outline-none focus:ring-2
                    focus:ring-indigo-500
                    focus:ring-offset-2 transition ease-in-out duration-150 <?php echo e($colors); ?>">
            <?php echo e($text); ?>

        </button>
    <?php endif; ?>
</div>
<?php /**PATH C:\laragon\www\projeto\resources\views/components/button.blade.php ENDPATH**/ ?>