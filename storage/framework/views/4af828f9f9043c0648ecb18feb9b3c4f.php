<?php if($selectable): ?>
    <?php if($selected): ?>
        <a class="px-3 py-4 border-b-2 border-b-indigo-400
                text-sm font-medium leading-5 inline-flex h-auto
                text-gray-900
                hover:text-gray-700
                hover:bg-gray-100
                focus:outline-none focus:border-indigo-700 "
            href="<?php echo e($href); ?>">
            <?php echo e($content); ?>

        </a>
    <?php else: ?>
        <a class="px-3 py-4 border-b-2 border-transparent
                text-sm font-medium leading-5 inline-flex h-auto
                text-gray-500
                hover:border-gray-300 
                hover:text-gray-700
                hover:bg-gray-100

                focus:outline-none focus:border-gray-300
                focus:text-gray-700 d"
            href="<?php echo e($href); ?>">
            <?php echo e($content); ?>

        </a>
    <?php endif; ?>
<?php else: ?>
    <a class="px-3 py-4 border-b-2 border-transparent
                text-sm font-medium leading-5 inline-flex h-auto
                text-gray-500
                hover:text-gray-700
                hover:bg-gray-100

                focus:outline-none
                focus:text-gray-700
                focus:bg-gray-100 "
            href="<?php echo e($href); ?>">
        <?php echo e($content); ?>

    </a>
<?php endif; ?>
<?php /**PATH /var/www/html/resources/views/components/menus/submenu-item.blade.php ENDPATH**/ ?>