<div <?php echo e($attributes->merge(['class' => 'flex me-0 sm:me-1 lg:me-2'])); ?>>
    <?php if($selectable): ?>
        <?php if($selected): ?>
            <a class="grow inline-flex items-center h-16 px-3 sm:px-0.5 md:px-1 lg:px-2 pt-1
                    text-sm font-medium text-gray-900 dark:text-gray-50
                    border-b-2 border-coral dark:border-coral
                    focus:outline-none focus:border-coral dark:focus:border-coral"
                href="<?php echo e($href); ?>">
                <?php echo e($content); ?>

            </a>
        <?php else: ?>
            <a class="grow inline-flex items-center h-16 px-3 sm:px-0.5 md:px-1 lg:px-2 pt-1
                    text-sm font-medium text-gray-500 dark:text-gray-400
                    border-b-2 border-transparent
                    hover:border-gray-300 dark:hover:border-gray-700 hover:text-gray-700 dark:hover:text-gray-300
                    focus:outline-none focus:border-gray-300 dark:focus:border-gray-700 focus:text-gray-700 dark:focus:text-gray-300
                    hover:bg-gray-100 dark:hover:bg-gray-800 sm:hover:bg-white dark:sm:hover:bg-gray-900"
                href="<?php echo e($href); ?>">
                <?php echo e($content); ?>

            </a>
        <?php endif; ?>
    <?php else: ?>
        <a class="grow inline-flex items-center h-16 px-3 sm:px-0.5 md:px-1 lg:px-2 pt-1
                text-sm font-medium text-gray-500 dark:text-gray-400
                border-b-2 border-transparent
                hover:text-gray-700 dark:hover:text-gray-300
                focus:outline-none  focus:text-gray-700 dark:focus:text-gray-300
                hover:bg-gray-100 dark:hover:bg-gray-800 sm:hover:bg-white dark:sm:hover:bg-gray-900"
            href="<?php echo e($href); ?>">
            <?php echo e($content); ?>

        </a>
    <?php endif; ?>
</div>
<?php /**PATH /var/www/html/resources/views/components/menus/menu-item.blade.php ENDPATH**/ ?>