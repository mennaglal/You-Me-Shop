
@extends("visitor.layouts.master")

@section('page-title')
    {{$product->name}}
@endsection

@section('css')
    <link href="{{asset('front_assets/product_details.css')}}" rel="stylesheet" type="text/css" />
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.min.css" rel="stylesheet">

@endsection
@section('content')
    <main>

        <!-------------- begin products menu --------------->

                <div class="container mb-5 mt-5">
                    <h1 class="products_menu mt-3 mb-3">{{$product->name .' Info'}}</h1>

                    <div class="row featurette mt-5">
                        <div class="col-md-7 order-md-2 product_details_container mb-3">
                            <h2 class="featurette-heading fw-normal lh-1 product_details_name">{{$product->name}}</span></h2>
                            <p class="lead">{{$product->description}}.</p>
                            <p class="card-text ">Weight is <span class="product_number">{{$product->weight}}</span> kg</p>
                           <div>
                               <span class="product_price ">{{$product->price}} $</span>
                               <form id="AddToCart_form">
                                   @csrf
                                   <input type="hidden" value="{{ $product->id }}" name="id">
                                   <input type="hidden" value="{{ $product->name }}" name="name">
                                   <input type="hidden" value="{{ $product->weight}}" name="weight">
                                   <input type="hidden" value="{{ $product->price }}" name="price">
                                   <input type="hidden" value="{{ $product->description }}" name="description">
                                   <input type="hidden" value="{{ $product->shipping_rate_id}}" name="shipping_rate_id">
                                   <input type="hidden" value="{{ $product->image }}"  name="image">
                                   <input type="hidden" value="1" name="quantity">
                                   <button class="btn btn-sm btn-outline-secondary addCart_btn" id="AddToCart_btn" type="button">Add To Cart</button>
                               </form>
                           </div>
                        </div>
                            <div class="col-md-5 order-md-1">
                                <img class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto product_details_img" src="{{asset('product_images/'.$product->image)}}">

                            </div>
                        </div>
                    </div>
            <!-------------- end products menu --------------->
        </main>
    @endsection
    @section('script')
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.all.min.js"></script>
        <script>
            $('#AddToCart_btn').click(function () {
                var data = $("#AddToCart_form").serialize();
                $.ajax({
                    type:'POST',
                    url:'{{route('cart.store')}}',
                    data:data,
                    success:function(data) {
                        if(data.done == 1){
                            const Toast = Swal.mixin({
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 3000,
                                timerProgressBar: true,
                                didOpen: (toast) => {
                                    toast.addEventListener('mouseenter', Swal.stopTimer)
                                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                                }
                            })
                            Toast.fire({
                                icon: 'success',
                                title: 'Product is Added to Cart Successfully .Go to Cart to Complete Order',
                                width: 800,
                                padding: '3em',

                            })
                        }
                    }
                });
            });
        </script>
    @endsection

