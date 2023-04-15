@extends("visitor.layouts.master")

@section('page-title')
    Invoice
@endsection
@section('css')
    <link href="{{asset('front_assets/invoice.css')}}" rel="stylesheet" type="text/css" />
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.min.css" rel="stylesheet">

@endsection
@section('content')
    <div class="container mb-5">
        <div class="row mb-5">
            <div class="col-9">
                <h6 class="invoice_head">Invoice to: </h6>
                <h4 class="customer_name">{{$customer->customer_name}}</h4>
                <div class="customer_phone"><span class="customer_info">Phone: </span>{{$customer->customer_phone}}</div>
                <div class="customer_phone"><span class="customer_info">Email: </span>{{$customer->customer_email}}</div>
                <div class="customer_country"><span class="customer_info">Country: </span>{{$customer->customer_country}}</div>
                <div class="customer_country"><span class="customer_info">Address: </span>{{$customer->customer_address}}</div>
            </div>
            <div class="col-3 invoice_header ">
                <h3>Invoice</h3>
                <div class="invoice_date">{{'InvoiceDate:  ' .'    '.$order->order_date}}</div>
            </div>
        </div>


        <!-------------- begin invoice products list --------------->

        <table class="table table-striped">
                <thead class="table_head">
                <tr>
                    <th class="header_datatable">Name</th>
                    <th class="header_datatable">Price</th>
                    <th class="header_datatable">Quantity</th>
                    <th class="header_datatable">TotalPrice</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($invoices as $invoice)
                <tr>
                    <td class="product_name_invoice">{{ $invoice->product->name}}</td>
                    <td>${{ $invoice->product->price}}</td>
                    <td>{{ $invoice->product_quantity}}</td>
                    <td>${{ $invoice->product_total_price }}</td>
                </tr>
                @endforeach
                </tbody>
            </table>

        <!-------------- end invoice products list --------------->

        <!-------------- begin invoice calculations list --------------->

        <div class="row">
            <div class="col-6 col-md-4 mb-2">
                <h5>Subtotal: </h5> <span class="result_num">  {{'$'.$subtotal_price}} </span>
            </div>
            <div class="col-6 col-md-4 mb-2">
                <h5>Shipping: </h5> <span class="result_num">  {{'$'.$shipping_price}}</span>
            </div>
            <div class="col-6 col-md-4 mb-2">
                <h5>VAT: </h5> <span class="result_num">  {{'$'.$vat_price}}</span>
            </div>
            <div class="col-6 col-md-4 mb-2">
                <h5 class="mb-2">Discounts: </h5>
                <ul>
                    @foreach ($discount_offers as $discount_offer)
                        <li class="result_num">{{$discount_offer->offer_name .' : -'.'$'. $discount_offer->offer_price }}</li>
                    @endforeach
                </ul>
            </div>
            <div class="col-6 col-md-4 mb-2">
                <h5 class="mb-2">Total: </h5> <span class="result_total">  {{'$'.$total_price}}</span>
            </div>

        </div>

        <!-------------- end invoice calculations list --------------->
    </div>
@endsection
@section('script')
@endsection
