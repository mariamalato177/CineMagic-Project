<?php $__env->startSection('header-title', 'List of Movies'); ?>

<?php $__env->startSection('main'); ?>
<div style="padding-left: 50px; padding-right: 50px;">
    <?php if(session('error')): ?>
        <div class="alert alert-danger"><?php echo e(session('error')); ?></div>
    <?php endif; ?>

    <?php if(!empty($movies)): ?>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-16 gap-y-12 mt-12">
            <?php $__currentLoopData = $movies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $movie): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-md-3">
                    <div class="card mb-4">
                        <img 
                            class="rounded-lg shadow-md ease-in-out duration-300 hover:opacity-50 cursor-pointer" 
                            src="https://image.tmdb.org/t/p/w500<?php echo e($movie['poster_path']); ?>" 
                            alt="<?php echo e($movie['title']); ?>"
                            data-movie="<?php echo e(json_encode($movie)); ?>"
                            onclick="openModal(event)"
                        >

                        <div class="text-center">
                            <h5 class="card-title mt-2"><?php echo e($movie['title']); ?></h5>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        <div class="mt-6">
            <?php echo e($movies->links()); ?>

        </div>

    <?php else: ?>
        <div class="alert alert-warning">No movies found.</div>
    <?php endif; ?>

    <div id="modal" class="fixed inset-0 z-50 flex items-center justify-center bg-gray-900 bg-opacity-75 hidden transition-opacity duration-300">
        <div class="bg-gray-900 text-gray-100 rounded-lg shadow-lg max-w-3xl w-full p-6 relative flex flex-col md:flex-row items-start">
            <button id="close-modal" class="absolute top-3 right-3 text-gray-500 hover:text-gray-300 text-4xl p-2">&times;</button>
            
            <div class="w-full md:w-1/3">
                <img id="modal-poster" class="rounded-lg shadow-md" src="" alt="Movie Poster">
            </div>
            
            <div class="flex-1 ml-0 md:ml-6 mt-4 md:mt-0">
                <h2 id="modal-title" class="text-2xl font-semibold text-white mb-2"></h2>
                <p id="modal-overview" class="text-gray-300 text-sm mb-4"></p>

                <div class="mt-4 text-sm">
                    <p><span class="font-semibold">Genre:</span> <span id="modal-genre" class="text-gray-400"></span></p>
                    <p><span class="font-semibold">Release Year:</span> <span id="modal-year" class="text-gray-400"></span></p>
                </div>

                <div class="mt-4">
                    <h3 class="text-lg font-semibold text-white">Review:</h3>
                    <p id="modal-review" class="text-gray-300 text-sm italic"></p>
                </div>

                <div class="flex justify-start">
                    <a class="text-blue-500 font-bold cursor-pointer" id="modal-more-reviews" href="">View More Reviews</a>
                </div>
                <div class="mt-4">
                    <a id="modal-trailer" href="" target="_blank" class="text-blue-500 hover:text-blue-300">Watch Trailer</a>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .modal {
        display: none;
    }
    .modal.open {
        display: flex;
    }
</style>

<script>
    const reviewCache = {};

    async function openModal(event) {
        event.preventDefault();

        const movie = JSON.parse(event.target.getAttribute('data-movie'));

        document.getElementById('modal-poster').src = `https://image.tmdb.org/t/p/w500${movie.poster_path}`;
        document.getElementById('modal-title').textContent = movie.title;
        document.getElementById('modal-overview').textContent = movie.overview || "No synopsis available.";
        document.getElementById('modal-genre').textContent = movie.genre_names || "Unknown genre";
        document.getElementById('modal-year').textContent = movie.release_date ? new Date(movie.release_date).getFullYear() : "N/A";

        const trailerLink = document.getElementById('modal-trailer');
        trailerLink.classList.add('hidden');

        const moreReviewsLink = document.getElementById('modal-more-reviews');
        moreReviewsLink.href = `/movies/${movie.id}`;

        try {
            const response = await fetch(`https://api.themoviedb.org/3/movie/${movie.id}/videos?api_key=00ba7a7ea04d04cfb14ee146d36ec4e6`);
            const data = await response.json();
            const trailer = data.results.find(video => video.type === 'Trailer' && video.site === 'YouTube');
            
            if (trailer) {
                trailerLink.href = `https://www.youtube.com/watch?v=${trailer.key}`;
                trailerLink.classList.remove('hidden');
            }
        } catch (error) {
            console.error('Error fetching trailer:', error);
        }

        if (reviewCache[movie.id]) {
            document.getElementById('modal-review').textContent = reviewCache[movie.id];
        } else {
            try {
                const reviewResponse = await fetch(`https://api.themoviedb.org/3/movie/${movie.id}/reviews?api_key=00ba7a7ea04d04cfb14ee146d36ec4e6&language=en-US&page=1`);
                const reviewData = await reviewResponse.json();
                const shortReview = reviewData.results
                    .filter(review => review.content.length <= 300)
                    .sort((a, b) => a.content.length - b.content.length)[0];

                const reviewText = shortReview ? shortReview.content : "No short reviews available.";
                reviewCache[movie.id] = reviewText;
                document.getElementById('modal-review').textContent = reviewText;
            } catch (error) {
                console.error('Error fetching review:', error);
                document.getElementById('modal-review').textContent = "Unable to fetch review.";
            }
        }

        const modal = document.getElementById('modal');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    document.getElementById('close-modal').addEventListener('click', function () {
        const modal = document.getElementById('modal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    });
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/movies/index.blade.php ENDPATH**/ ?>