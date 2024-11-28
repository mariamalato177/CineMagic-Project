<?php $__env->startSection('header-title', 'Customers'); ?>

<?php $__env->startSection('main'); ?>
    <header class="bg-white  shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <h2 class="font-semibold text-xl text-gray-800  leading-tight">
                <?php echo $__env->yieldContent('header-title'); ?>
            </h2>
        </div>
    </header>
    <div class="flex justify-center">
        <div class="my-4 p-6 bg-white overflow-hidden shadow-sm sm:rounded-lg text-gray-900 w-full max-w-[90%] mx-auto">
            <div class="container mx-auto px-4 pt-2">
                <?php if (isset($component)) { $__componentOriginalb596d52210e8ba4ef98a5af9cfe1fc78 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalb596d52210e8ba4ef98a5af9cfe1fc78 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.users.filter-card','data' => ['filterAction' => route('users.list'),'resetUrl' => route('users.list'),'searchName' => old('string', $filterByName),'class' => 'mb-6']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('users.filter-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['filterAction' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('users.list')),'resetUrl' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('users.list')),'searchName' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(old('string', $filterByName)),'class' => 'mb-6']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalb596d52210e8ba4ef98a5af9cfe1fc78)): ?>
<?php $attributes = $__attributesOriginalb596d52210e8ba4ef98a5af9cfe1fc78; ?>
<?php unset($__attributesOriginalb596d52210e8ba4ef98a5af9cfe1fc78); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalb596d52210e8ba4ef98a5af9cfe1fc78)): ?>
<?php $component = $__componentOriginalb596d52210e8ba4ef98a5af9cfe1fc78; ?>
<?php unset($__componentOriginalb596d52210e8ba4ef98a5af9cfe1fc78); ?>
<?php endif; ?>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 xl:grid-cols-5 gap-8 mt-8">
                    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="bg-white rounded-lg overflow-hidden shadow-lg flex flex-col">
                            <div class="aspect-w-16 aspect-h-9">
                                <img src="<?php echo e($user->photoFullUrl ? $user->photoFullUrl : asset('storage/app/public/photos/anonymous.jpg')); ?>"
                                    class="w-full h-full object-cover" alt="<?php echo e($user->name); ?>">
                            </div>
                            <div class="flex flex-col justify-between flex-grow p-4">
                                <div>
                                    <p class="text-white text-lg font-semibold"><?php echo e($user->name); ?></p>
                                    <p class="text-gray-400"><?php echo e($user->email); ?></p>
                                </div>
                                <div>
                                    <p class="text-orange-200 font-bold mt-2.5">Customer</p>
                                    <div class="flex justify-between font-bold">
                                        <?php if(!$user->isBlocked($user->id)): ?>
                                            <form method="POST" action="<?php echo e(route('users.block', ['user' => $user->id])); ?>"
                                                onsubmit="return confirm('Are you sure you want to block this user?')"
                                                class="inline-block">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('PATCH'); ?>
                                                <?php if (isset($component)) { $__componentOriginale67687e3e4e61f963b25a6bcf3983629 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale67687e3e4e61f963b25a6bcf3983629 = $attributes; } ?>
<?php $component = App\View\Components\Button::resolve(['element' => 'submit','type' => 'danger','text' => 'Block'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Button::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
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
                                        <?php else: ?>
                                            <form method="POST"
                                                action="<?php echo e(route('users.unblock', ['user' => $user->id])); ?>"
                                                onsubmit="return confirm('Are you sure you want to unblock this user?')"
                                                class="inline-block">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('PATCH'); ?>
                                                <?php if (isset($component)) { $__componentOriginale67687e3e4e61f963b25a6bcf3983629 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale67687e3e4e61f963b25a6bcf3983629 = $attributes; } ?>
<?php $component = App\View\Components\Button::resolve(['element' => 'submit','type' => 'success','text' => 'Unblock'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Button::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
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
                                        <?php endif; ?>
                                        <form method="POST" action="<?php echo e(route('users.destroy', ['user' => $user->id])); ?>"
                                            onsubmit="return confirm('Are you sure you want to delete this user?')"
                                            class="inline-block">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('delete'); ?>
                                            <?php if (isset($component)) { $__componentOriginale67687e3e4e61f963b25a6bcf3983629 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale67687e3e4e61f963b25a6bcf3983629 = $attributes; } ?>
<?php $component = App\View\Components\Button::resolve(['element' => 'submit','type' => 'danger','text' => 'Delete'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Button::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
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
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <div class="mt-8 flex justify-center">
                    <?php echo e($users->links()); ?>

                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/users/list.blade.php ENDPATH**/ ?>