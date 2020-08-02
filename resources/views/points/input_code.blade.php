@extends('layout')

@section('content')
    <div class="container">
        <div class="row justify-content-center" style="margin-top: 80px">
            <div class="col-md-12">
                <div class="card text-center" style="margin-top: 80px;padding: 50px">
                    <div class="card-header">{{ __('Welcome to Marriage Point Calculator') }}</div>
                    <div class="card-body" style="background-color: rgba(0,0,0,.75);">
                        <form method="get" action="{{route('view.table')}}">
                            @csrf

                                <div class="form-group row mt-2 text-center">

                                    <label for="code"
                                           class="col-md-6 col-form-label text-md-right" style="color: white"> Enter Code:</label>

                                    <div class="col-md-2">

                                        <input id="code" type="text"
                                               class="form-control"
                                               name="code_id" required
                                               autofocus>
                                    </div>
                                </div>

                            <div class="form-group row mb-0">
                            <div class="col-md-2 offset-md-5  text-center">
                                <button type="submit" class="btn btn-block btn-primary">
                                    {{ __('Submit') }}
                                </button>
                            </div>
                    </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
