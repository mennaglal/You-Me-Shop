@extends('admin.layouts.master')
@section('page-title','Add-Product')
@section('css')
    <link href="{{asset('assets/ltr/css/scrollspyNav.css')}}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="{{asset('assets/ltr/css/forms/theme-checkbox-radio.css')}}" />
    <link href="{{asset('assets/ltr/css/tables/table-basic.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/ltr/plugins/file-upload/file-upload-with-preview.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/ltr/plugins/select2/select2.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/ltr/css/forms/switches.css')}}" rel="stylesheet" type="text/css" />
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
            <a class="btn btn-primary mb-4" id="back_btn" href="{{ route('products.index') }}">Back</a>
            <form method="post"action="{{route('products.store')}}" enctype="multipart/form-data">
                {{csrf_field()}}

                <div class="form-group">
                    <select class="selectpicker form-control mb-4" name="category_id" required>
                        <option selected disabled>Select Category</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name}}</option>
                        @endforeach
                    </select>
                    <input id="name" type="text" name="name" placeholder="Product Name" class="form-control  mb-4" required >
                    <div class="input-group mb-4 mt-4">
                        <textarea name="description" id="description" class="form-control" placeholder="Product Description"></textarea>
                    </div>
                    <input id="price" type="text" name="price" placeholder="Product Price" class="form-control mb-4" required >
                    <input id="weight" type="text" name="weight" placeholder="Product Weight" class="form-control mb-4" required >
                    <select class="selectpicker form-control mb-4" name="shipping_rates_id" required>
                        <option selected disabled>Select Shipping Country</option>
                        @foreach ($shipping_rates as $shipping_rate)
                            <option value="{{ $shipping_rate->id }}">{{ $shipping_rate->country}}</option>
                        @endforeach
                    </select>
                    <div class="row">
                        <div class="col">
                            <div class="custom-file-container mt-4" data-upload-id="myFirstImage">
                                <label>Upload Product Image(Single File) <a href="javascript:void(0)" class="custom-file-container__image-clear" title="Clear Image">x</a></label>
                                <label class="custom-file-container__custom-file" >
                                    <input name="image" type="file" class="custom-file-container__custom-file__custom-file-input" accept="image/*">
                                    <input type="hidden" name="MAX_FILE_SIZE" value="1048576" />
                                    <span  class="custom-file-container__custom-file__custom-file-control"></span>
                                </label>
                                <div class="custom-file-container__image-preview"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                            <button type="submit" class="btn btn-success mt-5" id="add_btn">Add</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
@section('js')
    <script src="{{asset('assets/ltr/js/scrollspyNav.js')}}"></script>
    <script>
        checkall('todoAll', 'todochkbox');
        $('[data-toggle="tooltip"]').tooltip()
    </script>
    <script src="{{asset('assets/ltr/plugins/file-upload/file-upload-with-preview.min.js')}}"></script>
    <script src="{{asset('assets/ltr/plugins/highlight/highlight.pack.js')}}"></script>
    <script src="{{asset('assets/ltr/plugins/select2/select2.min.js')}}"></script>
    <script src="{{asset('assets/ltr/plugins/select2/custom-select2.js')}}"></script>

    <script>
        //First upload
        var firstUpload = new FileUploadWithPreview('myFirstImage')

    </script>
@endsection

