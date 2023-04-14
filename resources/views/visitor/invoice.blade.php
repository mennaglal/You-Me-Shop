@extends("visitor.layouts.master")

@section('page-title')
    Invoice
@endsection
@section('css')
    <link href="{{asset('front_assets/invoice.css')}}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    <div class="container mb-5">
        <h1 class="invoice_header mb-5"><span class="invoice">Invoice</span></h1>

        <!-------------- begin invoice products list --------------->

        <table class="table table-striped">
                <thead class="table_head">
                <tr>
                    <th class="header_datatable">Type</th>
                    <th class="header_datatable">Weight</th>
                    <th class="header_datatable">Shipped from</th>
                    <th class="header_datatable">Price</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($invoices as $invoice)
                <tr>
                    <td>{{ $invoice->product->type}}</td>
                    <td>{{ $invoice->product->weight}} Kg</td>
                    <td>{{ $invoice->product->ShippingRate->country}}</td>
                    <td>{{ $invoice->product->price }} $</td>
                </tr>
                @endforeach
                </tbody>
            </table>

        <!-------------- end invoice products list --------------->

        <!-------------- begin invoice calculations list --------------->

        <div class="row">
            <div class="col-6 col-md-4 mb-2">
                <h5>Subtotal: </h5> <span class="result_num">  {{$subtotal_price .'$'}} </span>
            </div>
            <div class="col-6 col-md-4 mb-2">
                <h5>Shipping: </h5> <span class="result_num">  {{$shipping_price .'$'}}</span>
            </div>
            <div class="col-6 col-md-4 mb-2">
                <h5>VAT: </h5> <span class="result_num">  {{$vat_price .'$'}}</span>
            </div>
            <div class="col-6 col-md-4 mb-2">
                <h5 class="mb-2">Discounts: </h5>
                <ul>
                    @foreach ($discount_offers as $discount_offer)
                        <li class="result_num">{{$discount_offer->offer_name .' : '. $discount_offer->offer_price .'$'}}</li>
                    @endforeach
                </ul>
            </div>
            <div class="col-6 col-md-4 mb-2">
                <h5 class="mb-2">Total: </h5> <span class="result_total">  {{$total_price .'$'}}</span>
            </div>

        </div>

        <!-------------- end invoice calculations list --------------->
    </div>
@endsection
