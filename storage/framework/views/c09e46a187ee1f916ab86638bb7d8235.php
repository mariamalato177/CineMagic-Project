<?php $__env->startSection('header-title', 'New Screening'); ?>

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

            <div class="flex flex-col items-center space-y-6">
                <div class="p-4 sm:p-8 bg-white w-full max-w-3xl">
                    <div class="w-full-xl">
                        <section>
                            <form method="POST" action="<?php echo e(route('screenings.store')); ?>" enctype="multipart/form-data">
                                <?php echo csrf_field(); ?>
                                <div class="mt-6 space-y-4 max-w-xl">
                                    <?php echo $__env->make('screenings.shared.fields', ['mode' => 'create'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                                    <div id="screening-sessions">
                                        <div class="screening-session">
                                            <label for="dates[]">Date</label>
                                            <input type="date" name="dates[]" required>

                                            <label for="times[]">Time</label>
                                            <input type="time" name="times[]" required>
                                        </div>

                                    </div>
                                    <br>

                                </div>
                                <div>
                                    <button type="button" id="add-session"
                                        class="bg-blue-500 text-white px-4 py-1 rounded">
                                        Add Another Session
                                    </button>
                                </div>
                                <div class="flex mt-6 justify-center">
                                    <?php if (isset($component)) { $__componentOriginale67687e3e4e61f963b25a6bcf3983629 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale67687e3e4e61f963b25a6bcf3983629 = $attributes; } ?>
<?php $component = App\View\Components\Button::resolve(['element' => 'submit','type' => 'dark','text' => 'Save new screenings'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Button::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'uppercase']); ?>
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
                                    <hr>

                                </div>
                            </form>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('add-session').addEventListener('click', function() {
            const sessionDiv = document.createElement('div');
            sessionDiv.classList.add('screening-session');

            const dateLabel = document.createElement('label');
            dateLabel.textContent = 'Date';
            sessionDiv.appendChild(dateLabel);

            const dateInput = document.createElement('input');
            dateInput.type = 'date';
            dateInput.name = 'dates[]';
            dateInput.required = true;
            sessionDiv.appendChild(dateInput);

            const timeLabel = document.createElement('label');
            timeLabel.textContent = 'Time';
            sessionDiv.appendChild(timeLabel);

            const timeInput = document.createElement('input');
            timeInput.type = 'time';
            timeInput.name = 'times[]';
            timeInput.required = true;
            sessionDiv.appendChild(timeInput);

            document.getElementById('screening-sessions').appendChild(sessionDiv);
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/screenings/create.blade.php ENDPATH**/ ?>