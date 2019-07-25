@extends('admin.layout.auth')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 ">
                @include('flash-message')
                <div class="card">
                    <div class="card-header">Zwrot książki</div>
                    <div class="card-body">
                        <div class="col-12">
                            {!! Form::open(['route'=>'admin.index_books.return']) !!}
                            {!! Form::label('Podaj id użytkownika zwracającego książke:') !!}
                            {!! Form::number('user_id',null) !!}
                            @if ($errors->has('user_id'))
                                <span class="help-block">
                            <strong>{{ $errors->first('user_id') }}</strong>
                        </span>
                            @endif
                        </div>
                        <div class="col-12">
                            {!! Form::submit('Przejdź dalej ') !!}
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
