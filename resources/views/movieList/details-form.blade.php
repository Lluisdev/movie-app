@include('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h3>List: {{ $list->name }}</h3>
            @foreach ($movies as $movie)
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div> 
                        {{ $movie['original_title'] }}
                    </div>
                    <div class="d-flex justify-content-end">
                        <a href="/movie-list/delete/{{ $list['id'] }}/{{ $movie['id'] }}"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash float-right" viewBox="0 0 16 16">
                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                            <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                        </svg></a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="d-flex">
                        <img src="https://image.tmdb.org/t/p/w500/{{ $movie['backdrop_path'] }}">
                        <small class="text-center">({{ $movie['title'] }})</small>
                        <span class="description-section">
                            <p class="card-text">{{ $movie['overview'] }}</p>
                        </span>
                        <div class="d-flex justify-content-around">
                            <div><small>Avg. Votes: {{ $movie['vote_average'] }}</small></div>
                            <div><small>Total Votes: {{ $movie['vote_count'] }}</small></div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
