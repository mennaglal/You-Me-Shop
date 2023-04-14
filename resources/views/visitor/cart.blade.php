@extends("visitor.layouts.master")

@section('page-title')
    Cart
@endsection
@section('css')
    <link href="{{asset('front_assets/order.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('front_assets/cart.css')}}" rel="stylesheet" type="text/css" />
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.min.css" rel="stylesheet">

@endsection
@section('content')
    <div class="container mb-10">
        <h1 class="order_header mb-2"><span class="order">Cart</span></h1>

        <!-------------- begin make order form --------------->

        <div class="order_form card shadow-sm">
            <h3 class="cart_list">Cart List</h3>
                <table class="table table-borderless cart_table">
                    <thead>
                    <tr>
                        <th scope="col">Image</th>
                        <th scope="col">Name</th>
                        <th scope="col">Quantity</th>
                        <th scope="col" >Price</th>
                        <th scope="col">Remove</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($cartItems as $item)
                        <input type="hidden" value="{{ $item->id }}" name="{{'product_id'.$item->id}}">
                        <input type="hidden" value="{{ $item->quantity }}" name="{{'product_quantity'.$item->id}}">

                        <tr>
                        <td>
                            <div class="product_img_container">
                                <img src="{{asset('product_images/'.$item->attributes->image)}}" class="product_img_cart">
                            </div>
                        </td>
                        <td class="product-name_cart">{{$item->name}}</td>
                        <td>
                            <div class="quantity_container">
                                <form action="{{ route('cart.update') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $item->id}}" >
                                    <input type="text" name="quantity" value="{{ $item->quantity }}"class="quantity_input mb-2" />
                                    <button class="quantity_update_btn">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                        <td>{{ $item->price}}$</td>
                        <td>
                            <form action="{{ route('cart.remove') }}" method="POST">
                                @csrf
                                <input type="hidden" value="{{ $item->id }}" name="id">
                                <button class="remove_btn pr-5 pl-5 pb-1 pb-1">
                                    <i class="fa-solid fa-cart-xmark"></i>                                </button>
                            </form>
                        </td>

                    </tr>
                    @endforeach
                    </tbody>
                </table>
                <h5 class="mb-2">
                    Total: <span class="total_price">{{ Cart::getTotal() }}$</span>
                </h5>
                <div>
                    <form action="{{ route('cart.clear') }}" method="POST">
                        @csrf
                        <button class="clear_btn mb-5">Clear Cart</button>
                    </form>
                </div>
                <div class="d-grid d-md-flex justify-content-md-end">
                    <a type="button" class="btn btn_order"  href="{{route('orders.index')}}">Make Order</a>
                </div>
        </div>
    </div>
@endsection
