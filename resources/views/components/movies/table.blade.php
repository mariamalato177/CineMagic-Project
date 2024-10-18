<div {{ $attributes }}>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($movies as $movie)
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-4 transition-transform transform hover:scale-105 flex relative">
                <div class="w-1/3 h-full overflow-hidden flex justify-center items-center">
                    <a href="{{ route('movies.show', ['movie' => $movie]) }}">
                        <img src="{{ $movie->image_url }}"
                            alt="{{ $movie->title }}" class="w-full h-auto object-contain rounded-lg">
                    </a>
                </div>
                <div class="w-2/3 pl-4 flex flex-col justify-between">
                    <div>
                        <h3 class="px-2 text-xl font-bold text-gray-900 dark:text-gray-50">{{ $movie->title }}</h3>
                        <p class="text-lg text-gray-700 dark:text-gray-300">{{ $movie->genre_code }}</p>
                        <p class="text-lg text-gray-700 dark:text-gray-300">{{ $movie->year }}</p>
                    </div>
                    <div class="flex justify-end mt-4">
                        <a href="{{ route('movies.screenings', $movie->id) }}" rel="noopener noreferrer"
                            class="px-4 py-1 rounded-full text-sm"
                            style=" background-color: coral; color: white; transition: background-color 0.3s ease-in-out;">
                            See Screenings
                        </a>
                        @if ($showEdit)
                            <x-table.icon-edit class="px-2" href="{{ route('movies.edit', ['movie' => $movie]) }}" />
                        @endif

                        @if ($showDelete)
                            <x-table.icon-delete class="px-2"
                                action="{{ route('movies.destroy', ['movie' => $movie]) }}" />
                        @endif
                    </div>
                </div>
                @if($movie->trailer_url)
                <a href="{{ $movie->trailer_url }}" target="_blank" rel="noopener noreferrer"
                    class="absolute top-2 right-2 p-1 font-semibold rounded-full bg-white dark:bg-gray-800">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <rect x="2" y="2" width="20" height="20" rx="2" ry="2" stroke="black" stroke-width="2" fill="white" />
                        <rect x="2" y="4" width="2" height="2" fill="black" />
                        <rect x="2" y="8" width="2" height="2" fill="black" />
                        <rect x="2" y="12" width="2" height="2" fill="black" />
                        <rect x="2" y="16" width="2" height="2" fill="black" />
                        <rect x="20" y="4" width="2" height="2" fill="black" />
                        <rect x="20" y="8" width="2" height="2" fill="black" />
                        <rect x="20" y="12" width="2" height="2" fill="black" />
                        <rect x="20" y="16" width="2" height="2" fill="black" />
                        <polygon points="10,8 16,12 10,16" fill="black" />
                    </svg>
                </a>
                @endif
            </div>
        @endforeach
    </div>
</div>
