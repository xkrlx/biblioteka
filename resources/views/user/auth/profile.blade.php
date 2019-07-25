@extends('user.layout.auth')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 ">
                @include('flash-message')
                <div class="card">
                    <div class="card-header">Moje konto</div>
                    <div class="card-body">
                      <div class="col-12">
                          <div class="col-lg-6 col-md-3"><h3 class="title">Nazwa: <b>{{$user->name}}</b></h3></div>
                          <div class="col-lg-6 col-md-3"><h3 class="title">Email: <b>{{$user->email}}</b></h3></div>
                          <div class="col-lg-6 col-md-3"><h3 class="title">Pesel: <b>{{$user->pesel}}</b></h3></div>
                          @if(Auth::user()->id==$user->id)
                              {!! Form::open(['route'=>['user.edit.profile',$user],'method'=>'get']) !!}
                              {!! Form::submit('Edytuj',['class' => 'btn btn-load-more']) !!}
                              {!! Form::close() !!}

                              {!! Form::open(['route'=>['user.changepassword',$user],'method'=>'get']) !!}
                              {!! Form::submit('Zmień hasło',['class' => 'btn btn-load-more']) !!}
                              {!! Form::close() !!}

                              {!! Form::open(['route'=>['user.delete',$user],'method'=>'get']) !!}
                              {!! Form::submit('Usuń konto',['class' => 'btn btn-danger']) !!}
                              {!! Form::close() !!}

                              {!! link_to(route('user.home'), 'Powrót') !!}
                          @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
