<div {{ $attributes->merge(['class' => 'grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 relative z-10']) }}>
    @foreach ($tickets as $ticket)
    @php
            $tmdbId = $ticket->screeningRef->custom;
                    $movieData=[];
                    $movieData = Cache::remember("movie_{$tmdbId}", 3600, function () use ($tmdbId) {
                        $tmdbService = app()->make(\App\Services\TmdbService::class);
                        return $tmdbService->getMovieByID($tmdbId);
                    });
    @endphp
        <div class="bg-white  rounded-lg shadow-lg p-4 transition-transform transform hover:scale-105 flex relative">
            @if ($ticket->screeningRef)
            @php
                $date = \Carbon\Carbon::parse($ticket->screeningRef->start_time)->format('d-m-Y');
            @endphp
                <div class="w-3/4 pl-4 flex flex-col justify-between">
                    <div>
                        <h5>Ticket for the movie:</h5>
                        <h3 class="text-xl font-bold text-gray-900 ">
                            "{{ $movieData['title'] }}"
                        </h3>
                        <p class="text-lg text-gray-700 ">
                            Theater: <strong>{{ $ticket->screeningRef->theaterRef->name }}</strong>
                        </p>
                        <p class="text-lg text-gray-700 ">
                            Screening:
                            <strong>{{ $date . ' at ' . $ticket->screeningRef->start_time }}</strong>
                        </p>
                        <p class="text-lg text-gray-700">
                            Seat: <strong>{{ $ticket->seatRef->row . $ticket->seatRef->seat_number }}</strong>
                        </p>
                        <p class="text-lg text-gray-700">
                            Price: <strong>{{ $ticket->price }} €</strong>
                        </p>
                    </div>
                </div>

            @endif
        </div>
    @endforeach
</div>
