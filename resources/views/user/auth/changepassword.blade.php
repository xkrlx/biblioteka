@extends('user.layout.auth')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 ">
                @include('flash-message')
                <div class="card">
                    <div class="card-header">Zmień hasło</div>
                    <div class="card-body">
                        <div class="col-12">

                            @if(Auth::user()->id==$user->id)
                                {!! Form::open(['route' => ['user.updatepassword', $user]] ) !!}

                                @if ($errors->any())
                                    @foreach ($errors->all() as $error)
                                        <div class="btn btn-danger btn-xl js-scroll-trigger">{{ $error }}</div>
                                    @endforeach
                                @endif

                                <div class="col-sm-12">
                                    {!! Form::password('current', ['placeholder'=>"Stare hasło"]) !!}
                                </div>
                                <br/>
                                <div class="col-sm-12">
                                    {!! Form::password('password',['placeholder'=>"Nowe hasło"]) !!}
                                </div>

                                <div class="col-sm-12">
                                    {!! Form::password('password_confirmation', ['placeholder'=>"Powtórz nowe hasło"]) !!}
                                </div>

                                <br/>

                                <div class="col-sm-12">
                                    {!! Form::submit('Zmień hasło', ['class'=>'btn load-more-btn']) !!}
                                    {!! link_to(URL::previous(), 'Powrót', ['class' => 'btn load-more-btn']) !!}
                                </div>

                                {!! Form::close() !!}
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
