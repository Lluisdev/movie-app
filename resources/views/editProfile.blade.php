@include('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 d-flex">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    Edit Profile
                    <button class="btn btn-default">
                        <a href="/profile">Cancel</a>
                    </button>
                </div>
                <div class="card-body">         
                    <form action="{{ route('user.update') }}" method="post">
                        {{ csrf_field() }}
                        
                        <div class="form-group">
                            <label for="userName">Name: <label>
                            <input type="text" class="form-control col-md-10" name="userName" value="{{ $user['name'] }}">
                        </div>
                        <div class="form-group">
                            <label for="userEmail">Email:   <label>
                            <input type="email" readonly class="form-control col-md-10" name="userEmail" value="{{ $user['email'] }}">
                        </div> 
                        <div class="form-group">
                            <label for="country">Streaming from:    <label>
                            <select name="countries-list" class="form-control col-md-10" value="{{ $user['country'] }}">
                                <option value="{{ $user['country'] }}" selected>{{ $user['country'] }}</option>
                                @foreach($countriesList as $country)
                                    <option value="{{ $country }}">{{ $country }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" name="Netflix" value="" {{ ($userStreamingProviders['Netflix'] ? 'checked' : '') }}><label class="form-check-label" for="Netflix">Netflix</label><br>
                            <input type="checkbox" class="form-check-input" name="Amazon_Prime_Video" {{ ($userStreamingProviders['Amazon_Prime_Video'] ? 'checked' : '') }}><label class="form-check-label" for="Amazon_Prime_Video">Amazon Prime</label><br>
                            <input type="checkbox" class="form-check-input" name="Disney_Plus" {{ ($userStreamingProviders['Disney_Plus'] ? 'checked' : '') }}><label class="form-check-label" for="Disney_Plus">Disney Plus</label><br>
                            <input type="checkbox" class="form-check-input" name="HBO" {{ ($userStreamingProviders['HBO'] ? 'checked' : '') }}><label class="form-check-label" for="HBO">HBO</label>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div> 
                    </form>
                </div>               
            </div>
        </div>
    </div>
</div>