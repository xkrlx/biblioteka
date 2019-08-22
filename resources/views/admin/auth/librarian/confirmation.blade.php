@extends('admin.layout.auth')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 ">

                @include('flash-message')

                <div class="card">
                    <div class="card-header">Dane wypożyczającego</div>
                    <div class="card-body">
                        <div class="col-12">
                           <b>Id:</b> {{$user->id}}
                        </div>
                        <div class="col-12">
                           <b>Nazwa:</b> {{$user->name}}
                        </div>
                        <div class="col-12">
                           <b>Email:</b> {{$user->email}}
                        </div>


                    </div>
                    </div>
                    <div class="card">
                        <div class="card-header">Informacje o książce</div>
                        <div class="card-body">

                                <div class="col-12">
                                <b>Numer:</b> {{$book->book_id}}
                                </div>
                                <div class="col-12">
                                <b>Tytuł:</b> {{$book->title}}
                                </div>
                                <div class="col-12">
                                <b>Autor:</b> {{$book->author}}
                                </div>
                                <div class="col-12">
                                <b>Kategoria:</b> {{$book->category->name}}
                                </div>
                                <div class="col-12">
                                <b>Wydawca:</b> {{$book->publisher}}
                                </div>
                                <div class="col-12">
                                <b>Opis:</b> {{$book->description}}
                                </div>
                                <div class="col-12">
                                    @if($book->photo)
                                        <td><img height="300px" width="405px" class="figure-img" src="/images/covers/{{$book->photo}}"></td>
                                    @else
                                        <td>Brak zdjęcia okładki</td>
                                    @endif
                                </div>
                                <div class="col-12">
                                    {!! Form::model([$user,$book],['route'=>['admin.book.booking',$user,$book]]) !!}
                                    {!! Form::hidden('user_id',$user->id,null) !!}
                                    {!! Form::hidden('book_id',$book->book_id,null) !!}
                                    {!! Form::submit('Wypożycz książke') !!}
                                    {!! Form::close() !!}
                                </div>

            </div>
        </div>
    </div>
    </div>

@endsection
