
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
                    <img src="{{asset('front_assets/images/cover4.jpg')}}" class="d-block w-100 carousel_img" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <h1 class="welcome_name">You & Me<span class="welcome_span">Shop</span></h1>
                        <h5 class="welcome_text">Easy World Wide Delivery.</h5>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="{{asset('front_assets/images/cover5.jpg')}}" class="d-block w-100 carousel_img" alt="...">
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

        <!-------------- begin offers menu --------------->
        <div class="container px-4 py-5" id="featured-3">
            <h2 class="pb-2 border-bottom ">Available Offers</h2>
            <div class="row g-4 py-5 row-cols-1 row-cols-lg-3">
                <div class="feature col">
                    <div class="feature-icon offer_icon mb-2">
                        <i class="fa-solid fa-gift fa-xl"></i>
                    </div>
                    <h2 class="offer_header">Shipping Fees Offers</h2>
                    <p class="text-muted">Buy any two items or more and get a maximum of $10 off shipping fees.</p>
                    <a href="#product_list" class="icon-link buy_now_link">
                        Buy Now
                        <svg class="bi" width="1em" height="1em"><use xlink:href="#chevron-right"></use></svg>
                    </a>
                </div>
                <div class="feature col ">
                    <div class="feature-icon offer_icon mb-2">
                        <i class="fa-solid fa-gift fa-xl"></i>
                    </div>
                    <h2 class="offer_header">Shoes Offer</h2>
                    <p class="text-muted">Shoes are on 10% off.</p>
                    <a href="#product_list" class="icon-link buy_now_link">
                        Buy Now
                        <svg class="bi" width="1em" height="1em"><use xlink:href="#chevron-right"></use></svg>
                    </a>
                </div>
                <div class="feature col">
                    <div class="feature-icon offer_icon mb-2">
                        <i class="fa-solid fa-gift fa-xl"></i>
                    </div>
                    <h2 class="offer_header">Jacket Offer</h2>
                    <p class="text-muted">Buy any two tops (t-shirt or blouse) and get any jacket on 50% off.</p>
                    <a href="#product_list" class="icon-link buy_now_link">
                        Buy Now
                        <svg class="bi" width="1em" height="1em"><use xlink:href="#chevron-right"></use></svg>
                    </a>
                </div>
            </div>
        </div>

        <!-------------- end offers menu --------------->

        <!-------------- begin products menu --------------->

           <div class="container mb-5 mt-5 products_list" id="product_list">
                <div class="row">
                    @foreach($products as $key => $product)
                    <div class="col-lg-4">
                     <img class="bd-placeholder-img card-img-top product_img" src="{{asset('product_images/'.$product->image)}}">
                        <h2 class="fw-normal product_name" >{{$product->name}}</h2>
                        <p>{{$product->description}}.</p>
                        <p><a class="btn btn-outline-primary" href="{{route('product_show', $product->id)}}">View details »</a></p>
                    </div>
                    @endforeach
                </div>
           </div>
        <!-------------- end products menu --------------->
    </main>
@endsection

