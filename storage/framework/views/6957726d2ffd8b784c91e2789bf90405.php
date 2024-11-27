<?php
/** @var array|\Illuminate\Support\Collection $entries */
?>

<!-- START of Laravel Telescope Toolbar -->
<div id="sfMiniToolbar-<?php echo e($token); ?>" class="sf-minitoolbar" data-no-turbolink data-turbo="false">
    <button type="button" title="Show Telescope toolbar" tabindex="-1" id="sfToolbarMiniToggler-<?php echo e($token); ?>" accesskey="D" aria-expanded="false" aria-controls="sfToolbarMainContent-<?php echo e($token); ?>">
        <?php echo file_get_contents('C:\laragon\www\projeto\vendor\fruitcake\laravel-telescope-toolbar\resources\icons/' . basename('laravel') . '.svg'); ?>
    </button>
</div>
<div id="sfToolbarClearer-<?php echo e($token); ?>" class="sf-toolbar-clearer"></div>

<div id="sfToolbarMainContent-<?php echo e($token); ?>" class="sf-toolbarreset notranslate clear-fix" data-no-turbolink>

    <?php $__currentLoopData = config('telescope-toolbar.collectors'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type => $templates): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php if(isset($entries[$type])): ?>
            <?php $__currentLoopData = $templates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $template): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php echo $__env->make($template, ['entries' => $entries[$type]], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    <?php echo $__env->make("telescope-toolbar::collectors.config", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make("telescope-toolbar::collectors.ajax", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <button class="hide-button" type="button" id="sfToolbarHideButton-<?php echo e($token); ?>" title="Close Toolbar" tabindex="-1" accesskey="D" aria-expanded="true" aria-controls="sfToolbarMainContent-<?php echo e($token); ?>">
        <?php echo file_get_contents('C:\laragon\www\projeto\vendor\fruitcake\laravel-telescope-toolbar\resources\icons/' . basename('close') . '.svg'); ?>
    </button>
</div>
<!-- END of Laravel Telescope Toolbar -->
<?php /**PATH C:\laragon\www\projeto\vendor\fruitcake\laravel-telescope-toolbar\src/../resources/views/toolbar.blade.php ENDPATH**/ ?>