<div {{ $attributes }}>
    @foreach ($screenings->groupBy('movie_id') as $movieId => $movieScreenings)
        @php
            $movie = $movieScreenings->first()->movieRef;
        @endphp
        <div class="mb-8">
            <h1 class="text-2xl font-bold mb-4 text-gray-900 ">Movie: {{ $movie->title }}</h1>
            <div class="flex items-start">
                <div class="w-1/4 h-full overflow-hidden flex justify-center items-center mb-4">
                    <a href="{{ route('movies.show', ['movie' => $movie]) }}">
                        <img src="{{ $movie->image_url ? $movie->image_url : asset('storage/posters/_no_poster_2.png') }}"
                            alt="{{ $movie->title }}" class="w-full h-auto object-contain rounded-lg">
                    </a>
                </div>
                <div class="w-3/4 pl-4">
                    @foreach ($movieScreenings->groupBy('theater_id') as $theaterId => $theaterScreenings)
                        @php
                            $theater = $theaterScreenings->first()->theaterRef;
                        @endphp
                        <div class="mb-4">
                            <a href="{{ route('theaters.show', ['theater' => $theater]) }}">
                                <h2 class="text-xl font-semibold mb-2 text-gray-900 ">Theater:
                                    {{ $theater->name }} </h2>
                            </a>
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                                @foreach ($theaterScreenings as $screening)
                                    <div
                                        class="session-card bg-white  shadow-md rounded-lg p-4 relative">
                                        <div class="movie-info text-gray-700 ">
                                            <p class="text-xl"><strong>Date:</strong> {{ $screening->date }}</p>
                                            <p class="text-xl"><strong>Start Time:</strong> {{ $screening->start_time }}
                                            </p>
                                        </div>
                                        <div class="actions mt-4 flex justify-end gap-2">
                                            @if ($showView)
                                                <a class="px-2 py-1 bg-yellow-400 text-white text-sm font-semibold rounded-full flex items-center"
                                                    href="{{ route('screenings.showTickets', ['screening' => $screening]) }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" viewBox="0 0 24 24" fill="currentColor">
                                                        <path d="M20 3H4c-1.1 0-2 .9-2 2v3.5c1.11 0 2 .89 2 2s-.89 2-2 2V19c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2v-3.5c-1.11 0-2-.89-2-2s.89-2 2-2V5c0-1.1-.9-2-2-2zm-5 10H9v-2h6v2zm0-4H9V7h6v2z"/>
                                                      </svg>
                                                </a>
                                            @endif
                                            @if ($showEdit)
                                                <x-table.icon-edit
                                                    href="{{ route('screenings.edit', ['screening' => $screening]) }}" />
                                            @endif
                                            @if ($showDelete)
                                                <x-table.icon-delete
                                                    action="{{ route('screenings.destroy', ['screening' => $screening]) }}" />
                                            @endif
                                            @if ($screening->hasPassed())
                                                <div class="absolute top-2 right-2">
                                                    <span
                                                        class="px-2 py-1 bg-red-500 text-white text-sm font-semibold rounded-full">Unavailable</span>

                                                </div>
                                            @else
                                                @if (!$screening->isSoldOut($screening))
                                                    <a href="{{ route('screenings.show', $screening) }}"
                                                        rel="noopener noreferrer"
                                                        class="px-2 py-1 font-semibold rounded-full"
                                                        style="background-color: coral; color: white; transition: background-color 0.3s ease-in-out;">
                                                        @if (auth()->check() && auth()->user()->type !== 'C')
                                                            See Info
                                                        @else
                                                            Buy Ticket
                                                        @endif
                                                    </a>
                                                @else
                                                    @if (auth()->check() && auth()->user()->type !== 'A')
                                                        <a href="{{ route('screenings.show', $screening) }}"
                                                            rel="noopener noreferrer"
                                                            class="px-2 py-1 font-semibold rounded-full"
                                                            style="background-color: coral; color: white; transition: background-color 0.3s ease-in-out;">
                                                            See Info
                                                        </a>
                                                        <div class="absolute top-2 right-2">
                                                            <span
                                                                class="px-2 py-1 bg-red-500 text-white text-xl font-semibold rounded-full">Sold
                                                                Out</span>
                                                        </div>
                                                    @endif
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endforeach
</div>
