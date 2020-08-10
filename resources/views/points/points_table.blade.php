@extends('layout')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card align-content-between" style="margin-top: 80px;padding: 20px">
                <div class="card-header">Points Table:</div>
                <div class="card-body">
                    <div class="row ">
                        <table class="table table-bordered table-hover table-striped" style="vertical-align: center">
                            <thead>
                            <tr>
                                <th>Round</th>
                                @foreach($game->players as $player)
                                    <th>{{ $player->name }}</th>
                                @endforeach
                                @if(session()->has('game'))
                                    <th></th>
                                @endif

                            </tr>
                            </thead>

                            <tbody>
                            @foreach($game->rounds as $round)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    @foreach($round -> points as $point)
                                        <td>{{ $point->point_scored }}</td>
                                    @endforeach
                                    @if(session()->has('game'))
                                        <td>
                                            <p class="ml-2 remove_round "
                                               style="color: red;font-weight: bolder;font-size: 14px;cursor: pointer"
                                               value="{{$round->id}}"><i class="fa fa-remove"></i>
                                            </p>
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                            </tbody>

                            <tfoot>
                            <tr class="text-center">
                                <th>Point:</th>
                                @foreach($game->players as $player)
                                    <th>{{totalPoint($roundIdArray,$player->id)}}</th>
                                @endforeach
                                @if(session()->has('game'))
                                    <th></th>
                                @endif
                            </tr>

                            <tr class="text-center">
                                <th>Amount:</th>
                                @foreach($game->players as $player)
                                    <th>{{totalAmount($roundIdArray,$player->id,$game)}}</th>
                                @endforeach
                                @if(session()->has('game'))
                                    <th></th>
                                @endif
                            </tr>
                            </tfoot>
                        </table>
                    </div>

                    <a class="btn btn-warning shadow border "
                       href="{{route('games.create')}}">New Game</a>

                    @if(session()->has('game'))
                        <a class="btn btn-light shadow border offset-3"
                           href="{{ route('points.create') }}">Next Round</a>
                    @endif
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
                if (confirm('Continue to delete')) {
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
