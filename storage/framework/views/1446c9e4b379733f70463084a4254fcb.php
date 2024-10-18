<?php $__env->startComponent('telescope-toolbar::item', ['name' => 'ajax', 'additional_classes' => 'sf-toolbar-block-right']); ?>

    <?php $__env->slot('icon'); ?>

        <?php echo file_get_contents('/var/www/html/vendor/fruitcake/laravel-telescope-toolbar/resources/icons/' . basename('ajax') . '.svg'); ?>

        <span class="sf-toolbar-value sf-toolbar-ajax-request-counter">0</span>

    <?php $__env->endSlot(); ?>

    <?php $__env->slot("text"); ?>
        <div class="sf-toolbar-info-piece">
                <span class="sf-toolbar-header">
                    <b class="sf-toolbar-ajax-info"></b>
                    <b class="sf-toolbar-action">(<a class="sf-toolbar-ajax-clear" href="javascript:void(0);">Clear</a>)</b>
                </span>
        </div>
        <div class="sf-toolbar-info-piece">
            <table class="sf-toolbar-ajax-requests">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Profile</th>
                    <th>Method</th>
                    <th>Type</th>
                    <th>Status</th>
                    <th>URL</th>
                    <th>Time</th>
                </tr>
                </thead>
                <tbody class="sf-toolbar-ajax-request-list"></tbody>
            </table>
        </div>

    <?php $__env->endSlot(); ?>
<?php echo $__env->renderComponent(); ?>
<?php /**PATH /var/www/html/vendor/fruitcake/laravel-telescope-toolbar/src/../resources/views/collectors/ajax.blade.php ENDPATH**/ ?>