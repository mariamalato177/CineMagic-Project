<?php
/**
 * @var \Illuminate\Support\Collection|\Laravel\Telescope\EntryResult[] $entries
 */


?>
<?php $__env->startComponent('telescope-toolbar::item', ['name' => 'dump', 'link' => route('telescope') . '/dumps', 'status' => 'yellow']); ?>

    <?php $__env->slot('icon'); ?>
        <?php echo file_get_contents('C:\laragon\www\projeto\vendor\fruitcake\laravel-telescope-toolbar\resources\icons/' . basename('dumps') . '.svg'); ?>

        <span class="sf-toolbar-value"><?php echo e($entries->count()); ?></span>

    <?php $__env->endSlot(); ?>

    <?php $__env->slot("text"); ?>

        <?php $__currentLoopData = $entries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $entry): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="sf-toolbar-info-piece">
                <div class="sf-toolbar-dump">
                    <?php echo $entry->content['dump']; ?>

                </div>

            </div>

        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    <?php $__env->endSlot(); ?>

<?php echo $__env->renderComponent(); ?><?php /**PATH C:\laragon\www\projeto\vendor\fruitcake\laravel-telescope-toolbar\src/../resources/views/collectors/dumps.blade.php ENDPATH**/ ?>