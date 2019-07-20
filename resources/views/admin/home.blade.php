@extends('admin.layout.auth')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    You are logged in as Admin!
                    <div class="col-12">
                        @if(Auth::user()->role_id==1)
                            <a href="{{route('admin.index.admin')}}">Panel admina</a>
                            @elseif (Auth::user()->role_id==2)
                                <a href="{{route('admin.index.library')}}">Zarządzanie biblioteką</a>
                            @else (Auth::user()->role_id==3)
                            <a href="{{route('admin.index.viewer')}}">Podgląd biblioteki</a>
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
