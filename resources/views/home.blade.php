@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Dashboard Settings
                </div>
                <div class="card-body">
                    @include('form.countries-form')
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                Popular Movies in {{ $country }}
            </div>
             @include('form.popular-movies')
        </div>
    </div>
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                Top Rated Movies in {{ $country }}
            </div>
            @include('form.top-rated-movies')
        </div>
    </div>
</div>
@endsection
