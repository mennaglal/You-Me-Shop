<?php

namespace App\Http\Controllers;

use App\Models\customers;
use App\Models\discount_offers;
use App\Models\invoices;
use App\Models\orders;
use App\Models\products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InvoicesController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:invoice-list', ['only' => ['index']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $invoices=invoices::all();
        return view('dashboard.invoice_order.index',compact('invoices'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function show($order_id)
    {
        // get order
        $order = orders::find($order_id);

        // get customer
        $customer_id = invoices::select('customer_id')->where('order_id',$order_id)->first()->customer_id;

        $customer = customers::find($customer_id);

        //get invoice info

        $invoices = invoices::where('order_id',$order_id)->get();

        //get calculations in invoice

        $subtotal_price = invoices::select('subtotal_price')->where('order_id',$order_id)->first()->subtotal_price;
        $shipping_price = invoices::select('shipping_price')->where('order_id',$order_id)->first()->shipping_price;
        $vat_price = invoices::select('vat_price')->where('order_id',$order_id)->first()->vat_price;
        $total_price = invoices::select('total_price')->where('order_id',$order_id)->first()->total_price;

        //get discount offers in invoice

        $discount_offers = discount_offers::where('order_id',$order_id)->get();

        session()->flash('add', 'Add Order Done Successfully');
        return view('visitor.invoice',compact(
            'invoices','discount_offers','subtotal_price','shipping_price','vat_price','total_price','order','customer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function edit(invoices $invoices)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, invoices $invoices)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function destroy(invoices $invoices)
    {
        //
    }

}
