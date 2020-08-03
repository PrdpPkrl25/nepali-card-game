@extends('layout')

@section('content')
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card align-content-between" style="margin-top: 80px;padding: 20px">
                    <div class="card-header">Points Table:</div>
                    <div class="card-body">
                        <div class="row text-center">
                            <table class="table table-bordered table-hover text-center table-striped">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Scored</th>
                                    <th><span class="glyphicon glyphicon-eye-open"></span></th>
                                    <th><span class="glyphicon glyphicon-king"></span></th>
                                    <th><span class="glyphicon glyphicon-duplicate"></span></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($points as $point)
                                    <tr>

                                        <td>{{ $point->player->name }}</td>
                                        <td>
                                            {{$point->point_scored}}
                                        </td>
                                        <td>
                                            @if($point->seen)
                                                <span class="glyphicon glyphicon-ok"></span>
                                            @else
                                                <span class="glyphicon glyphicon-remove"></span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($point->winner)
                                                <span class="glyphicon glyphicon-ok"></span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($point->dubli)
                                                <span class="glyphicon glyphicon-ok"></span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach


                                </tbody>
                                <tfoot>
                                <tr class="text-center">
                                </tr>
                                </tfoot>
                            </table>
                            <a class="btn btn-light shadow border offset-md-1"
                               href="{{ route('points.create') }}">Next Round</a>
                            <a class="btn btn-light shadow border offset-md-2" href="{{route('points.table')}}">Total points</a>
                            <a class="btn btn-warning shadow border offset-md-4"
                               href="{{route('games.create')}}">New Game</a>

                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
