@extends('dashboard.layouts.master')
@section('page-title','Orders')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('assets/ltr/plugins/table/datatable/datatables.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('assets/ltr/plugins/table/datatable/custom_dt_html5.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('assets/ltr/plugins/table/datatable/dt-global_style.css')}}" />
@endsection
@section('content')
    <div class="layout-top-spacing layout-px-spacing">
        <div class="row" id="cancel-row">
            <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                <div class="widget-content widget-content-area br-6">
                    <table id="html5-extension" class="table table-hover non-hover" style="width:100%">
                        <thead>
                        <tr>
                            <th>Order Id</th>
                            <th>Order Date</th>
                            <th>Customer Name</th>
                            <th>Customer Email</th>
                            <th>Customer Phone</th>
                            <th>Customer Country</th>
                            <th>Customer Address</th>
                            <th>Product Category</th>
                            <th>Product Name</th>
                            <th>Product Description</th>
                            <th>Product Image</th>
                            <th>Product Weight</th>
                            <th>Product Shipped from</th>
                            <th>Product Price</th>
                            <th>Product Quantity</th>
                            <th>Product Total Price</th>
                            <th>Subtotal</th>
                            <th>Shipping Fees</th>
                            <th>Vat</th>
                            <th>Total</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($invoices as $i => $invoice)
                            <tr>
                                <td>{{$invoice->order->id}}</td>
                                <td>{{$invoice->order->order_date}}</td>
                                <td>{{$invoice->customer->customer_name}}</td>
                                <td>{{$invoice->customer->customer_email}}</td>
                                <td>{{$invoice->customer->customer_phone}}</td>
                                <td>{{$invoice->customer->customer_country}}</td>
                                <td>{{$invoice->customer->customer_address}}</td>
                                <td>{{ $invoice->product->category->name}}</td>
                                <td>{{ $invoice->product->name}}</td>
                                <td class="desc-style" style="max-width:10px;word-wrap: break-word;white-space: normal;">
                                    {{ $invoice->product->description }}
                                </td>
                                <td>
                                    @if($invoice->product->image==Null)
                                        <div class="mr-2">
                                            No image
                                        </div>
                                    @else
                                        <div class="d-flex">
                                            <div class="mr-2">
                                                <img alt="{{ $invoice->product->image }}" class="img-fluid" width="50px" src="{{asset('product_images/'.$invoice->product->image)}}">
                                            </div>
                                        </div>
                                    @endif

                                </td>
                                <td>{{ $invoice->product->weight}}Kg</td>
                                <td>{{ $invoice->product->ShippingRate->country}}</td>
                                <td>{{ '$'.$invoice->product->price }}</td>
                                <td>{{$invoice->product_quantity}} </td>
                                <td>{{'$'.$invoice->product_total_price}}</td>
                                <td>{{'$'.$invoice->subtotal_price}}</td>
                                <td>{{'$'.$invoice->shipping_price}}</td>
                                <td>{{'$'.$invoice->vat_price}}</td>
                                <td>{{'$'.$invoice->total_price}}</td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{asset('assets/ltr/plugins/table/datatable/datatables.js')}}"></script>
    <!-- NOTE TO Use Copy CSV Excel PDF Print Options You Must Include These Files  -->
    <script src="{{asset('assets/ltr/plugins/table/datatable/button-ext/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('assets/ltr/plugins/table/datatable/button-ext/jszip.min.js')}}"></script>
    <script src="{{asset('assets/ltr/plugins/table/datatable/button-ext/buttons.html5.min.js')}}"></script>
    <script src="{{asset('assets/ltr/plugins/table/datatable/button-ext/buttons.print.min.js')}}"></script>
    <script>
        $('#html5-extension').DataTable( {
            "dom": "<'dt--top-section'<'row'<'col-sm-12 col-md-6 d-flex justify-content-md-start justify-content-center'B><'col-sm-12 col-md-6 d-flex justify-content-md-end justify-content-center mt-md-0 mt-3'f>>>" +
                "<'table-responsive'tr>" +
                "<'dt--bottom-section d-sm-flex justify-content-sm-between text-center'<'dt--pages-count  mb-sm-0 mb-3'i><'dt--pagination'p>>",
            buttons: {
                buttons: [
                    { extend: 'copy', className: 'btn btn-sm' },
                    { extend: 'csv', className: 'btn btn-sm' },
                    { extend: 'excel', className: 'btn btn-sm' },
                    { extend: 'print', className: 'btn btn-sm' }
                ]
            },
            "oLanguage": {
                "oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' },
                "sInfo": "Showing page _PAGE_ of _PAGES_",
                "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                "sSearchPlaceholder": "Search...",
                "sLengthMenu": "Results :  _MENU_",
            },
            "stripeClasses": [],
            "lengthMenu": [7, 10, 20, 50],
            "pageLength": 7
        } );
    </script>
@endsection
