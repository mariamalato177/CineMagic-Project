<?php $__env->startSection('header-title','Tickets'); ?>

<?php $__env->startSection('main'); ?>
<div class="flex flex-col space-y-6">
    <div class="p-4 sm:p-8 bg-white  shadow sm:rounded-lg">
        <div class="max-full">
            <section>
                <div class="mt-6 space-y-4">
                    <div class="font-base text-sm text-gray-700 ">
                        <?php if (isset($component)) { $__componentOriginal8c4d23aba4742161db6e8b774681cd6d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal8c4d23aba4742161db6e8b774681cd6d = $attributes; } ?>
<?php $component = App\View\Components\Tickets\Table::resolve(['tickets' => $tickets,'showRemoveFromCart' => true] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('tickets.table'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Tickets\Table::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal8c4d23aba4742161db6e8b774681cd6d)): ?>
<?php $attributes = $__attributesOriginal8c4d23aba4742161db6e8b774681cd6d; ?>
<?php unset($__attributesOriginal8c4d23aba4742161db6e8b774681cd6d); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8c4d23aba4742161db6e8b774681cd6d)): ?>
<?php $component = $__componentOriginal8c4d23aba4742161db6e8b774681cd6d; ?>
<?php unset($__componentOriginal8c4d23aba4742161db6e8b774681cd6d); ?>
<?php endif; ?>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/tickets/show.blade.php ENDPATH**/ ?>