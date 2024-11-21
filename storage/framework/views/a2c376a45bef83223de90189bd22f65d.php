<?php
    $mode = $mode ?? 'edit';
    $readonly = $mode == 'show';
    $theaters = App\Models\Theater::all();
?>
<h2>
    <?php echo e($mode == 'create' ? 'Create new screening for movie' : "Edit Screening of the movie \"{$screening->movieRef->title}\" at {$screening->theaterRef->name} on {$screening->date} {$screening->start_time}"); ?>

</h2>

<div>
    <label for="movie_id">Movie</label>
    <select name="movie_id" required>
        <?php $__currentLoopData = $movies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $movie): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($movie['id']); ?>"><?php echo e($movie['title']); ?></option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>
</div>

<div>
    <label for="theater_id">Theater</label>
    <select name="theater_id" required>
        <?php $__currentLoopData = $theaters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $theater): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($theater->id); ?>"><?php echo e($theater->name); ?></option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>
</div>

<?php if (isset($component)) { $__componentOriginalaa9a38aef93e85a18918afab9e501651 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalaa9a38aef93e85a18918afab9e501651 = $attributes; } ?>
<?php $component = App\View\Components\Field\Input::resolve(['name' => 'custom','label' => 'Custom','width' => 'md','readonly' => $readonly,'value' => ''.e(old('custom', $screening->custom)).''] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('field.input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Field\Input::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalaa9a38aef93e85a18918afab9e501651)): ?>
<?php $attributes = $__attributesOriginalaa9a38aef93e85a18918afab9e501651; ?>
<?php unset($__attributesOriginalaa9a38aef93e85a18918afab9e501651); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalaa9a38aef93e85a18918afab9e501651)): ?>
<?php $component = $__componentOriginalaa9a38aef93e85a18918afab9e501651; ?>
<?php unset($__componentOriginalaa9a38aef93e85a18918afab9e501651); ?>
<?php endif; ?>
<?php /**PATH /var/www/html/resources/views/screenings/shared/fields.blade.php ENDPATH**/ ?>