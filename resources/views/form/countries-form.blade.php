<form action="{{ route('home.countries') }}" method="post" class="form-inline">
    {{ csrf_field() }}
    
    <div class="row">
       {{--  <div class="col">
            <label for="streaming-provider" class="sr-only"></label>
            <select name="streaming-provider" id="streaming-provider" class="form-select">
                @foreach($streamingProviders as $provider)
                    <option value="{{ $provider }}">{{ $provider }}</option>
                @endforeach
            </select>
        </div> --}}
        <div class="col">
            <label for="countries-list" class="sr-only"></label>
            <select name="countries-list" class="form-select">
                @foreach($countriesList as $country)
                    <option value="{{ $country }}">{{ $country }}</option>
                @endforeach
            </select>
        </div>   
        <button type="submit" class="btn btn-primary col-2">
            Send
        </button>
    </div>
</form>
