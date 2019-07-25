@extends('admin.layout.auth')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 ">
                @include('flash-message')
                <div class="card">

                    <div class="card-body">

                        <div class="col-12">
                            <div class="col-12">
                                Numer książki: <b>{{$book->book_id}}</b>
                            </div>
                            <div class="col-12">
                                Tytuł: <b>{{$book->title}}</b>
                            </div>
                            <div class="col-12">
                                Autor: <b>{{$book->author}}</b>
                            </div>
                            <div class="col-12">
                                Rok wydania: <b>{{$book->year}}</b>
                            </div>
                            <div class="col-12">
                                Wydawnictwo: <b>{{$book->publisher}}</b>
                            </div>
                            <div class="col-12">
                                Opis: <b>{{$book->description}}</b>
                            </div>
                            <div class="col-12">
                                @if($book->photo)
                                    <td><img height="300px" width="405px" class="figure-img" src="/images/covers/{{$book->photo}}"></td>
                                @else
                                    <td>Brak zdjęcia okładki</td>
                                @endif
                            </div>

                            <a href="{{ URL::previous() }}">Powrót</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

