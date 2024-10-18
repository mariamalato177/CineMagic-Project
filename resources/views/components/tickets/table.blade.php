<div {{ $attributes->merge(['class' => 'grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 relative z-10']) }}>
    @foreach ($tickets as $ticket)
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-4 transition-transform transform hover:scale-105 flex relative">
            @if ($ticket->screeningRef)
                <div class="w-3/4 pl-4 flex flex-col justify-between">
                    <div>
                        <h5>Ticket for the movie:</h5>
                        <h3 class="text-xl font-bold text-gray-900 dark:text-gray-50">
                            "{{ $ticket->screeningRef->movieRef->title }}"
                        </h3>
                        <p class="text-lg text-gray-700 dark:text-gray-300">
                            Theater: <strong>{{ $ticket->screeningRef->theaterRef->name }}</strong>
                        </p>
                        <p class="text-lg text-gray-700 dark:text-gray-300">
                            Screening:
                            <strong>{{ $ticket->screeningRef->date . ' at ' . $ticket->screeningRef->start_time }}</strong>
                        </p>
                        <p class="text-lg text-gray-700 dark:text-gray-300">
                            Seat: <strong>{{ $ticket->seatRef->row . $ticket->seatRef->seat_number }}</strong>
                        </p>
                        <p class="text-lg text-gray-700 dark:text-gray-300">
                            Price: <strong>{{ $ticket->price }} €</strong>
                        </p>
                    </div>
                </div>
                
            @endif
        </div>
    @endforeach
</div>
