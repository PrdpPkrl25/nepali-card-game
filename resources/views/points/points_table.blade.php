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
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($game->rounds as $round)
                                    <tr>
                                        <td>{{ $round->id }}</td>
                                        @foreach($round -> points as $point)
                                            <td>{{ $point->point_scored }}</td>
                                        @endforeach
                                        <td>
                                            <button class="ml-2 btn btn-danger remove_round"
                                                     value="{{$round->id}}"><i class="fa fa-remove"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach


                                </tbody>
                            <tfoot>
                                <tr class="text-center">
                                    <th>Total Point: </th>
                                    @foreach($game->players as $player)
                                    <th></th>
                                    @endforeach
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
<script type="text/javascript">

    $(document).ready(function () {
        $(".remove_round").on('click', function (e) {
            e.preventDefault();
           if(confirm('Continue to delete')) {
               var roundId = $(this).attr('value');
               $.ajax({
                   type: 'POST',
                   url: '/points/delete/' + roundId,
                   headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
                   dataType: 'html',
                   success: function (data) {
                       location.reload();
                   },
               })
               ;
           }

        });
    });


    $(document).ready(function() {
        $('#table').DataTable();
    } );



</script>
@endsection
