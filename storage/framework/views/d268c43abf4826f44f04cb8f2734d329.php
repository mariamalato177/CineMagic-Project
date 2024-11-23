<div <?php echo e($attributes->merge(['class' => 'relative group flex flex-col me-0 sm:me-1 lg:me-2'])); ?>>
    <?php if($selectable): ?>
        <?php if($selected): ?>
            <button data-submenu="<?php echo e($uniqueName); ?>"
            class="grow inline-flex items-center h-16
                 px-3 sm:px-0.5 md:px-1 lg:px-2 pt-1
                text-sm font-medium text-gray-500
                border-b-2 border-transparent hover:text-gray-700
                focus:outline-none focus:text-gray-700
                hover:bg-gray-100  sm:hover:bg-white ">
        <?php else: ?>
            <button data-submenu="<?php echo e($uniqueName); ?>"
            class="grow inline-flex items-center h-16
                 px-3 sm:px-0.5 md:px-1 lg:px-2 pt-1
                text-sm font-medium text-gray-500
                border-b-2 border-transparent hover:text-gray-700
                focus:outline-none focus:text-gray-700
                hover:bg-gray-100  sm:hover:bg-white ">
        <?php endif; ?>
    <?php else: ?>
        <button data-submenu="<?php echo e($uniqueName); ?>"
            class="grow inline-flex items-center h-16
                px-3 sm:px-0.5 md:px-1 lg:px-2 pt-1
                text-sm font-medium text-gray-500
                border-b-2 border-transparent hover:text-gray-700
                focus:outline-none focus:text-gray-700
                hover:bg-gray-100  sm:hover:bg-white ">
    <?php endif; ?>
            <?php echo e($content); ?>

            <div>
                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                        clip-rule="evenodd" />
                </svg>
            </div>
        </button>
    <div id="<?php echo e($uniqueName); ?>" class="sm:absolute sm:-right-2 sm:top-14 sm:origin-bottom-right
                w-full sm:w-48 bg-white
                grid grid-cols-1
                sm:rounded-md sm:ring-1 sm:ring-black sm:ring-opacity-5 sm:shadow-lg
                h-0 sm:h-auto
                invisible sm:invisible sm:group-hover:visible
                ps-6 sm:ps-0">
        <?php echo e($slot); ?>

    </div>
</div>
<?php /**PATH C:\laragon\www\projeto\resources\views/components/menus/submenu.blade.php ENDPATH**/ ?>