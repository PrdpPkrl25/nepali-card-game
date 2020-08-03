@extends('layout')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card align-content-between" style="margin-top: 80px">
                    <div class="card-header">Points Table:</div>
                    <div class="card-body">
                        <div class="row text-center">
                            <table class="table table-bordered table-hover text-center table-striped" id="mytable">
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
                                        <td>{{ $loop->iteration }}</td>
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
                                    <th>{{totalPoint($roundIdArray,$player->id)}}</th>
                                    @endforeach
                                    <th></th>

                                </tr>

                                <tr class="text-center">
                                    <th>Total Amount: </th>
                                    @foreach($game->players as $player)
                                        <th>{{totalAmount($roundIdArray,$player->id,$game)}}</th>
                                    @endforeach
                                    <th></th>

                                </tr>

                                </tfoot>
                            </table>
                        </div>
                        <div class="row text-center">
                                <div class="col-md-6">
                                    @if(session()->has('game'))
                                        <a class="btn btn-light shadow border "
                                           href="{{ route('points.create') }}">Play Next Round</a>
                                    @endif
                                </div>
                                <div class="col-md-6">
                                    <a class="btn btn-warning shadow border "
                                       href="{{route('games.create')}}">Start New Game</a>
                                </div>

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






</script>
@endsection
