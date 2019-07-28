@extends('admin.layout.auth')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 ">
                <div class="card">
                    <div class="card-header">Ustaw wysokość kary za dzień</div>
                    <div class="card-body">
                        <div class="col-12">
                            <table class="table-responsive">
                                <thead>
                                <tr>
                                    <th>Do ilu dni:</th>
                                    <th>Koszt za dzień</th>
                                </tr>
                                </thead>
                                <tbody>
                            @foreach($arrearSettings as $arrearSetting)
                                <tr>
                                    <td>{{$arrearSetting->days}}</td>
                                    <td>
                                        {!! Form::model($arrearSetting,['route'=>['admin.update.arrears_set',$arrearSetting]]) !!}
                                        {!! Form::hidden('days') !!}
                                        {!! Form::number('cost_per_day',null,['step' => '0.01']) !!}
                                        @if ($errors->has('cost_per_day'))
                                            <span class="help-block">
                                    <strong>{{ $errors->first('cost_per_day') }}</strong>
                                </span>
                                        @endif

                                        {!! Form::submit('Ustaw') !!}
                                        {!! Form::close() !!}
                                    </td>
                                </tr>

                            @endforeach
                                </tbody>
                            </table>
                                {!! link_to(route('admin.index.library'), 'Powrót') !!}


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
