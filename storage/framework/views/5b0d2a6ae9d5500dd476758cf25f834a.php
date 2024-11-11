<?php $__env->startSection('header-title', 'Select seat for screening "' . $screening->movieRef->title . '"' . ' at ' .
    $screening->theaterRef->name . ' on ' . $screening->date . ' ' . $screening->start_time); ?>

<?php $__env->startSection('main'); ?>

    <header class="bg-white dark:bg-gray-900 shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                <?php echo $__env->yieldContent('header-title'); ?>
            </h2>
            <div class="flex flex-col sm:flex-row justify-between space-y-3 sm:space-y-0 sm:space-x-3">
                <div class="grow flex flex-col space-y-2">
                    <div class="flex flex-col sm:flex-row sm:space-x-3">
                        <label for="selected-seats"
                            class="pt-2 block text-m font-medium text-gray-700 dark:text-gray-300">Seats</label>
                        <input type="text" id="selected-seats" name="selected-seats" readonly
                            class="bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-700 rounded-md py-2 px-3 mt-1 block w-20 m:text-m sm:leading-5 text-gray-900 dark:text-gray-300"
                            value="0">
                    </div>

                    <?php if(!auth()->check() || auth()->user()->type == 'C'): ?>
                        <form id="addToCartForm" method="POST"
                            action="<?php echo e(route('cart.add', ['screeningId' => $screening->id])); ?>">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" name="selected_seats" id="selected_seats">
                            <?php if (isset($component)) { $__componentOriginale67687e3e4e61f963b25a6bcf3983629 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale67687e3e4e61f963b25a6bcf3983629 = $attributes; } ?>
<?php $component = App\View\Components\Button::resolve(['element' => 'submit','text' => 'Add to cart','type' => 'dark'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
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
                </div>
            </div>
        </div>
    </header>

    <br>

    <div class="flex justify-center mb-4">
        <div class="w-full max-w-3xl h-12 bg-gray-300 dark:bg-gray-700 rounded-md flex items-center justify-center">
            <span class="text-lg font-bold text-gray-800 dark:text-gray-200">Screen</span>
        </div>
    </div>
    <br>
    <br>
    <div class="flex justify-center">
        <div class="grid gap-6">
            <?php $__currentLoopData = $seats->groupBy('row'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row => $seatsByRow): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="flex justify-center gap-2">
                    <?php $__currentLoopData = $seatsByRow; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $seat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="text-center seat" data-seat-id="<?php echo e($seat->id); ?>"
                            data-available="<?php echo e($seat->isAvailable($screening->id) ? '1' : '0'); ?>">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                width="60px" height="60px" viewBox="0 0 600 600" version="1.1">
                                <g id="surface1">
                                    <path
                                        style="stroke:black;fill:<?php echo e(!$seat->isAvailable($screening->id) ? 'rgb(231, 77, 77)' : 'black'); ?>;
                                    fill-opacity:1;"
                                        d="M 539.128906 243.484375 L 539.128906 139.050781 C 539.128906 62.230469 476.839844 0 400.019531 0 L 199.980469 0 C 123.160156 0 60.871094 62.230469 60.871094 139.050781 L 60.871094 243.484375 C 28.984375 244.367188 2.898438 270.652344 2.898438 302.863281 L 2.898438 578.527344 C 2.898438 590.535156 12.632812 600 24.636719 600 L 154.40625 600 C 166.414062 600 176.8125 590.535156 176.8125 578.527344 L 176.8125 572.460938 L 423.191406 572.460938 L 423.191406 578.527344 C 423.191406 590.535156 433.589844 600 445.597656 600 L 575.363281 600 C 587.371094 600 597.101562 590.535156 597.101562 578.527344 L 597.101562 302.863281 C 597.101562 270.65625 571.015625 244.367188 539.128906 243.484375 Z M 133.332031 556.523438 L 46.375 556.523438 L 46.375 302.863281 C 46.375 294.074219 53.527344 286.957031 62.320312 286.957031 L 116.726562 286.957031 C 125.515625 286.957031 133.332031 294.074219 133.332031 302.863281 Z M 423.1875 528.984375 L 176.8125 528.984375 L 176.8125 420.289062 L 423.1875 420.289062 Z M 423.1875 302.863281 L 423.1875 344.925781 L 176.8125 344.925781 L 176.8125 302.863281 C 176.8125 270.097656 149.488281 243.476562 116.722656 243.476562 L 104.347656 243.476562 L 104.347656 139.050781 C 104.347656 86.203125 147.132812 43.480469 199.980469 43.480469 L 400.015625 43.480469 C 452.867188 43.480469 495.652344 86.207031 495.652344 139.050781 L 495.652344 243.476562 L 483.273438 243.476562 C 450.511719 243.476562 423.1875 270.097656 423.1875 302.863281 Z M 553.625 556.523438 L 466.667969 556.523438 L 466.667969 302.863281 C 466.667969 294.074219 474.484375 286.957031 483.273438 286.957031 L 537.679688 286.957031 C 546.472656 286.957031 553.625 294.074219 553.625 302.863281 Z M 553.625 556.523438 " />
                                </g>
                            </svg>
                            <h1 class="text-center"
                                style="color: <?php echo e(!$seat->isAvailable($screening->id) ? 'red' : 'black'); ?>">
                                <?php echo e($seat->seatName); ?>

                            </h1>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const seats = document.querySelectorAll('.seat');
            const selectedSeatsDisplay = document.getElementById('selected-seats');
            const addToCartForm = document.getElementById('addToCartForm');
            let selectedSeats = [];

            seats.forEach(seat => {
                seat.addEventListener('click', function() {
                    const isAvailable = seat.dataset.available === '1';
                    const seatId = seat.dataset.seatId;

                    if (!isAvailable) {
                        return;
                    }

                    // Toggle selection state
                    <?php if(auth()->check()): ?>
                        <?php if(auth()->user()->type == 'A' || auth()->user()->type == 'E'): ?>
                            return;
                        <?php endif; ?>
                    <?php endif; ?>
                    if (selectedSeats.includes(seatId)) {
                        selectedSeats = selectedSeats.filter(id => id !== seatId);
                        seat.querySelector('path').style.fill = 'black';
                    } else {
                        selectedSeats.push(seatId);
                        seat.querySelector('path').style.fill = 'green';
                    }

                    // Update the display of the number of selected seats
                    selectedSeatsDisplay.value = selectedSeats.length;
                });
            });

            addToCartForm.addEventListener('submit', function(event) {
                if (selectedSeats.length === 0) {
                    alert('Please select at least one seat to add to cart.');
                    event.preventDefault(); // Prevent form submission
                    return;
                }

                // Create hidden input to send selected seats data
                const seatsInput = document.createElement('input');
                seatsInput.type = 'hidden';
                seatsInput.name = 'selected_seats';
                seatsInput.value = JSON.stringify(selectedSeats);

                addToCartForm.appendChild(seatsInput);
            });
        });
    </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\projeto\resources\views/screenings/show.blade.php ENDPATH**/ ?>