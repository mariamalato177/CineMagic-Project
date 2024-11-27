<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>CineMagic</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts AND CSS Fields -->
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-cover bg-center bg-gray-200">

        <!-- Navigation Menu -->
        <nav class="bg-white border-b border-coral-100 ">
            <!-- Navigation Menu Full Container -->
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <!-- Logo + Menu Items + Hamburger -->
                <div class="flex flex-col sm:flex-row justify-between items-center px-6 sm:px-0">
                    <!-- Logo -->
                    <div class="shrink-0 -ms-4">
                        <a href="<?php echo e(route('home')); ?>">
                            <div
                                class="h-20 w-40 bg-cover bg-[url('../img/logotipo.png')] ">
                            </div>
                        </a>
                    </div>

                    <!-- Menu Items -->
                    <div id="menu-container" class="flex flex-col sm:flex-row items-center space-x-4">
                        <!-- Menu Item: movies -->
                        <?php if (isset($component)) { $__componentOriginal8ffb92400f9024f5b5068d82c70e677b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal8ffb92400f9024f5b5068d82c70e677b = $attributes; } ?>
<?php $component = App\View\Components\Menus\MenuItem::resolve(['content' => 'Movies','href' => ''.e(route('movies.index')).'','selected' => ''.e(Route::currentRouteName() == 'movies.index').''] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('menus.menu-item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Menus\MenuItem::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
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

                        <!-- Menu Item: Screenings -->
                        <?php if (isset($component)) { $__componentOriginal8ffb92400f9024f5b5068d82c70e677b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal8ffb92400f9024f5b5068d82c70e677b = $attributes; } ?>
<?php $component = App\View\Components\Menus\MenuItem::resolve(['content' => 'Screenings','href' => ''.e(route('screenings.index')).'','selected' => ''.e(Route::currentRouteName() == 'screenings.index').''] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('menus.menu-item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Menus\MenuItem::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
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


                        <!-- Menu Item: Theaters -->
                        <?php if (isset($component)) { $__componentOriginal8ffb92400f9024f5b5068d82c70e677b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal8ffb92400f9024f5b5068d82c70e677b = $attributes; } ?>
<?php $component = App\View\Components\Menus\MenuItem::resolve(['content' => 'Theaters','href' => ''.e(route('theaters.index')).'','selected' => ''.e(Route::currentRouteName() == 'theaters.index').''] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('menus.menu-item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Menus\MenuItem::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
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

                        <?php if(auth()->guard()->check()): ?>
                            <?php if(Auth::user()->type == 'A'): ?>

                                 <!-- Menu Item: Genre -->

                                 <?php if (isset($component)) { $__componentOriginal8ffb92400f9024f5b5068d82c70e677b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal8ffb92400f9024f5b5068d82c70e677b = $attributes; } ?>
<?php $component = App\View\Components\Menus\MenuItem::resolve(['content' => 'Genres','href' => ''.e(route('genres.index')).'','selected' => ''.e(Route::currentRouteName() == 'genres.index').''] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('menus.menu-item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Menus\MenuItem::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
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

                                <!-- Menu Item: Others -->

                                <?php if (isset($component)) { $__componentOriginald48d1fca4b82eb6803dff45474879693 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald48d1fca4b82eb6803dff45474879693 = $attributes; } ?>
<?php $component = App\View\Components\Menus\Submenu::resolve(['selectable' => '0','uniqueName' => 'submenu_others','content' => 'More'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('menus.submenu'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Menus\Submenu::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'relative submenu']); ?>

                                    <!-- Menu Item: Statistics -->
                                    <?php if (isset($component)) { $__componentOriginal6da5cb2d4a2d725fd99275e89be1cb5e = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal6da5cb2d4a2d725fd99275e89be1cb5e = $attributes; } ?>
<?php $component = App\View\Components\Menus\SubmenuItem::resolve(['content' => 'Statistics','href' => ''.e(route('reports.index')).'','selectable' => '0'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('menus.submenu-item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Menus\SubmenuItem::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal6da5cb2d4a2d725fd99275e89be1cb5e)): ?>
<?php $attributes = $__attributesOriginal6da5cb2d4a2d725fd99275e89be1cb5e; ?>
<?php unset($__attributesOriginal6da5cb2d4a2d725fd99275e89be1cb5e); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal6da5cb2d4a2d725fd99275e89be1cb5e)): ?>
<?php $component = $__componentOriginal6da5cb2d4a2d725fd99275e89be1cb5e; ?>
<?php unset($__componentOriginal6da5cb2d4a2d725fd99275e89be1cb5e); ?>
<?php endif; ?>

                                    <!-- Menu Item: Purchases -->
                                    <?php if (isset($component)) { $__componentOriginal6da5cb2d4a2d725fd99275e89be1cb5e = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal6da5cb2d4a2d725fd99275e89be1cb5e = $attributes; } ?>
<?php $component = App\View\Components\Menus\SubmenuItem::resolve(['content' => 'Purchases','href' => ''.e(route('purchases.index')).'','selectable' => '0'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('menus.submenu-item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Menus\SubmenuItem::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal6da5cb2d4a2d725fd99275e89be1cb5e)): ?>
<?php $attributes = $__attributesOriginal6da5cb2d4a2d725fd99275e89be1cb5e; ?>
<?php unset($__attributesOriginal6da5cb2d4a2d725fd99275e89be1cb5e); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal6da5cb2d4a2d725fd99275e89be1cb5e)): ?>
<?php $component = $__componentOriginal6da5cb2d4a2d725fd99275e89be1cb5e; ?>
<?php unset($__componentOriginal6da5cb2d4a2d725fd99275e89be1cb5e); ?>
<?php endif; ?>

                                    <!-- Menu Item: Users -->
                                    <?php if (isset($component)) { $__componentOriginal6da5cb2d4a2d725fd99275e89be1cb5e = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal6da5cb2d4a2d725fd99275e89be1cb5e = $attributes; } ?>
<?php $component = App\View\Components\Menus\SubmenuItem::resolve(['content' => 'Customers','selectable' => '0','href' => ''.e(route('users.list')).''] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('menus.submenu-item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Menus\SubmenuItem::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal6da5cb2d4a2d725fd99275e89be1cb5e)): ?>
<?php $attributes = $__attributesOriginal6da5cb2d4a2d725fd99275e89be1cb5e; ?>
<?php unset($__attributesOriginal6da5cb2d4a2d725fd99275e89be1cb5e); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal6da5cb2d4a2d725fd99275e89be1cb5e)): ?>
<?php $component = $__componentOriginal6da5cb2d4a2d725fd99275e89be1cb5e; ?>
<?php unset($__componentOriginal6da5cb2d4a2d725fd99275e89be1cb5e); ?>
<?php endif; ?>
                                    <!-- Menu Item: Users -->
                                    <?php if (isset($component)) { $__componentOriginal6da5cb2d4a2d725fd99275e89be1cb5e = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal6da5cb2d4a2d725fd99275e89be1cb5e = $attributes; } ?>
<?php $component = App\View\Components\Menus\SubmenuItem::resolve(['content' => 'Employees and Admins','href' => ''.e(route('users.index')).''] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('menus.submenu-item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Menus\SubmenuItem::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal6da5cb2d4a2d725fd99275e89be1cb5e)): ?>
<?php $attributes = $__attributesOriginal6da5cb2d4a2d725fd99275e89be1cb5e; ?>
<?php unset($__attributesOriginal6da5cb2d4a2d725fd99275e89be1cb5e); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal6da5cb2d4a2d725fd99275e89be1cb5e)): ?>
<?php $component = $__componentOriginal6da5cb2d4a2d725fd99275e89be1cb5e; ?>
<?php unset($__componentOriginal6da5cb2d4a2d725fd99275e89be1cb5e); ?>
<?php endif; ?>

                                    <hr>

                                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald48d1fca4b82eb6803dff45474879693)): ?>
<?php $attributes = $__attributesOriginald48d1fca4b82eb6803dff45474879693; ?>
<?php unset($__attributesOriginald48d1fca4b82eb6803dff45474879693); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald48d1fca4b82eb6803dff45474879693)): ?>
<?php $component = $__componentOriginald48d1fca4b82eb6803dff45474879693; ?>
<?php unset($__componentOriginald48d1fca4b82eb6803dff45474879693); ?>
<?php endif; ?>
                            <?php endif; ?>
                        <?php endif; ?>


                        <div class="flex-grow"></div>

                        <!-- Menu Item: Cart -->
                        <?php if(session('cart')): ?>
                            <?php if (isset($component)) { $__componentOriginal5401d14b5c1eb7c80a3bbf767dfa897b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5401d14b5c1eb7c80a3bbf767dfa897b = $attributes; } ?>
<?php $component = App\View\Components\Menus\Cart::resolve(['href' => route('cart.show'),'selectable' => '1','selected' => ''.e(Route::currentRouteName() == 'cart.show').'','total' => count(session('cart'))] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('menus.cart'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Menus\Cart::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal5401d14b5c1eb7c80a3bbf767dfa897b)): ?>
<?php $attributes = $__attributesOriginal5401d14b5c1eb7c80a3bbf767dfa897b; ?>
<?php unset($__attributesOriginal5401d14b5c1eb7c80a3bbf767dfa897b); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal5401d14b5c1eb7c80a3bbf767dfa897b)): ?>
<?php $component = $__componentOriginal5401d14b5c1eb7c80a3bbf767dfa897b; ?>
<?php unset($__componentOriginal5401d14b5c1eb7c80a3bbf767dfa897b); ?>
<?php endif; ?>
                        <?php endif; ?>


                        <?php if(auth()->guard()->check()): ?>
                            <?php if (isset($component)) { $__componentOriginald48d1fca4b82eb6803dff45474879693 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald48d1fca4b82eb6803dff45474879693 = $attributes; } ?>
<?php $component = App\View\Components\Menus\Submenu::resolve(['selectable' => '0','uniqueName' => 'submenu_user'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('menus.submenu'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Menus\Submenu::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'relative submenu']); ?>
                                 <?php $__env->slot('content', null, []); ?> 
                                    <div class="pe-1">
                                        <?php if(Auth::user()->photoFullUrl): ?>
                                            <img src="<?php echo e(Auth::user()->photoFullUrl); ?>"
                                                class="w-11 h-11 min-w-11 min-h-11 rounded-full"
                                                onError="this.onerror=null;this.src='<?php echo e(asset('storage/photos/no-photo-icon-22.png')); ?>';">
                                        <?php else: ?>
                                            <span class="w-11 h-11 min-w-11 min-h-11 flex items-center justify-center bg-gray-200 rounded-full">
                                                <?php echo e(substr(Auth::user()->name, 0, 1)); ?>

                                            </span>
                                        <?php endif; ?>
                                    </div>
                                    
                                    <div
                                        class="ps-1 sm:max-w-[calc(100vw-39rem)] md:max-w-[calc(100vw-41rem)] lg:max-w-[calc(100vw-46rem)] xl:max-w-[34rem] truncate">
                                        <?php echo e(Auth::user()->name); ?>

                                    </div>
                                 <?php $__env->endSlot(); ?>

                                <?php if (isset($component)) { $__componentOriginal6da5cb2d4a2d725fd99275e89be1cb5e = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal6da5cb2d4a2d725fd99275e89be1cb5e = $attributes; } ?>
<?php $component = App\View\Components\Menus\SubmenuItem::resolve(['content' => 'My Purchases','selectable' => '0','href' => ''.e(route('purchases.myPurchases')).''] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('menus.submenu-item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Menus\SubmenuItem::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal6da5cb2d4a2d725fd99275e89be1cb5e)): ?>
<?php $attributes = $__attributesOriginal6da5cb2d4a2d725fd99275e89be1cb5e; ?>
<?php unset($__attributesOriginal6da5cb2d4a2d725fd99275e89be1cb5e); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal6da5cb2d4a2d725fd99275e89be1cb5e)): ?>
<?php $component = $__componentOriginal6da5cb2d4a2d725fd99275e89be1cb5e; ?>
<?php unset($__componentOriginal6da5cb2d4a2d725fd99275e89be1cb5e); ?>
<?php endif; ?>
                                <hr>

                                <?php if (isset($component)) { $__componentOriginal6da5cb2d4a2d725fd99275e89be1cb5e = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal6da5cb2d4a2d725fd99275e89be1cb5e = $attributes; } ?>
<?php $component = App\View\Components\Menus\SubmenuItem::resolve(['content' => 'Profile','selectable' => '0','href' => ''.e(route('profile.edit')).''] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('menus.submenu-item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Menus\SubmenuItem::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal6da5cb2d4a2d725fd99275e89be1cb5e)): ?>
<?php $attributes = $__attributesOriginal6da5cb2d4a2d725fd99275e89be1cb5e; ?>
<?php unset($__attributesOriginal6da5cb2d4a2d725fd99275e89be1cb5e); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal6da5cb2d4a2d725fd99275e89be1cb5e)): ?>
<?php $component = $__componentOriginal6da5cb2d4a2d725fd99275e89be1cb5e; ?>
<?php unset($__componentOriginal6da5cb2d4a2d725fd99275e89be1cb5e); ?>
<?php endif; ?>

                                <hr>



                                <hr>
                                <form id="form_to_logout_from_menu" method="POST" action="<?php echo e(route('logout')); ?>"
                                    class="hidden">
                                    <?php echo csrf_field(); ?>
                                </form>
                                <a class="px-3 py-4 border-b-2 border-transparent
                                        text-sm font-medium leading-5 inline-flex h-auto
                                        text-gray-500
                                        hover:text-gray-700
                                        hover:bg-gray-100
                                        focus:outline-none
                                        focus:text-gray-700
                                        focus:bg-gray-100 "
                                    href="#"
                                    onclick="event.preventDefault();
                                    document.getElementById('form_to_logout_from_menu').submit();">
                                    Log Out
                                </a>
                             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald48d1fca4b82eb6803dff45474879693)): ?>
<?php $attributes = $__attributesOriginald48d1fca4b82eb6803dff45474879693; ?>
<?php unset($__attributesOriginald48d1fca4b82eb6803dff45474879693); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald48d1fca4b82eb6803dff45474879693)): ?>
<?php $component = $__componentOriginald48d1fca4b82eb6803dff45474879693; ?>
<?php unset($__componentOriginald48d1fca4b82eb6803dff45474879693); ?>
<?php endif; ?>
                        <?php else: ?>
                            <!-- Menu Item: Login -->
                            <?php if (isset($component)) { $__componentOriginal8ffb92400f9024f5b5068d82c70e677b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal8ffb92400f9024f5b5068d82c70e677b = $attributes; } ?>
<?php $component = App\View\Components\Menus\MenuItem::resolve(['content' => 'Login','selectable' => '1','href' => ''.e(route('login')).'','selected' => ''.e(Route::currentRouteName() == 'login').''] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('menus.menu-item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Menus\MenuItem::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
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
                            <?php if (isset($component)) { $__componentOriginal8ffb92400f9024f5b5068d82c70e677b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal8ffb92400f9024f5b5068d82c70e677b = $attributes; } ?>
<?php $component = App\View\Components\Menus\MenuItem::resolve(['content' => 'Register','selectable' => '1','href' => ''.e(route('register')).'','selected' => ''.e(Route::currentRouteName() == 'register').''] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('menus.menu-item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Menus\MenuItem::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
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

                        <?php endif; ?>
                    </div>
                    <!-- Hamburger -->
                    <div class="absolute right-0 top-0 flex sm:hidden pt-3 pe-3 text-black ">
                        <button id="hamburger_btn">
                            <svg class="h-8 w-8" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                <path id="hamburger_btn_open" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                                <path class="invisible" id="hamburger_btn_close" stroke-linecap="round"
                                    stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </nav>



        <main>
            <?php if(session('alert-msg')): ?>
                <?php if (isset($component)) { $__componentOriginalb5e767ad160784309dfcad41e788743b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalb5e767ad160784309dfcad41e788743b = $attributes; } ?>
<?php $component = App\View\Components\Alert::resolve(['type' => ''.e(session('alert-type') ?? 'info').''] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('alert'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Alert::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
                    <?php echo session('alert-msg'); ?>

                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalb5e767ad160784309dfcad41e788743b)): ?>
<?php $attributes = $__attributesOriginalb5e767ad160784309dfcad41e788743b; ?>
<?php unset($__attributesOriginalb5e767ad160784309dfcad41e788743b); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalb5e767ad160784309dfcad41e788743b)): ?>
<?php $component = $__componentOriginalb5e767ad160784309dfcad41e788743b; ?>
<?php unset($__componentOriginalb5e767ad160784309dfcad41e788743b); ?>
<?php endif; ?>
            <?php endif; ?>
            <?php if(!$errors->isEmpty()): ?>
                <?php if (isset($component)) { $__componentOriginalb5e767ad160784309dfcad41e788743b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalb5e767ad160784309dfcad41e788743b = $attributes; } ?>
<?php $component = App\View\Components\Alert::resolve(['type' => 'warning','message' => 'Operation failed because there are validation errors!'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('alert'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Alert::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalb5e767ad160784309dfcad41e788743b)): ?>
<?php $attributes = $__attributesOriginalb5e767ad160784309dfcad41e788743b; ?>
<?php unset($__attributesOriginalb5e767ad160784309dfcad41e788743b); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalb5e767ad160784309dfcad41e788743b)): ?>
<?php $component = $__componentOriginalb5e767ad160784309dfcad41e788743b; ?>
<?php unset($__componentOriginalb5e767ad160784309dfcad41e788743b); ?>
<?php endif; ?>
            <?php endif; ?>

            <?php echo $__env->yieldContent('main'); ?>
        </main>
        <footer class="py-5 bg-dark">
            <div class="container">
                <p class="m-0 text-center text-black">Copyright &copy; CineMagic 2024</p>
            </div>
        </footer>
    </div>
</body>

</html>
<?php /**PATH C:\laragon\www\projeto\resources\views/layouts/main.blade.php ENDPATH**/ ?>