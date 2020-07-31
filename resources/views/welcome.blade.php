@extends('layout')

@section('content')
    <div class="container">
        <div class="row justify-content-center" style="margin-top: 80px">
            <div class="col-md-12">
                <div class="card " style="margin-top: 80px;padding: 50px">
                    <div class="card-header">{{ __('Welcome to Marriage Point Calculator') }}</div>
                    <div class="card-body" style="background-color: rgba(0,0,0,.75);">
                        <a class="btn btn-warning shadow border offset-md-6" href="{{route('games.create')}}">Start New Game </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
