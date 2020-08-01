@extends('layout')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card align-content-between">
                    <div class="card-header">Points Table:</div>
                    <div class="card-body">
                        <div class="row text-center">
                            <table class="table table-bordered table-hover text-center table-striped" id="table">
                                <thead>
                                <tr>
                                    <th>Round</th>
                                    @foreach($game->players as $player)
                                        <th>{{ $player->name }}</th>
                                    @endforeach
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($game->rounds as $round)
                                    <tr>
                                        <td>{{ $round->id }}</td>
                                        @foreach($round -> points as $point)
                                            <td>{{ $point->point_scored }}</td>
                                        @endforeach
                                    </tr>
                                @endforeach


                                </tbody>
                                <tfoot>
                                <tr class="text-center">
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>

                                </tr>

                                </tfoot>
                            </table>
                            <a class="btn btn-light shadow border offset-md-1"
                               href="{{ route('points.create') }}">Play Next Round</a>
                            <a class="btn btn-warning shadow border offset-md-6"
                               href="{{route('games.create')}}">Start New Game</a>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
<script>
    $(document).ready(function() {
        $('#table').DataTable();
    } );
</script>
@endsection
