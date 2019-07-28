@extends('admin.layout.auth')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 ">
                <div class="card">
                    <div class="card-header">Długść {{$arrearSetting->days}} dni</div>
                    <div class="card-body">
                        <div class="col-12">
                            {!! Form::model($arrearSetting,['route'=>['admin.update.admin',$arrearSetting]]) !!}

                            {!! Form::label('Koszt:') !!}
                            {!! Form::number('cost_per_day',$arrearSetting) !!}
                            @if ($errors->has('cost_per_day'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('cost_per_day') }}</strong>
                                </span>
                            @endif

                            {!! Form::submit('zapisz') !!}
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
