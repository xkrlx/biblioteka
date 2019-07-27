@extends('admin.layout.auth')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 ">
                @include('flash-message')
                <div class="card">
                    <div class="card-header">Akcje</div>
                    <div class="card-body">

                        <div class="col-12">

                            <table class="table-responsive">
                                <span><a href="{{route('admin.book_list.viewer')}}">Lista książek</a></span><br/><br/>
                                <span><a href="{{route('admin.available.viewer')}}">Lista dostępnych książek</a></span><br/>
                                <span><a href="{{route('admin.return_list.viewer')}}">Lista książek do zwrotu</a></span><br/>
                                <span><a href="{{route('admin.bookings.viewer')}}">Lista wypożyczeń</a></span><br/><br/>
                                <span><a href="{{route('admin.unpaid.viewer')}}">Nieopłacone kary</a></span><br/>
                                <span><a href="{{route('admin.paid.viewer')}}">Opłacone kary</a></span><br/>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
