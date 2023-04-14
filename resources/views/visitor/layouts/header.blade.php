<div class="container">
    <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
        <div class="col-md-3 mb-2 mb-md-0">
            <a href="/" class="d-inline-flex link-body-emphasis text-decoration-none">
                <img src="{{asset('front_assets/logo31.jpg')}}" id="logo">
            </a>
        </div>

        <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
            <li><a href="/" class="nav-link px-2 active">Home</a></li>
{{--            <li><a href="{{route('orders.index')}}" class="nav-link px-2 item">Online Order</a></li>--}}
            <li>
                <a class="nav-link px-2 item"href="{{ route('cart.list') }}" >
                    <i class="fa-solid fa-cart-shopping fa-xl"></i>
                    <span class="text-red-700">{{ Cart::getTotalQuantity()}}</span>
                </a>
            </li>
        </ul>
    </header>
</div>
