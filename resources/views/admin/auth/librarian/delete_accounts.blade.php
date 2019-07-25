@extends('admin.layout.auth')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 ">
                @include('flash-message')
                <div class="card">
                    <div class="card-header">Lista kont do usunięcia <b>{{$deletes->total()}}</b></div>
                    <div class="card-body">
                        @if(count($deletes) == 0)
                            <div class="alert alert-warning">
                                <strong>Brak kont do usunięcia</strong>
                            </div>
                        @else
                            <div class="col-12">
                                <a href="{{route('admin.add.user')}}">Stwórz nowego użytkownika</a>
                                <table class="table-responsive">
                                    <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Id użytkownika</th>
                                        <th>Nazwa użytkownika</th>
                                        <th>Email użytkownika</th>
                                        <th>Powód</th>
                                        <th>Data zgłoszenia</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($deletes as $delete)
                                        <tr>
                                            <td>{{$delete->id}}</td>
                                            <td>{{$delete->user_id}}</td>
                                            <td>{{$delete->user->name}}</td>
                                            <td>{{$delete->user->email}}</td>
                                            <td>{{$delete->reason}}</td>
                                            <td>{{$delete->created_at}}</td>

                                            <td>
                                                {!! Form::open(['route'=>['admin.destroy_account.user',$delete->id],'method'=>'delete']) !!}
                                                {!! Form::submit('Usuń') !!}
                                                {!! Form::close() !!}
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>

                                {{$deletes->links()}}
                                @endif
                                <a href="{{route('admin.index.library'),'Powrót'}}">Powrót</a>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

