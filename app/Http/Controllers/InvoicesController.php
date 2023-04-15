<?php

namespace App\Http\Controllers;

use App\Models\customers;
use App\Models\discount_offers;
use App\Models\invoices;
use App\Models\orders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class InvoicesController extends Controller
{
    //prevent anyone go to invoices pages in dashboard throughout the write invoices routes in URL-> only people who have these permissions can reach to it


    function __construct()
    {
        $this->middleware('permission:invoice-list', ['only' => ['index']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    //get all invoices

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

    // get invoice for customer who finish order

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

        // inputs will send in email to customer

        $email = $customer->customer_email;
        $mailData = [
            'title' => 'Order Invoice',
            'url' => 'https://You-Me-Shop.test/invoice_show'.$order_id,
            'customer_name'=>$customer->customer_name,
            'total_price'=>$total_price,
        ];

        // send email to customer who make order and take his invoice

        Mail::to($email)->send(new \App\Mail\AddInvoice($mailData));

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
