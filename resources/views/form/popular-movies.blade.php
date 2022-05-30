<div class="container-fluid">
    <div class="d-flex flex-row flex-nowrap overflow-auto">
        @foreach ($popularMoviesPages as $popularMovies)
            @foreach($popularMovies as $movie)
            {{ dd($movie) }}
                @if (in_array($movie['streamingProvider'], $userStreamingProviders))
                    <div class="card card-body" style="min-width: 300px">
                        <div class="movie-provider">{{ $movie['streamingProvider'] }}</div>
                        <img src="https://image.tmdb.org/t/p/w500/{{ $movie['backdrop_path'] }}">
                        <div class="title-section">
                            <a class="movie-id" href="/details/{{ $movie['id'] }}")><h3 class="text-center">{{ $movie['original_title'] }}</h3></a>
                        </div>
                        <small class="text-center">({{ $movie['title'] }})</small>
                        <span class="description-section">
                            <p class="card-text">{{ $movie['overview'] }}</p>
                        </span>
                        <div class="d-flex justify-content-around">
                            <div><small>Avg. Votes: {{ $movie['vote_average'] }}</small></div>
                            <div><small>Total Votes: {{ $movie['vote_count'] }}</small></div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-success"><a href="/movie-list/add/{{ $movie['id'] }}" }}>Add to List</a></button>
                        </div>
                    </div>
                @endif
            @endforeach
        @endforeach
    </div>
</div>

<script>
    var streamingProviders = document.getElementsByClassName('movie-provider')
    for (i = 0; i < streamingProviders.length; i++)
    {
        if (streamingProviders[i].innerHTML == 'Disney Plus') {
            streamingProviders[i].classList.add('disney-plus')
        } else if (streamingProviders[i].innerHTML == 'Netflix') {
            streamingProviders[i].classList.add('netflix')
        } else if (streamingProviders[i].innerHTML == 'Amazon Prime Video') {
            streamingProviders[i].classList.add('amazon-prime-video')
        } else if (streamingProviders[i].innerHTML == 'Not Available in you Country') {
            streamingProviders[i].classList.add('not-available')
        } else if (streamingProviders[i].innerHTML == 'Buy on: Apple iTunes') {
            streamingProviders[i].classList.add('apple-itunes')
        }
    }
</script>
