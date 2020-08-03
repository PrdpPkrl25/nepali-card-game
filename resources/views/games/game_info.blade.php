@extends('layout')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card " style="margin-top: 80px;padding: 20px">
                    <div class="card-header">{{ __('Game Info:') }}</div>
                    <div class="card-body" style="background-color: rgba(0,0,0,.75);">

                            <div class="form-group row mt-2 text-center">
                                <label for="number_of_players"
                                       class="col-md-5 col-form-label text-md-right" style="color: white">{{ __('No of Player:') }}</label>

                                <div class="col-md-3">
                                    <input id="number_of_players" type="text"
                                           class="form-control"
                                           name="number_of_players" value="{{ $game->number_of_players }}"
                                           readonly>
                                </div>
                            </div>

                            <div class="form-group row mt-2 text-center">
                                <label for="rate_per_point"
                                       class="col-md-5 col-form-label text-md-right" style="color: white">{{ __('Rate Per Points:') }}</label>

                                <div class="col-md-3">
                                    <input id="rate_per_point" type="text"
                                           class="form-control"
                                           name="rate_per_point" value="{{ $game->rate_per_point }}"
                                           readonly>
                                </div>
                            </div>


                            <div class="form-group row mt-2 text-center">
                                <label for="winner_points_per_seen"
                                       class="col-md-5 col-form-label text-md-right" style="color: white">{{ __('Winner Point Per Seen:') }}</label>

                                <div class="col-md-3">
                                    <input id="number" type="text"
                                           class="form-control"
                                           name="winner_points_per_seen" value="{{$game->winner_points_per_seen }}"
                                           readonly>
                                </div>
                            </div>

                            <div class="form-group row mt-2 text-center">
                                <label for="winner_points_per_unseen"
                                       class="col-md-5 col-form-label text-md-right" style="color: white">{{ __('Winner Point Per Unseen:') }}</label>

                                <div class="col-md-3">
                                    <input id="number" type="text"
                                           class="form-control"
                                           name="winner_points_per_unseen" value="{{ $game->winner_points_per_unseen }}"
                                           readonly>
                                </div>
                            </div>

                            <div class="form-group row mt-2 text-center">
                                <label for="dubli_winner_points_per_seen"
                                       class="col-md-5 col-form-label text-md-right" style="color: white">{{ __('Dubli Winner Point Per Seen:') }}</label>

                                <div class="col-md-3">
                                    <input id="dubli_winner_points_per_seen" type="text"
                                           class="form-control @error('number') is-invalid @enderror"
                                           name="dubli_winner_points_per_seen" value="{{ $game->dubli_winner_points_per_seen }}"
                                           readonly>
                                </div>
                            </div>

                            <div class="form-group row mt-2 text-center">
                                <label for="dubli_winner_points_per_unseen"
                                       class="col-md-5 col-form-label text-md-right" style="color: white">{{ __('Dubli Winner Point Per Unseen:') }}</label>

                                <div class="col-md-3">
                                    <input id="dubli_winner_points_per_unseen" type="text"
                                           class="form-control"
                                           name="dubli_winner_points_per_unseen" value="{{ $game->dubli_winner_points_per_unseen }}"
                                           readonly>
                                </div>
                            </div>

                            <div class="form-group row mt-2 text-center">
                                <label for="view_token"
                                       class="col-md-5 col-form-label text-md-right" style="color: white">{{ __('View Token:') }}</label>

                                <div class="col-md-3">
                                    <input id="view_token" type="text"
                                           class="form-control"
                                            value="{{ $game->view_token_id }}"
                                           readonly>
                                </div>
                            </div>

                            <div class="form-group row mt-2 text-center">
                                <label for="edit_token"
                                       class="col-md-5 col-form-label text-md-right" style="color: white">{{ __('Edit Token:') }}</label>

                                <div class="col-md-3">
                                    <input id="edit_token" type="text"
                                           class="form-control"
                                            value="{{ $game->edit_token_id }}"
                                           readonly>
                                </div>
                            </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
