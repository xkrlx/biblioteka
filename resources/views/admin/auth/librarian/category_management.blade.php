@extends('admin.layout.auth')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 ">
                @include('flash-message')
                <div class="card">
                    <div class="card-header">Kategorie</div>
                    <h1>Aktywne kategorie</h1>
                    <div class="col-12">
                        @foreach($categories as $category)
                            @if($category->active==true)
                                <li>{{$category->id}}. {{$category->name}}
                                    {!! Form::open(['route'=>['admin.change.categories',$category],'method'=>'post']) !!}
                                    {!! Form::submit('Wyłącz kategorie') !!}
                                    {!! Form::close() !!}</li>
                            @endif
                            @endforeach
                    </div>

                    <div class="card-body">
                            {!! Form::open(['route'=>'admin.add.categories']) !!}
                        <div class="col-12">
                            {!! Form::text('name',null,['placeholder'=>'Nazwa kategorii']) !!}
                            @if ($errors->has('name'))
                                <span class="help-block">
                <strong>{{ $errors->first('title') }}</strong>
                            @endif
                        </div>
                        <div class="col-12">
                            {!! Form::submit('dodaj') !!}
                            {!! link_to(route('admin.index.library'), 'Powrót') !!}
                            {!! Form::close() !!}
                        </div>
                    </div>
                    <h1>Nieaktywne kategorie</h1>
                    @foreach($categories as $category)
                        @if($category->active==false)
                            <li>{{$category->id}}. {{$category->name}}
                                {!! Form::open(['route'=>['admin.change.categories',$category],'method'=>'post']) !!}
                                {!! Form::submit('Włącz kategorie') !!}
                                {!! Form::close() !!}</li>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>

@endsection
