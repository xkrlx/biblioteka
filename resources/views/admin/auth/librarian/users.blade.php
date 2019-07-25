@extends('admin.layout.auth')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 ">
                @include('flash-message')
                <div class="card">
                    <div class="card-header">Lista użytkowników <b>{{$users->total()}}</b></div>
                    <div class="card-body">
                        @if(count($users) == 0)
                            <div class="alert alert-warning">
                                <strong>Brak danych do wyświetlenia</strong>
                            </div>
                        @else
                        <div class="col-12">
                            <a href="{{route('admin.add.user')}}">Stwórz nowego użytkownika</a>
                            <table class="table-responsive">
                                <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Nick</th>
                                    <th>Pesel</th>
                                    <th>Email</th>
                                    <th>Data utworzenia konta</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td>{{$user->id}}</td>
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->pesel}}</td>
                                        <td>{{$user->email}}</td>
                                        <td>{{$user->created_at}}</td>

                                        <td>
                                            {!! Form::open(['route'=>['admin.edit.user',$user],'method'=>'get']) !!}
                                            {!! Form::submit('Edytuj') !!}
                                            {!! Form::close() !!}
                                        </td>
                                        <td>
                                            {!! Form::open(['route'=>['admin.delete.user',$user],'method'=>'delete']) !!}
                                            {!! Form::submit('Usuń użytkownika') !!}
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                            {{$users->links()}}
                            @endif
                            <a href="{{route('admin.index.library'),'Powrót'}}">Powrót</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

