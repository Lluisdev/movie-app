@include('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    Profile Data
                    <button class="btn btn-default">
                        <a href="/edit-profile">Edit</a>
                    </button>
                </div>
                <div class="card-body">
                    <p>Name: {{ $user['name'] }}</p>
                    <p>Email: {{ $user['email'] }}</p>
                    <p>Streaming From: {{ $user['country'] }}</p>
                    <p>Movies list: {{ count($lists) }}</p>
                    <p>Streaming Providers: </p>
                    <ul>
                        @foreach($userStreamingProviders as $providers)
                        <li>{{ $providers }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
    @include('movieList.show-form')
</div>