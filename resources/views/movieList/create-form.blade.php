@include('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 d-flex">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    Create Movie List
                    <button class="btn btn-default">
                        <a href="/profile">Cancel</a>
                    </button>
                </div>
                <div class="card-body">         
                    <form action="{{ route('movielist.save') }}" method="post">
                        {{ csrf_field() }}
                        
                        <div class="form-group">
                            <label for="listName">Name: <label>
                            <input type="text" class="form-control col-md-10" name="listName">
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
