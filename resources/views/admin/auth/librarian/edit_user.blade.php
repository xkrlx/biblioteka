@extends('admin.layout.auth')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 ">
                @include('flash-message')
                <div class="card">
                    <div class="card-header">Dodaj</div>
                    <div class="card-body">
                        <div class="col-12">
                            {!! Form::model($user,['route'=>['admin.update.user',$user]]) !!}
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
{{--                            {!! Form::password('password',['placeholder'=>'hasło']) !!}--}}
{{--                            @if ($errors->has('password'))--}}
{{--                                <span class="help-block">--}}
{{--                <strong>{{ $errors->first('password') }}</strong>--}}
{{--            </span>--}}
{{--                            @endif--}}
{{--                            {!! Form::password('password_confirmation',['placeholder'=>'powtórz hasło']) !!}--}}

                            {!! Form::number('pesel',null,['placeholder'=>'pesel']) !!}
                            @if ($errors->has('pesel'))
                                <span class="help-block">
                <strong>{{ $errors->first('pesel') }}</strong>
            </span>
                            @endif

                            {!! Form::submit('Zapisz zmiany') !!}
                            {!! link_to(route('admin.index2.user'), 'Powrót') !!}
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
