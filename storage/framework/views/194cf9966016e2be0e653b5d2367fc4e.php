<?php $__env->startSection('header-title', 'Shopping Cart'); ?>

<?php $__env->startSection('main'); ?>


<header class="bg-white  shadow">
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <h2 class="font-semibold text-xl text-gray-800  leading-tight">
            <?php echo $__env->yieldContent('header-title'); ?>
        </h2>
    </div>
</header>

<div class="flex justify-center">
    <div class="my-4 p-6 bg-white  overflow-hidden shadow-sm sm:rounded-lg text-gray-900 ">
        <?php if(empty($cart)): ?>
            <h3 class="text-xl w-96 text-center">Cart is Empty</h3>
        <?php else: ?>
            <div class="grid grid-cols-1 gap-6 w-max-full">
                <?php $__currentLoopData = $cart; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                    $tmdbId = $item['custom'];
                    $movieData=[];
                    $movieData = Cache::remember("movie_{$tmdbId}", 3600, function () use ($tmdbId) {
                        return $this->tmdbService->getMovieByID($tmdbId);
                    });
                    $date = \Carbon\Carbon::parse($item['date'])->format('d-m-Y');
                    ?>
                    <div class="font-base text-sm text-gray-700  bg-white rounded-lg shadow-lg p-6 transition-transform transform hover:scale-105 flex flex-col justify-between relative">
                        <div>
                            <h5>Ticket for the movie:</h5>
                            <h3 class="text-xl font-bold text-gray-900 "><?php echo e($movieData['title']); ?></h3>
                            <p class="text-lg text-gray-700 ">
                                Theater: <strong><?php echo e($item['theater']); ?></strong>
                            </p>
                            <p class="text-lg text-gray-700 ">
                                Screening: <strong><?php echo e($date); ?> at <?php echo e($item['hora']); ?></strong>
                            </p>
                            <p class="text-lg text-gray-700 ">
                                Seat: <strong><?php echo e($item['seatId']); ?></strong>
                            </p>
                            <p class="text-lg text-gray-700 ">
                                Price: <strong><?php echo e($item['price']); ?> €</strong>
                            </p>
                        </div>
                        <div class="mt-4 flex justify-end">
                            <form action="<?php echo e(route('cart.remove', ['seatId' => $item['seatId'], 'screeningId' => $item['screeningId']])); ?>" method="POST">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <?php if (isset($component)) { $__componentOriginale67687e3e4e61f963b25a6bcf3983629 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale67687e3e4e61f963b25a6bcf3983629 = $attributes; } ?>
<?php $component = App\View\Components\Button::resolve(['element' => 'submit','type' => 'danger','text' => 'Remove'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Button::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'mt-2']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale67687e3e4e61f963b25a6bcf3983629)): ?>
<?php $attributes = $__attributesOriginale67687e3e4e61f963b25a6bcf3983629; ?>
<?php unset($__attributesOriginale67687e3e4e61f963b25a6bcf3983629); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale67687e3e4e61f963b25a6bcf3983629)): ?>
<?php $component = $__componentOriginale67687e3e4e61f963b25a6bcf3983629; ?>
<?php unset($__componentOriginale67687e3e4e61f963b25a6bcf3983629); ?>
<?php endif; ?>
                            </form>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            <div class="mt-12 flex justify-between space-x-12 items-end">
                <div>
                    <h3 class="mb-4 text-xl">Shopping Cart Confirmation</h3>
                    <form action="<?php echo e(route('cart.form')); ?>" method="get">
                        <?php echo csrf_field(); ?>
                        <?php if (isset($component)) { $__componentOriginale67687e3e4e61f963b25a6bcf3983629 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale67687e3e4e61f963b25a6bcf3983629 = $attributes; } ?>
<?php $component = App\View\Components\Button::resolve(['element' => 'submit','type' => 'dark','text' => 'Confirm'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Button::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'mt-4']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale67687e3e4e61f963b25a6bcf3983629)): ?>
<?php $attributes = $__attributesOriginale67687e3e4e61f963b25a6bcf3983629; ?>
<?php unset($__attributesOriginale67687e3e4e61f963b25a6bcf3983629); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale67687e3e4e61f963b25a6bcf3983629)): ?>
<?php $component = $__componentOriginale67687e3e4e61f963b25a6bcf3983629; ?>
<?php unset($__componentOriginale67687e3e4e61f963b25a6bcf3983629); ?>
<?php endif; ?>
                    </form>
                </div>
                <div>
                    <form action="<?php echo e(route('cart.destroy')); ?>" method="post">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <?php if (isset($component)) { $__componentOriginale67687e3e4e61f963b25a6bcf3983629 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale67687e3e4e61f963b25a6bcf3983629 = $attributes; } ?>
<?php $component = App\View\Components\Button::resolve(['element' => 'submit','type' => 'danger','text' => 'Clear Cart'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Button::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'mt-4']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale67687e3e4e61f963b25a6bcf3983629)): ?>
<?php $attributes = $__attributesOriginale67687e3e4e61f963b25a6bcf3983629; ?>
<?php unset($__attributesOriginale67687e3e4e61f963b25a6bcf3983629); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale67687e3e4e61f963b25a6bcf3983629)): ?>
<?php $component = $__componentOriginale67687e3e4e61f963b25a6bcf3983629; ?>
<?php unset($__componentOriginale67687e3e4e61f963b25a6bcf3983629); ?>
<?php endif; ?>
                    </form>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/cart/show.blade.php ENDPATH**/ ?>