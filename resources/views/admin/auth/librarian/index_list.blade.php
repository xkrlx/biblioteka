@extends('admin.layout.auth')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 ">
                <div class="card">
                    <div class="card-header">Lista</div>
                    <div class="card-body">

                        <div class="col-12">
                            <a href="{{route('admin.add.book')}}">Dodaj książkę</a>
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
                                        <td>{{$book->id}}</td>
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
                                           <a href="{{route('admin.edit.book',$book)}}">Edytuj</a>
{{--                                            {!! Form::open(['route'=>['admin.delete.book',$admin],'method'=>'delete']) !!}--}}
{{--                                            {!! Form::submit('Usuń') !!}--}}
{{--                                            {!! Form::close() !!}--}}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                            {{$books->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

