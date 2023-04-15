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
        <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
            <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
            </symbol>
            <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
                <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
            </symbol>
            <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
                <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
            </symbol>
        </svg>
        @if ($errors->any())
            <div class="alert alert-danger d-flex align-items-center alert-dismissible fade show" style="margin-top: 30px;">
                <ul>
                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                    @foreach ($errors->all() as $error)
                        <li>
                            <strong style="  text-transform: capitalize;">{{ $error }}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session()->has('success'))
            <div class="alert alert-success d-flex align-items-center alert-dismissible fade show" role="alert">
                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
                <strong style="  text-transform: capitalize;">{{ session()->get('success') }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <h1 class="order_header mb-2"><span class="order">Cart</span></h1>

        <!-------------- cart list with operations --------------->

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
                        <td>${{ $item->price}}</td>
                        <td>
                            <form action="{{ route('cart.remove') }}" method="POST">
                                @csrf
                                <input type="hidden" value="{{ $item->id }}" name="id">
                                <button class="remove_btn pr-5 pl-5 pb-1 pb-1">
                                    <i class="fa-solid fa-xmark fa-xl"></i>
                                </button>
                            </form>
                        </td>

                    </tr>
                    @endforeach
                    </tbody>
                </table>
                <h5 class="mb-2">
                    Total: <span class="total_price">${{ Cart::getTotal() }}</span>
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
