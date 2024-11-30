<?php if (isset($component)) { $__componentOriginal8ffb92400f9024f5b5068d82c70e677b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal8ffb92400f9024f5b5068d82c70e677b = $attributes; } ?>
<?php $component = App\View\Components\Menus\MenuItem::resolve(['href' => ''.e($href).'','selectable' => ''.e($selectable).'','selected' => ''.e($selected).''] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('menus.menu-item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Menus\MenuItem::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
     <?php $__env->slot('content', null, []); ?> 
        <div class="z-20 me-1 inline-flex items-center bg-transparent justify-center">
            <div class="relative inline-flex items-center">
                <div class="-top-3 absolute left-3">
                    <?php if($total > 0): ?>
                        <p class="flex p-3 h-2 w-2 items-center justify-center rounded-full bg-red-500 text-xs text-white"><?php echo e($total); ?></p>
                    <?php endif; ?>
                </div>
                <svg  class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                </svg>
                <div class="block sm:hidden ms-3">
                    <p>Cart</p>
                </div>
            </div>
        </div>
     <?php $__env->endSlot(); ?>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal8ffb92400f9024f5b5068d82c70e677b)): ?>
<?php $attributes = $__attributesOriginal8ffb92400f9024f5b5068d82c70e677b; ?>
<?php unset($__attributesOriginal8ffb92400f9024f5b5068d82c70e677b); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8ffb92400f9024f5b5068d82c70e677b)): ?>
<?php $component = $__componentOriginal8ffb92400f9024f5b5068d82c70e677b; ?>
<?php unset($__componentOriginal8ffb92400f9024f5b5068d82c70e677b); ?>
<?php endif; ?>
<?php /**PATH /var/www/html/resources/views/components/menus/cart.blade.php ENDPATH**/ ?>