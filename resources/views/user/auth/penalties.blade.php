@extends('user.layout.auth')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 ">
                @include('flash-message')
                <div class="card">
                    <div class="card-header">
                        Lista wypożyczonych książek
                    </div>
                    <div class="card-body">

                        <div class="col-12">
                            <table class="table-responsive">
                                @if(count($penalties) == 0)
                                    <div class="alert alert-warning">
                                        <strong>Nie masz żadnych kar</strong>
                                    </div>
                                @else

                                    <thead>
                                    <tr>
                                        <th>Id kary</th>
                                        <th>Id wypożyczenia</th>
                                        <th>Wysokość (zł)</th>
                                        <th>Ilość dni spóźnienia</th>
                                        <th>Opłacona</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($penalties as $penalty)
                                        <tr>
                                            <td>{{$penalty->id}}</td>
                                            <td>{{$penalty->booking_id}}</td>
                                            <td>{{$penalty->cost}}</td>
                                            <td>{{$penalty->days}}</td>
                                            @if($penalty->paid_status==0) <td>nie</td>
                                            @else <td>tak</td>
                                            @endif
                                        </tr>
                                    @endforeach
                                    </tbody>
                            </table>

                            {{$penalties->links()}}
                            @endif

                            <a href="{{route('user.home'),'Powrót'}}">Powrót</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

