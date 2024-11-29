<div <?php echo e($attributes->merge(['class' => 'grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 relative z-10'])); ?>>
    <?php $__currentLoopData = $tickets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ticket): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php
            $tmdbId = $ticket->screeningRef->custom;
                    $movieData=[];
                    $movieData = Cache::remember("movie_{$tmdbId}", 3600, function () use ($tmdbId) {
                        $tmdbService = app()->make(\App\Services\TmdbService::class);
                        return $tmdbService->getMovieByID($tmdbId);
                    });
    ?>
        <div class="bg-white  rounded-lg shadow-lg p-4 transition-transform transform hover:scale-105 flex relative">
            <?php if($ticket->screeningRef): ?>
                <div class="w-3/4 pl-4 flex flex-col justify-between">
                    <div>
                        <h5>Ticket for the movie:</h5>
                        <h3 class="text-xl font-bold text-gray-900 ">
                            "<?php echo e($movieData['title']); ?>"
                        </h3>
                        <p class="text-lg text-gray-700 ">
                            Theater: <strong><?php echo e($ticket->screeningRef->theaterRef->name); ?></strong>
                        </p>
                        <p class="text-lg text-gray-700 ">
                            Screening:
                            <strong><?php echo e($ticket->screeningRef->date . ' at ' . $ticket->screeningRef->start_time); ?></strong>
                        </p>
                        <p class="text-lg text-gray-700">
                            Seat: <strong><?php echo e($ticket->seatRef->row . $ticket->seatRef->seat_number); ?></strong>
                        </p>
                        <p class="text-lg text-gray-700">
                            Price: <strong><?php echo e($ticket->price); ?> €</strong>
                        </p>
                    </div>
                </div>

            <?php endif; ?>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<?php /**PATH /var/www/html/resources/views/components/tickets/table.blade.php ENDPATH**/ ?>