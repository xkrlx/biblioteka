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
                            {!! Form::model($user,['route'=>['user.confirmdelete',$user]]) !!}
                            <div class="col-sm-12">
                            {!! Form::label('Podaj powód usunięcia konta') !!}
                            </div>
                            <div class="col-sm-12">
                            {!! Form::textarea('reason',null) !!}
                            @if ($errors->has('name'))
                                <span class="help-block">
                <strong>{{ $errors->first('name') }}</strong>
            </span>
                            @endif
                            </div>
                            <div class="col-sm-12">
                                {!! Form::label('Podaj hasło') !!}
                                {!! Form::password('current',null) !!}
                            </div>
                            @if ($errors->has('current'))
                                <span class="help-block">
                <strong>{{ $errors->first('current') }}</strong>
            </span>
                            @endif

                            {!! Form::submit('Zgłoś konto do usunięcia',['class' => 'btn btn-danger']) !!}
                            {!! link_to(route('user.profile'), 'Powrót') !!}
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
