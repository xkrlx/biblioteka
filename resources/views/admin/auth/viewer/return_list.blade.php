@extends('admin.layout.auth')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 ">
                @include('flash-message')
                <div class="card">
                    <div class="card-header">
                        Lista wypożyczonych książek <b>{{$books->total()}}</b>
                    </div>
                    <div class="card-body">
                        @if(count($books) == 0)
                            <div class="alert alert-warning">
                                <strong>Brak danych do wyświetlenia</strong>
                            </div>
                        @else
                            <div class="col-12">
                                <table class="table-responsive">
                                    <thead>
                                    <tr>
                                        <th>Numer książki</th>
                                        <th>Tytuł</th>
                                        <th>Rok wydania</th>
                                        <th>Autor</th>
                                        <th>Wydawnictwo</th>
                                        <th>Opis</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($books as $i =>$book)
                                        <tr>
                                            <td>{{$book->book_id}}</td>
                                            <td>{{$book->title}}</td>
                                            <td>{{$book->year}}</td>
                                            <td>{{$book->author}}</td>
                                            <td>{{$book->publisher}}</td>
                                            <td>{{$book->description}}</td>
                                            @if($book->photo)
                                                <td><img height="300px" width="405px" class="figure-img" src="/images/covers/{{$book->photo}}"></td>
                                            @else
                                                <td>Brak zdjęcia okładki</td>
                                            @endif

                                            <td>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>

                                {{$books->links()}}
                                @endif

                                <a href="{{route('admin.index.viewer'),'Powrót'}}">Powrót</a>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

