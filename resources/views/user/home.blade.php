@extends('user.layout.auth')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            @include('flash-message')
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    You are logged in as {{Auth::user()->name}}!

                    <div class="col-12">

                        <table class="table-responsive">
                            <span><a href="{{route('user.profile')}}">Mój profil</a></span><br/>
                            <span><a href="{{route('user.bookings')}}">Aktywne wypożyczenia</a></span><br/>
                            <span><a href="{{route('user.oldbookings')}}">Zakończone wypożyczenia</a></span><br/>
                            <span><a href="{{route('user.penalties')}}">Kary</a></span><br/>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
