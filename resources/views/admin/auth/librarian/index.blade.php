@extends('admin.layout.auth')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 ">
                <div class="card">
                    <div class="card-header">Akcje</div>
                    <div class="card-body">

                        <div class="col-12">

                            <table class="table-responsive">
                                <span><a href="{{route('admin.add.book')}}">Dodaj książkę</a></span><br/>
                                <span><a href="{{route('admin.list.book')}}">Lista książek</a></span><br/>
                                <span><a href="route">Wypożyczenie książki</a></span><br/>
                                <span><a href="route">Zwrot książki</a></span><br/>
                                <span><a href="route">Lista książek do zwrotu</a></span><br/>
                                <span><a href="{{route('admin.add.user')}}">Dodaj użytkownika</a></span><br/>
                                <span><a href="{{route('admin.index.user')}}">Konta oczekujące na aktywacje</a></span><br/>
                                <span><a href="{{route('admin.index2.user')}}">Lista użytkowników</a></span><br/>
                                <tbody>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
