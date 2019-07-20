@extends('admin.layout.auth')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 ">
                <div class="card">
                    <div class="card-header">Lista</div>
                    <div class="card-body">

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
                                            {!! Form::open(['route'=>['admin.accept.user',$user],'method'=>'post']) !!}
                                            {!! Form::submit('Akceptuj') !!}
                                            {!! Form::close() !!}
                                        </td>
                                        <td>
                                            {!! Form::open(['route'=>['admin.delete.user',$user],'method'=>'delete']) !!}
                                            {!! Form::submit('Odrzuć') !!}
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                            {{$users->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

