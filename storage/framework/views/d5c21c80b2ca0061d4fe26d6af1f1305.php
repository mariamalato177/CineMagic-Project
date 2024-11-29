<?php $__env->startSection('header-title', 'Tickets'); ?>

<?php $__env->startSection('main'); ?>
    <header class="bg-white  shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <h2 class="font-semibold text-xl text-gray-800  leading-tight">
                <?php echo $__env->yieldContent('header-title'); ?>
            </h2>
            <div class="flex justify-start">
                <form action="<?php echo e(route('screenings.showTickets', ['screening' => $screening])); ?>" method="GET"
                    class="flex flex-wrap items-center space-y-4 md:space-y-0 md:space-x-4">
                    <div class="flex flex-col space-y-2">
                        <label for="search" class="text-black ">Search by Ticket ID:</label>
                        <input type="text" id="search" name="search" value="<?php echo e($searchQuery ?? ''); ?>"
                            placeholder="Enter Ticket ID" class="bg-white text-black p-2 rounded">
                    </div>
                    <div class="flex">
                        <button type="submit" class="bg-coral text-white px-6 py-2 rounded">Search</button>
                    </div>
                    <div>
                        <a href="<?php echo e(route('screenings.showTickets', ['screening' => $screening])); ?>"
                            class="bg-gray-200 text-black px-6 py-3 rounded">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </header>

    <div class="flex justify-center flex-wrap">
        <div
            class="w-full my-4 p-6 bg-white  overflow-hidden sm:rounded-lg text-gray-900 0">
            <div class="overflow-x-auto">
                <table class="min-w-full border-collapse border border-gray-200 ">
                    <thead class="bg-gray-100">
                        <tr>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500  uppercase tracking-wider">
                                Id</th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500  uppercase tracking-wider">
                                Seat</th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500  uppercase tracking-wider">
                                Name of Customer</th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500  uppercase tracking-wider">
                                Price (€)</th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500  uppercase tracking-wider">
                                Status</th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500  uppercase tracking-wider">
                                QR Code</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 ">
                        <?php $__currentLoopData = $tickets->sortByDesc('id'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ticket): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr class="transition-colors hover:bg-gray-50 ">
                                <td class="px-6 py-4 whitespace-nowrap"><?php echo e($ticket->id); ?></td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <?php echo e($ticket->seatRef->row); ?><?php echo e($ticket->seatRef->seat_number); ?></td>
                                <td class="px-6 py-4 whitespace-nowrap"><?php echo e($ticket->purchaseRef->customer_name); ?></td>
                                <td class="px-6 py-4 whitespace-nowrap"><?php echo e($ticket->price); ?></td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <?php if($ticket->status == 'invalid'): ?>
                                        <p class="text-red-500 font-bold ">Invalid</p>
                                    <?php else: ?>
                                        <p class="text-green-500 font-bold">Valid</p>
                                    <?php endif; ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap"><?php echo e($ticket->qrcode_url); ?></td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <a href="<?php echo e(route('tickets.showQrCode', ['ticket' => $ticket])); ?>"
                                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Edit</a>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
            <div class="mt-4">
                <?php echo e($tickets->links()); ?>

            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/tickets/index.blade.php ENDPATH**/ ?>