@extends('user.layout.auth')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 ">
                @include('flash-message')
                <div class="card">
                    <div class="card-header">Edytuj dane</div>
                    <div class="card-body">
                        <div class="col-12">
                            {!! Form::model($user,['route'=>['user.update.profile',$user]]) !!}
                            {!! Form::text('name',null,['placeholder'=>'imię']) !!}
                            @if ($errors->has('name'))
                                <span class="help-block">
                <strong>{{ $errors->first('name') }}</strong>
            </span>
                            @endif
                            {!! Form::email('email',null,['placeholder'=>'email']) !!}
                            @if ($errors->has('email'))
                                <span class="help-block">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
                            @endif
                            {!! Form::number('pesel',null,['placeholder'=>'pesel']) !!}
                            @if ($errors->has('pesel'))
                                <span class="help-block">
                <strong>{{ $errors->first('pesel') }}</strong>
            </span>
                            @endif
                            <div class="col-sm-12">
                                {!! Form::label('Podaj hasło') !!}
                                {!! Form::password('current',null) !!}
                            </div>
                            @if ($errors->has('current'))
                                <span class="help-block">
                <strong>{{ $errors->first('current') }}</strong>
            </span>
                            @endif

                            {!! Form::submit('Zapisz zmiany') !!}
                            {!! link_to(route('user.profile'), 'Powrót') !!}
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
