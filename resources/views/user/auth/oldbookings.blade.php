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
                                <thead>
                                <tr>
                                    <th>Id wypożyczenia</th>
                                    <th>Id użytkownika</th>
                                    <th>Nazwa użytkownika</th>
                                    <th>Numer książki</th>
                                    <th>Tytuł książki</th>
                                    <th>Data wypożyczenia</th>
                                    <th>Data zwrotu</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($bookings as $i =>$booking)
                                    <tr>
                                        <td>{{$booking->id}}</td>
                                        <td>{{$booking->user_id}}</td>
                                        <td>{{$booking->user->name}}</td>
                                        <td>{{$booking->book_id}}</td>
                                        <td>{{$booking->book->title}}</td>
                                        <td>{{$booking->date_from}}</td>
                                        <td>{{$booking->date_to}}</td>

                                        <td>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                            {{$bookings->links()}}

                            <a href="{{route('user.home'),'Powrót'}}">Powrót</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

