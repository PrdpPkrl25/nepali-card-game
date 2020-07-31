@extends('layout')

@section('content')
    <div class="container">
        <div class="row justify-content-center" style="margin-top: 80px">
            <div class="col-md-12">
                <div class="card " style="margin-top: 80px;padding: 50px">
                    <div class="card-header">{{ __('Enter Round Result:') }}</div>
                    <div class="card-body" style="background-color: rgba(0,0,0,.75);">
                        <form method="POST" action="{{route('rounds.store')}}">
                            @csrf
                            @for($i=0;$i<$game->number_of_players;$i++)
                                <div class="form-group row mt-2 text-center">

                                    <label for="points"
                                           class="col-md-2 col-form-label text-md-right" style="color: white"> {{$players[$i]['name']}}'s Points:</label>

                                    <div class="col-md-3">

                                        <input id="points" type="text"
                                               class="form-control"
                                               name="points[]" value="{{ old('name')}}" required
                                               autofocus>

                                    </div>

                                    <label for="seen"
                                           class="col-md-2 col-form-label text-md-right" style="color: white">Seen:</label>

                                    <div class="col-md-1">

                                        <input id="seen" type="checkbox"
                                               class="form-control"
                                               name="seen[]" value="{{ old('email')}}" autofocus>

                                    </div>

                                    <label for="dubli"
                                           class="col-md-2 col-form-label text-md-right" style="color: white">Dubli:</label>

                                    <div class="col-md-1">

                                        <input id="dubli" type="checkbox"
                                               class="form-control"
                                               name="seen[]" value="{{ old('email')}}" autofocus>

                                    </div>
                                </div>
                            @endfor

                            <div class="row text-center mt-4">
                                <div class="col-md-12 "
                                     style="font-size: 1.5em;font-weight: bold;color: white">
                                    <span>Winner</span>
                                </div>
                            </div>
                            <hr style="height:1.5px;border-width:0;background-color:gray;width: 100%;margin-top: 0">

                            <div class="form-group row mt-2 text-center">
                                @for($i=0;$i<$game->number_of_players;$i++)

                                    <div class="col-md-3">
                                        <input id="winner" type="radio"
                                               class="form-control"
                                               name="seen[]" value="{{$players[$i]['name']}}" autofocus>

                                        <label for="winner"
                                               class="col-form-label text-md-right" style="color: white">{{$players[$i]['name']}}</label>
                                    </div>



                                @endfor
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-3 offset-md-5  text-center">
                                    <button type="submit" class="btn btn-block btn-primary">
                                        {{ __('Next') }}
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
