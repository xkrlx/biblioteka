@extends('admin.layout.auth')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 ">
                @include('flash-message')
                <div class="card">
                    <div class="card-header">Lista wypożyczonych książek</div>
                    <div class="card-body">

                        <div class="col-12">


                                @foreach($bookings as $booking)
                                    <div class="col-12">
                                        Id wypożyczenia: {{$booking->id}}
                                        Id książki:{{$booking->book_id}}
                                        Data wypożyczenia: {{$booking->date_from}}


                                        <a href="{{route('admin.confirm.return',$booking)}}">Zwróć książke</a>
                                    </div>


                                @endforeach



                            <a href="{{route('admin.index.return'),'Powrót'}}">Powrót</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

