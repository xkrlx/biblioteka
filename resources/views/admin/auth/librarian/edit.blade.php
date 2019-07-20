@extends('admin.layout.auth')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 ">
                <div class="card">
                    <div class="card-header">Edytuj książke</div>
                    <div class="card-body">
                        <div class="col-12">
                            Numer książki: {{$book->id}}
                        </div>

                        <div class="col-12">
                            {!! Form::model($book,['route'=>['admin.update.book',$book], 'files'=>true]) !!}
                            {!! Form::text('title',null,['placeholder'=>'Tytuł']) !!}
                            @if ($errors->has('title'))
                                <span class="help-block">
                <strong>{{ $errors->first('title') }}</strong>
                            @endif
                        </div>
                        <div class="col-12">
                            {!! Form::number('year',null,['placeholder'=>'Rok wydania']) !!}
                            @if ($errors->has('year'))
                                <span class="help-block">
                <strong>{{ $errors->first('year') }}</strong>
                            @endif
                        </div>
                        <div class="col-12">
                            {!! Form::text('author',null,['placeholder'=>'Autor']) !!}
                            @if ($errors->has('author'))
                                <span class="help-block">
                <strong>{{ $errors->first('author') }}</strong>
                            @endif
                        </div>
                        <div class="col-12">
                            {!! Form::text('publisher',null,['placeholder'=>'wydawca']) !!}
                            @if ($errors->has('publisher'))
                                <span class="help-block">
                <strong>{{ $errors->first('publisher') }}</strong>
                            @endif
                        </div>
                        <div class="col-12">
                            {!! Form::number('pages',null,['placeholder'=>'Ilość stron']) !!}
                            @if ($errors->has('pages'))
                                <span class="help-block">
                <strong>{{ $errors->first('pages') }}</strong>
                            @endif
                        </div>

                        <div class="col-12">
                            {!! Form::textarea('description',null,['placeholder'=>'Opis']) !!}
                            @if ($errors->has('description'))
                                <span class="help-block">
                <strong>{{ $errors->first('description') }}</strong>
                            @endif
                        </div>

                        @if($book->photo)
                        <img height="300px" class="figure-img" src="/images/covers/{{$book->photo}}">
                            <div class="col-12">
                                {!! Form::label('Zmień zdjęcie okładki:',null) !!}
                                {!! Form::file('photo',null) !!}
                            </div>
                            @if ($errors->has('photo'))
                                <span class="help-block">
                <strong>{{ $errors->first('photo') }}</strong>
                            @endif
                                    @else
                            <div class="col-12">
                            {!! Form::label('Dodaj zdjęcie okładki:',null) !!}
                            {!! Form::file('photo',null) !!}
                            </div>
                            @if ($errors->has('photo'))
                            <span class="help-block">
                <strong>{{ $errors->first('photo') }}</strong>
                            @endif
                        @endif


                        <div class="col-12">
                            {!! Form::submit('Zapisz zmiany') !!}
                            {!! link_to(route('admin.list.book'), 'Powrót') !!}
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

