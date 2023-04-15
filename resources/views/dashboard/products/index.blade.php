@extends('dashboard.layouts.master')
@section('page-title','Products')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('assets/ltr/plugins/table/datatable/datatables.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('assets/ltr/plugins/table/datatable/custom_dt_html5.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('assets/ltr/plugins/table/datatable/dt-global_style.css')}}" />
    <style>
        @media print {
            body{
                word-break: break-all;
                white-space: normal;
            }
        }
    </style>
@endsection
@section('content')
    <!-- messages error and add ,edit delete messages -->
    <div class="row justify-content-center mt-4">
        <div class="col-11 m-3">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session()->has('add'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{ session()->get('add') }}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            @if (session()->has('delete'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>{{ session()->get('delete') }}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            @if (session()->has('edit'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{ session()->get('edit') }}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
        </div>
    </div>
    <div class="layout-px-spacing">
        @can('product-create')
            <a class="btn btn-success m-3" href="{{ route('products.create') }}">Add new product</a>
        @endcan
        <div class="row" id="cancel-row">
                <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                    <div class="widget-content widget-content-area br-6">
                        @can('product-list')
                        <table id="html5-extension" class="table table-hover non-hover" style="width:100%">
                            <thead>
                            <tr>
                                <th class="header_datatable">#</th>
                                <th class="header_datatable">Category</th>
                                <th class="header_datatable">Name</th>
                                <th class="header_datatable">Description</th>
                                <th class="header_datatable">Price</th>
                                <th class="header_datatable">Image</th>
                                <th class="header_datatable">Weight</th>
                                <th class="header_datatable">Shipped from</th>
                                <th class="header_datatable">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($products as $key => $product)
                                <tr>
                                    <td >{{ ++$key }}</td>
                                    <td>{{ $product->category->name}}</td>
                                    <td>{{ $product->name}}</td>
                                    <td class="desc-style" style="max-width:10px;word-wrap: break-word;white-space: normal;">
                                        {{ $product->description }}
                                    </td>

                                    <td>{{'$'. $product->price }}</td>
                                    <td>
                                        @if($product->image==Null)
                                            <div class="mr-2">
                                                No image
                                            </div>
                                        @else
                                            <div class="d-flex">
                                                <div class="mr-2">
                                                    <img alt="{{ $product->image }}" class="img-fluid" width="50px" src="{{asset('product_images/'.$product->image)}}">
                                                </div>
                                            </div>
                                        @endif

                                    </td>
                                    <td>{{ $product->weight}} Kg</td>
                                    <td>{{ $product->ShippingRate->country}}</td>
                                    <td>
                                        @can('product-edit')
                                        <a class="btn btn-primary" href="{{ route('products.edit',$product->id) }}">Edit</a>
                                        @endcan
                                        @can('product-delete')
                                        <a type="button"
                                           class="btn btn-danger"
                                           data-id="{{$product->id}}"
                                           data-toggle="modal"
                                           data-target="#deleteModal">
                                            Delete
                                        </a>
                                         @endcan
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        @endcan
                    </div>
                </div>
            </div>
        <div class="modal fade modal-notification" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="standardModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document" id="standardModalLabel">
                <div class="modal-content">
                    <div class="modal-body text-center">
                        <div class="icon-content">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16" style="color: red !important;">
                                <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z"/>
                            </svg>
                        </div>
                        <h3>Are you sure to complete the deleting process?</h3>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <form class="delete_form" action="{{route('products.destroy')}}" method="post">
                            {{ method_field('delete') }}
                            {{csrf_field()}}
                            <input type="hidden" id="id" name="id">
                            <button type="submit" class="btn btn-primary">Confirm</button>
                            <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Cancel</button>
                        </form>

                    </div>
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
        $('#deleteModal').on('show.bs.modal', function(event){
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var modal = $(this)
            modal.find('.modal-footer .delete_form #id').val(id);

        });
    </script>
@endsection
