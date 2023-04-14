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
        //get time now and add it to order date in orders table

        $timenow = Carbon::now();
        $order_id=DB::table('orders')->insertGetId([
            'order_date' => $timenow, ]);

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
            $productPrice = products::where('id',$selectedOption->id)->first()->price;
            $productWeight = products::where('id',$selectedOption->id)->first()->weight;
            $shipping_rates_id = products::where('id',$selectedOption->id)->first()->shipping_rates_id;

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
                $count_two_tops+=1;
            }

            // calculate subtotal , shippings, vat

            $subtotal+=$productPrice;
            $shippings+=(($productWeight*1000)/100)*$shipping_rate;
            $vat_price+=$productPrice*0.14;
        }
        foreach ($_POST['products_id'] as $selectedOption) {
            $productName = products::where('id',$selectedOption->id)->first()->name;
            $productPrice = products::where('id',$selectedOption->id)->first()->price;

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
            invoices::create([
                'order_id' => $order_id,
                'product_id' => $selectedOption->id,
                'subtotal_price' => doubleval($subtotal),
                'shipping_price' => doubleval($shippings),
                'vat_price' => doubleval($vat_price),
                'total_price' => doubleval($total),
            ]);
        }
        // take order id and go to invoice controller
        return redirect()->route('invoices.show',$order_id);

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
