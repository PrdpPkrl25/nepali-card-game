@extends('layout')

@section('content')
    <div class="container">
        <div class="row justify-content-center" style="margin-top: 80px">
            <div class="col-md-12">
                <div class="card " style="margin-top: 80px;padding: 50px">
                    <div class="card-header">{{ __('Welcome to Marriage Point Calculator') }}</div>
                    <div class="card-body" style="background-color: rgba(0,0,0,.75);">
                        <form method="POST" action="{{route('games.store')}}">
                            @csrf

                            <div class="form-group row mt-2 text-center">
                                <label for="number_of_players"
                                       class="col-md-5 col-form-label text-md-right" style="color: white">{{ __('Enter No of Player(Max 6):') }}</label>

                                <div class="col-md-3">
                                    <input id="number_of_players" type="text"
                                           class="form-control"
                                           name="number_of_players" value="{{ __('4') }}" required autocomplete="number_of_players"
                                           autofocus>
                                </div>
                            </div>

                            <div class="row text-center mt-4">
                                <div class="col-md-12 "
                                     style="font-size: 1.5em;font-weight: bold;color: #6c757d">
                                    <span>Set Terms</span>
                                </div>
                            </div>
                            <hr style="height:1.5px;border-width:0;background-color:gray;width: 70%;margin-top: 0">

                            <div class="form-group row mt-2 text-center">
                                <label for="rate_per_point"
                                       class="col-md-5 col-form-label text-md-right" style="color: white">{{ __('Enter Rate Per Points:') }}</label>

                                <div class="col-md-3">
                                    <input id="rate_per_point" type="text"
                                           class="form-control"
                                           name="rate_per_point" value="{{ __('1') }}" required autocomplete="rate_per_point"
                                           autofocus>
                                </div>
                            </div>

                            <div class="row text-center mt-4">
                                <div class="col-md-12 "
                                     style="font-size: 1.5em;font-weight: bold;color: #6c757d">
                                    <span>Settings</span>
                                </div>
                            </div>
                            <hr style="height:1.5px;border-width:0;background-color:gray;width: 70%;margin-top: 0">

                            <div class="form-group row mt-2 text-center">
                                <label for="winner_points_per_seen"
                                       class="col-md-5 col-form-label text-md-right" style="color: white">{{ __('Enter Winner Point Per Seen:') }}</label>

                                <div class="col-md-3">
                                    <input id="number" type="text"
                                           class="form-control"
                                           name="winner_points_per_seen" value="{{ __('3') }}" required autocomplete="winner_points_per_seen"
                                           autofocus>
                                </div>
                            </div>

                            <div class="form-group row mt-2 text-center">
                                <label for="winner_points_per_unseen"
                                       class="col-md-5 col-form-label text-md-right" style="color: white">{{ __('Enter Winner Point Per Unseen:') }}</label>

                                <div class="col-md-3">
                                    <input id="number" type="text"
                                           class="form-control"
                                           name="winner_points_per_unseen" value="{{ __('10') }}" required autocomplete="winner_points_per_unseen"
                                           autofocus>
                                </div>
                            </div>

                            <div class="form-group row mt-2 text-center">
                                <label for="dubli_winner_points_per_seen"
                                       class="col-md-5 col-form-label text-md-right" style="color: white">{{ __('Enter Dubli Winner Point Per Seen:') }}</label>

                                <div class="col-md-3">
                                    <input id="dubli_winner_points_per_seen" type="text"
                                           class="form-control @error('number') is-invalid @enderror"
                                           name="dubli_winner_points_per_seen" value="{{ __('5') }}" required autocomplete="dubli_winner_points_per_seen"
                                           autofocus>
                                </div>
                            </div>

                            <div class="form-group row mt-2 text-center">
                                <label for="dubli_winner_points_per_unseen"
                                       class="col-md-5 col-form-label text-md-right" style="color: white">{{ __('Enter Dubli Winner Point Per Unseen:') }}</label>

                                <div class="col-md-3">
                                    <input id="dubli_winner_points_per_unseen" type="text"
                                           class="form-control"
                                           name="dubli_winner_points_per_unseen" value="{{ __('10') }}" required autocomplete="dubli_winner_points_per_unseen"
                                           autofocus>
                                </div>
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
