@extends('admin.layout.auth')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 ">
                @include('flash-message')
                <div class="card">
                    <div class="card-header">Podsumowanie zwrotu</div>
                    <div class="card-body">
                        <table class="table-responsive">
                                <thead>
                                <tr>
                                    <th>Id wypożyczenia</th>
                                    <th>Nazwa użytkownika</th>
                                    <th>Nr książki</th>
                                    <th>Tytuł książki</th>
                                    <th>Data wypożyczenia</th>
                                    @if($days>0)
                                        <th>Dni spóźnienia:</th>
                                        <th>Wysokość kary</th>
                                    @endif
                                </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{$booking->id}}</td>
                                        <td>{{$booking->user->name}}</td>
                                        <td>{{$booking->book_id}}</td>
                                        <td>{{$booking->book->title}}</td>
                                        <td>{{$booking->date_from}}</td>
                                        @if($days>0)
                                            <td>{{$days}}</td>
                                            <td>{{$days}} zł</td>
                                        @endif

                                    </tr>
                                </tbody>
                        </table>

                        {!! Form::model($booking,['route'=>['admin.return.return',$booking]]) !!}
                        @if($days>0)
                        {!! Form::hidden('days',$days,null) !!}
                        {!! Form::hidden('penalty',$penalty,null) !!}
                        @endif
                        {!! Form::submit('Zwróć książke') !!}
                        {!! Form::close() !!}


                    </div>


                    <br/>
                </div>
            </div>
        </div>
    </div>
    </div>

@endsection
