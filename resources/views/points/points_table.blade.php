@extends('layout')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card align-content-between">
                    <div class="card-header">Points Table:</div>
                    <div class="card-body">
                        <div class="row text-center">
                            <table class="table table-bordered table-hover text-center table-striped">
                                <thead>
                                <tr>
                                    <th>S. No.</th>
                                    <th>Name</th>
                                    <th>Scored</th>
                                    <th>Seen</th>
                                    <th>Winner</th>
                                    <th>Dubli</th>
                                </tr>
                                </thead>
                                <tbody>


                                {{-- <td>{{$loop->iteration}}</td>--}}
                                @foreach($points as $point)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $point->player->name }}</td>
                                        <td>
                                            {{$point->point_scored}}
                                        </td>
                                        <td>
                                            {{$point->seen}}
                                        </td>
                                        <td>
                                            {{$point->winner}}
                                        </td>
                                        <td>
                                            {{$point->dubli}}
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
                               href="{{ route('points.create') }}">Play Next Round</a>
                            {{--<a class="btn btn-light shadow border offset-md-2" href="">Show total points</a>--}}
                            <a class="btn btn-warning shadow border offset-md-6"
                               href="{{route('games.create')}}">Start New Game</a>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
