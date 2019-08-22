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
                                <span><a href="{{route('admin.add.book')}}">Dodaj książkę</a></span><br/>
                                <span><a href="{{route('admin.list.book')}}">Lista książek</a></span><br/>
                                <span><a href="{{route('admin.categories')}}">Zarządzanie kategoriami</a></span><br/><br/>
                                <span><a href="{{route('admin.index.booking')}}">Wypożyczenie książki</a></span><br/>
                                <span><a href="{{route('admin.index.return')}}">Zwrot książki</a></span><br/><br/>
                                <span><a href="{{route('admin.index.available')}}">Lista dostępnych książek</a></span><br/>
                                <span><a href="{{route('admin.index.return_list')}}">Lista książek do zwrotu</a></span><br/>
                                <span><a href="{{route('admin.bookings.return')}}">Lista wypożyczeń</a></span><br/><br/>
                                <span><a href="{{route('admin.add.user')}}">Dodaj użytkownika</a></span><br/>
                                <span><a href="{{route('admin.index2.user')}}">Lista użytkowników</a></span><br/>
                                <span><a href="{{route('admin.index.user')}}">Konta oczekujące na aktywacje</a></span><br/>
                                <span><a href="{{route('admin.delete_accounts.user')}}">Konta do usunięcia</a></span><br/><br/>
                                <span><a href="{{route('admin.show.arrears_set')}}">Ustawienia kary</a></span><br/><br/>
                                <span><a href="{{route('admin.unpaid.penalties')}}">Nieopłacone kary</a></span><br/>
                                <span><a href="{{route('admin.paid.penalties')}}">Opłacone kary</a></span><br/>

                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
