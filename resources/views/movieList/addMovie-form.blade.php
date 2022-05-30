@include('layouts.app')

@section('content')
<div class="container">
    <div class="row">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    Add Movie to List
                    <button class="btn btn-default">
                        <a href="/profile">Cancel</a>
                    </button>
                </div>
                <div class="card-body">         
                    <form action="/movie-list/add/{{ $movie['id'] }}" method="post">
                        {{ csrf_field() }}
                        
                        <div class="form-group">
                            <label for="listName">Select a list: <label>
                            <select name="listName" class="selectpicker">
                                @foreach($lists as $list)
                                <option value="{{ $list['name'] }}">{{ $list['name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="d-flex">
                            <div>
                                <img src="https://image.tmdb.org/t/p/w500/{{ $movie['backdrop_path'] }}">
                            </div>
                            <div>
                                <div class="">
                                    <h3 class="text-center">{{ $movie['original_title'] }}</h3>
                                </div>
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
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary col-lg-12">Add to list</button>
                        </div>
                    </form>
                </div>
            </div>             
        </div>
    </div>
</div>
