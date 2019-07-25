@extends('admin.layout.auth')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 ">
                @include('flash-message')
                <div class="card">
                    <div class="card-header">Wypożyczanie książki</div>
                    <div class="card-body">
                        <div class="col-12">
                        {!! Form::open(['route'=>'admin.confirm.booking']) !!}
                        {!! Form::label('Id użytkownika:') !!}
                        {!! Form::number('user_id',null) !!}
                        @if ($errors->has('user_id'))
                        <span class="help-block">
                            <strong>{{ $errors->first('user_id') }}</strong>
                        </span>
                        @endif
                        </div>
                        <div class="col-12">
                        {!! Form::label('Numer książki:') !!}
                        {!! Form::number('book_id',null) !!}
                        @if ($errors->has('book_id'))
                            <span class="help-block">
                            <strong>{{ $errors->first('book_id') }}</strong>
                        </span>
                        @endif
                        </div>
                        <div class="col-12">
                        {!! Form::submit('Podsumowanie') !!}
                        {!! link_to(route('admin.index.library'), 'Powrót') !!}
                        </div>

                        {!! Form::close() !!}
                        </div>


                    <br/>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
