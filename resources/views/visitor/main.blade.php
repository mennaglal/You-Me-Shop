
@extends("visitor.layouts.master")

@section('page-title')
    Home
@endsection

@section('css')

@endsection
@section('content')
    <main>

        <!-------------- begin carousel --------------->

        <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="{{asset('front_assets/cover4.jpg')}}" class="d-block w-100 carousel_img" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <h1 class="welcome_name">You & Me<span class="welcome_span">Shop</span></h1>
                        <h5 class="welcome_text">Easy World Wide Delivery.</h5>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="{{asset('front_assets/cover5.jpg')}}" class="d-block w-100 carousel_img" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <h1 class="welcome_name">You & Me<span class="welcome_span">Shop</span></h1>
                        <h5 class="welcome_text">Always offers and discounts.</h5>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>

        <!-------------- end carousel --------------->

        <!-------------- begin products menu --------------->

{{--        <div class="container">--}}
{{--            <h1 class="products_menu mt-3 mb-3">Products Menu</h1>--}}

{{--            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3 mt-5 mb-5">--}}
{{--                @foreach($products as $key => $product)--}}

{{--                    <div class="col">--}}
{{--                        <div class="card shadow-sm">--}}
{{--                            <img class="bd-placeholder-img card-img-top product_img" src="{{asset('product_images/'.$product->image)}}">--}}
{{--                            <div class="product_info">--}}
{{--                                <h5 class="m-3 product_type"> {{$product->name}}</h5>--}}
{{--                                <div class="card-body">--}}
{{--                                    <p class="card-text ">Weight is <span class="product_number">{{$product->weight}}</span> kg</p>--}}
{{--                                    <div class="d-flex justify-content-between align-items-center">--}}
{{--                                        <div class="btn-group">--}}
{{--                                        </div>--}}
{{--                                        <form id="AddToCart_form" class="AddToCart_form">--}}
{{--                                            @csrf--}}
{{--                                            <input type="hidden" value="{{ $product->id }}" name="id">--}}
{{--                                            <input type="hidden" value="{{ $product->name }}" name="name">--}}
{{--                                            <input type="hidden" value="{{ $product->weight}}" name="weight">--}}
{{--                                            <input type="hidden" value="{{ $product->price }}" name="price">--}}
{{--                                            <input type="hidden" value="{{ $product->description }}" name="description">--}}
{{--                                            <input type="hidden" value="{{ $product->shipping_rate_id}}" name="shipping_rate_id">--}}
{{--                                            <input type="hidden" value="{{ $product->image }}"  name="image">--}}
{{--                                            <input type="hidden" value="1" name="quantity">--}}
{{--                                            <button class="btn btn-sm btn-outline-secondary AddToCart_btn" id="AddToCart_btn" type="button">Add To Cart</button>--}}
{{--                                        </form>--}}
{{--                                            <a type="button" class="btn btn-sm btn-outline-secondary" href="{{route('products.show', $product->id)}}">Order</a>--}}
{{--                                        </div>--}}
{{--                                        <span class="product_number">{{$product->price}} $</span>--}}
{{--                                    </div>--}}
{{--                                </div>--}}

{{--                        </div>--}}
{{--                    </div>--}}
{{--                @endforeach--}}
{{--            </div>--}}
{{--        </div>--}}

           <div class="container mb-5 mt-5 products_list">
                <div class="row">
                    @foreach($products as $key => $product)
                    <div class="col-lg-4">
                     <img class="bd-placeholder-img card-img-top product_img" src="{{asset('product_images/'.$product->image)}}">
                        <h2 class="fw-normal product_name" >{{$product->name}}</h2>
                        <p>{{$product->description}}.</p>
                        <p><a class="btn btn-outline-primary" href="{{route('products.show', $product->id)}}">View details »</a></p>
                    </div>
                    @endforeach
                </div>
           </div>
        <!-------------- end products menu --------------->
    </main>
@endsection
@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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
                            position: 'bottom-end',
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
                            title: 'Added successfully. Refresh Please.'
                        })
                    }
                }
            });
        });
    </script>
@endsection

