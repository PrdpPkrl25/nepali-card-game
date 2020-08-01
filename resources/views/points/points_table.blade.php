@extends('layouts.app')

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
                                <th>Round</th>
                                @foreach($players as $player)
                                <th>{{$player->name}}</th>
                                @endforeach
                                </thead>
                                <tbody>

                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        @foreach($points as $point)
                                        <td>
                                            {{$point}}
                                        </td>
                                        @endforeach
                                    </tr>

                                </tbody>
                                <tfoot>
                                <tr class="text-center">
                                </tr>
                                </tfoot>
                            </table>
                            <a class="btn btn-light shadow border offset-md-1" href="#">PLay Next Round</a>
                            <a class="btn btn-warning shadow border offset-md-6" href="#">Start New Game</a>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
