<?php

namespace App\Http\Controllers;

use App\Models\discount_offers;
use App\Models\invoices;
use App\Models\orders;
use App\Models\products;
use App\Models\shipping_rates;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cartItems = \Cart::getContent();
        return view('visitor.order',compact('cartItems'));
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
        //get time now and add it to order date in orders table and order id to add it in invoice table

        $timenow = Carbon::now();
        $order_id=DB::table('orders')->insertGetId([
            'order_date' => $timenow, ]);

        // add customer info to customer table and get customer id to add it in invoice table

        $request->validate([
            'customer_name' => 'required',
            'customer_email' => 'required',
            'customer_phone' => 'required',
            'customer_country' => 'required',
            'customer_address' => 'required',
        ],[
            'customer_name.required' =>'please entre your name',
            'customer_email.required' =>'please entre your email',
            'customer_phone.required' =>'please entre your phone',
            'customer_country.required' =>'please choose your country',
            'customer_address.required' =>'please entre your address',
        ]);

        $customer_id=DB::table('customers')->insertGetId([
            'customer_name' => $request->customer_name,
            'customer_email' => $request->customer_email,
            'customer_phone' => $request->customer_phone,
            'customer_country' => $request->customer_country,
            'customer_address' => $request->customer_address,
            ]);

        $subtotal=0;
        $shippings=0;
        $vat_price=0;
        $total=0;
        $count_two_tops=0;

        //get count product if >= 2 then $10 of shipping discount exists and add it discount offers table
        $cartItems = \Cart::getContent();
        $product_count=count($cartItems);
        if($product_count>=2){
            discount_offers::create([
                'offer_name' => '$10 of shipping',
                'offer_price' => 10,
                'order_id'=>$order_id,
            ]);
        }

        foreach ($cartItems as $selectedOption) {

            //get info for every product to calculate subtotal , shippings, vat

            $productName = products::where('id',$selectedOption->id)->first()->name;
            $proPrice = products::where('id',$selectedOption->id)->first()->price;
            $productWeight = products::where('id',$selectedOption->id)->first()->weight;
            $shipping_rates_id = products::where('id',$selectedOption->id)->first()->shipping_rates_id;

            // every product price =price * quantity
            $productPrice=$proPrice*$selectedOption->quantity;

            //get shipping_rate to calculate shippings

            $shipping_rate = shipping_rates::where('id',$shipping_rates_id)->first()->rate;

            //check if  shoes exist in products then 10% off shoes discount exists and add it discount offers table

            if(strtolower($productName)=='shoes'){
                discount_offers::create([
                    'offer_name' => '10% off shoes',
                    'offer_price' => doubleval($productPrice*0.1),
                    'order_id'=>$order_id,
                ]);
            }
            //count tops (t-shirt or blouse)

            if(strtolower($productName)=='t-shirt'|| strtolower($productName)=='blouse'){
                $count_two_tops+=intval($selectedOption->quantity);
            }

            // calculate subtotal , shippings, vat

            $subtotal+=$productPrice;
            $shippings+=(($productWeight*1000)/100)*$shipping_rate;
            $vat_price+=$productPrice*0.14;
        }
        foreach ($cartItems as $selectedOption) {

            $productName = products::where('id',$selectedOption->id)->first()->name;
            $proPrice = products::where('id',$selectedOption->id)->first()->price;

            // every product price =price * quantity
            $productPrice=$proPrice*$selectedOption->quantity;

            //check if  two tops (t-shirt or blouse) exist then 50% off jacket discount exists and add it discount offers table

            if(strtolower($productName)=='jacket' &&$count_two_tops>=2){
                discount_offers::create([
                    'offer_name' => '50% off jacket',
                    'offer_price' => doubleval($productPrice*0.5),
                    'order_id'=>$order_id,
                ]);
            }
        }
        // calculate all discount
        $discount=0;
        $discount_offers = discount_offers::where('order_id',$order_id)->get();
        foreach ($discount_offers as $key=> $discount_offer){
            $discount+= $discount_offer->offer_price;
        }
        // calculate total price after discount
        $total=($total+$subtotal+$shippings+$vat_price)-$discount;

        // add order id , products ids and calculations into invoice table
        foreach ($cartItems as $selectedOption) {
            $product_total_price=($selectedOption->price*$selectedOption->quantity);
            invoices::create([
                'order_id' => $order_id,
                'customer_id' => $customer_id,
                'product_id' => $selectedOption->id,
                'product_quantity' => doubleval($selectedOption->quantity),
                'product_total_price' => doubleval($product_total_price),
                'subtotal_price' => doubleval($subtotal),
                'shipping_price' => doubleval($shippings),
                'vat_price' => doubleval($vat_price),
                'total_price' => doubleval($total),
            ]);
        }
        \Cart::clear();
        // take order id and go to invoice controller
        return redirect()->route('invoice_show',$order_id);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\orders  $orders
     * @return \Illuminate\Http\Response
     */
    public function show(orders $orders)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\orders  $orders
     * @return \Illuminate\Http\Response
     */
    public function edit(orders $orders)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\orders  $orders
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, orders $orders)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\orders  $orders
     * @return \Illuminate\Http\Response
     */
    public function destroy(orders $orders)
    {
        //
    }
}
