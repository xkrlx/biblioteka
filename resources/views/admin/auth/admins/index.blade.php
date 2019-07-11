@extends('admin.layout.auth')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 ">
                <div class="card">
                    <div class="card-header">Lista</div>
                    <div class="card-body">

                        <div class="col-12">
                            <a href="{{route('admin.add.admin')}}">Dodaj admina</a>
                            <table class="table-responsive">
                                <thead>
                                <tr>
                                    <th>Imię</th>
                                    <th>Email</th>
                                    <th>Akcje</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($admins as $i =>$admin)
                                    <tr>
                                        <td>{{$admin->name}}</td>
                                        <td>{{$admin->email}}</td>
                                        <td>
                                            <a href="{{route('admin.edit.admin',$admin)}}">Edytuj</a>
                                            {!! Form::open(['route'=>['admin.delete.admin',$admin],'method'=>'delete']) !!}
                                            {!! Form::submit('Usuń') !!}
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                            {{$admins->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
