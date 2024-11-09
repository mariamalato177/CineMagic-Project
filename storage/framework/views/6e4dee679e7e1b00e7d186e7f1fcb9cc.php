<div class="sf-toolbar-block sf-toolbar-block-<?php echo e($name); ?> sf-toolbar-status-<?php echo e($status ?? 'normal'); ?> <?php echo e($additional_classes ?? ''); ?>" <?php echo $block_attrs ?? ''; ?>>
    <?php if(isset($link) && $link): ?>
        <?php
            $ttLink = route('telescope-toolbar.show', ['token' => $token, 'tab' => $name]);
            if ($link === true) {
                $link = $ttLink;
            } elseif (\Illuminate\Support\Str::startsWith($link, '#')) {
                $link = $ttLink . $link;
            }
        ?>
        <a href="<?php echo e($link); ?>">
    <?php endif; ?>
        <div class="sf-toolbar-icon"><?php echo e($icon ?? ''); ?></div>
        <?php if(isset($link) && $link): ?></a><?php endif; ?>
    <div class="sf-toolbar-info"><?php echo e($text ?? ''); ?></div>
</div>
<?php /**PATH C:\laragon\www\projeto\vendor\fruitcake\laravel-telescope-toolbar\src/../resources/views/item.blade.php ENDPATH**/ ?>