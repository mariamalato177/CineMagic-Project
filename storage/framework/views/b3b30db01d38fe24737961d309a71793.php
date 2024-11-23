<div <?php echo e($attributes->merge(['class' => 'flex me-0 sm:me-1 lg:me-2'])); ?>>
    <?php if($selectable): ?>
        <?php if($selected): ?>
            <a class="grow inline-flex items-center h-16 px-3 sm:px-0.5 md:px-1 lg:px-2 pt-1
                    text-sm font-medium text-gray-900
                    border-b-2 border-coral
                    focus:outline-none focus:border-coral "
                href="<?php echo e($href); ?>">
                <?php echo e($content); ?>

            </a>
        <?php else: ?>
            <a class="grow inline-flex items-center h-16 px-3 sm:px-0.5 md:px-1 lg:px-2 pt-1
                    text-sm font-medium text-gray-500
                    border-b-2 border-transparent
                    hover:border-gray-300  hover:text-gray-700
                    focus:outline-none focus:border-gray-300  focus:text-gray-700
                    hover:bg-gray-100  sm:hover:bg-white 0"
                href="<?php echo e($href); ?>">
                <?php echo e($content); ?>

            </a>
        <?php endif; ?>
    <?php else: ?>
        <a class="grow inline-flex items-center h-16 px-3 sm:px-0.5 md:px-1 lg:px-2 pt-1
                text-sm font-medium text-gray-500
                border-b-2 border-transparent
                hover:text-gray-700
                focus:outline-none  focus:text-gray-700
                hover:bg-gray-100  sm:hover:bg-white "
            href="<?php echo e($href); ?>">
            <?php echo e($content); ?>

        </a>
    <?php endif; ?>
</div>
<?php /**PATH C:\laragon\www\projeto\resources\views/components/menus/menu-item.blade.php ENDPATH**/ ?>