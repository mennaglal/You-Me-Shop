@extends('dashboard.layouts.master')
@section('page-title','Edit-Category')
@section('css')
    <link href="{{asset('assets/ltr/css/scrollspyNav.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/ltr/css/tables/table-basic.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/ltr/css/forms/switches.css')}}" rel="stylesheet" type="text/css" />


    <style>
        #back_btn{
            margin-top: 25px;
            margin-left: 5px;
        }
        #edit_btn{
            float: right;
            margin-right: 10px;
            margin-top: 20px;
        }
    </style>
@endsection
@section('content')
    <div class="row mt-4">
        <div class="col-11 m-3">
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

    <div class="row">
        <div class="col-lg-6 col-12 mx-auto">
            <a class="btn btn-primary mb-4" id="back_btn" href="{{ route('categories.index') }}">Back</a>
            <form method="post"action="{{route('categories.update',$category->id)}}" enctype="multipart/form-data">
                {{ method_field('patch') }}
                {{csrf_field()}}
                <div class="form-group">
                    <input id="name" type="text" name="name" placeholder="Category Name" class="form-control  mb-4" required  value="{{$category->name}}">
                    <div class="input-group mb-4 mt-4">
                        <textarea name="description" id="description" class="form-control" placeholder="Category Description">{{$category->description}}</textarea>
                    </div>
                    <div class="row mb-4">
                        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                            <button type="submit" class="btn btn-success mt-5" id="add_btn">Save</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    </div>
@endsection
@section('js')
    <script src="{{asset('assets/ltr/js/scrollspyNav.js')}}"></script>
@endsection
