@extends('dashboard.layouts.master')
@section('page-title','Add-Role')
@section('css')
    <link href="{{asset('assets/ltr/css/scrollspyNav.css')}}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="{{asset('assets/ltr/css/forms/theme-checkbox-radio.css')}}" />
    <link href="{{asset('assets/ltr/css/tables/table-basic.css')}}" rel="stylesheet" type="text/css" />
    <style>
        #back_btn{
            margin-top: 25px;
            margin-left: 5px;
        }
        #add_btn{
            float: right;
            margin-right: 10px;
            margin-top: 20px;
        }
        .name{
            margin-left: 10px;
        }
    </style>
@endsection


@section('content')
    <div class="row mt-4">
        <div class="col-8">
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-right">
                    <a class="btn btn-primary" id="back_btn" href="{{ route('roles.index') }}"> Back</a>
                </div>
            </div>
        </div>
        <div class="col-6">
            {!! Form::open(array('route' => 'roles.store','method'=>'POST')) !!}
            <div class="row mt-4">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        @foreach($permission as $value)
                            <label>{{ Form::checkbox('permission[]', $value->id, false, array('class' => 'name')) }}
                                {{ $value->name }}</label>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <button type="submit" class="btn btn-success" id="add_btn">Add</button>
                </div>
            </div>
        </div>
    </div>
@endsection
