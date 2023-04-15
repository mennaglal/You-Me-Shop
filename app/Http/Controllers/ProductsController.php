<?php

namespace App\Http\Controllers;

use App\Models\categories;
use App\Models\products;
use App\Models\shipping_rates;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProductsController extends Controller
{
    //prevent anyone go to products pages in dashboard throughout the write products routes in URL-> only people who have these permissions can reach to it

    function __construct()
    {
        $this->middleware('permission:product-list|product-create|product-edit|product-delete', ['only' => ['index','store']]);
        $this->middleware('permission:product-create', ['only' => ['create','store']]);
        $this->middleware('permission:product-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:product-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    //get all products

    public function index()
    {
        $products = products::all();
        return view('dashboard.products.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    // return to create product page

    public function create()
    {
        $shipping_rates=shipping_rates::all();
        $categories=categories::all();
        return view('dashboard.products.create' ,compact('shipping_rates','categories'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    // add product

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required:products',
            'name' => 'required|max:255|unique:products',
            'description' => 'required:products',
            'price' => 'required:products',
            'weight' => 'required:products',
            'shipping_rates_id' => 'required:products',
            'image' => 'image:products',
        ],[
            'category_id.required' =>'please choose category',
            'name.required' =>'please enter product name',
            'name.unique' =>'The product name already exists, please enter another product name',
            'description.required' =>'please enter product description',
            'price.required' =>'please enter product price',
            'weight.required' =>'please enter product weight',
            'shipping_rates_id.required' =>'please shipping country',
            'image.image' =>'file type must be an image',
        ]);
        $product_img =null;
        if($request->hasFile('image')){
            $file = $request->file('image');
            $num = time().rand(1, 2500). '.'.$file->getClientOriginalExtension();
            $product_name = $num;
            $product_img = $num;
            $file->move(public_path('product_images/'),$product_name);
        }

        products::create([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'weight' => $request->weight,
            'shipping_rates_id' =>$request->shipping_rates_id,
            'image' => ($product_img == null)?NULL:$product_img,

        ]);
        session()->flash('add', 'Add Product Done Successfully');
        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\products  $products
     * @return \Illuminate\Http\Response
     */

    //get product by id

    public function show($id)
    {
        $product=products::find($id);
        return view('visitor.product_details',compact('product','id'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\products  $products
     * @return \Illuminate\Http\Response
     */

    // get product and return to edit product page

    public function edit($id)
    {
        $products = products::find($id);
        $shipping_rates=shipping_rates::all();
        $categories=categories::all();

        return view('dashboard.products.edit',compact('products','id','shipping_rates','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\products  $products
     * @return \Illuminate\Http\Response
     */

    // update product
    public function update(Request $request, $product_id)
    {
        $product_image = products::select('image')->where('id', $product_id)->first()->image;
        $request->validate([
            'category_id' => 'required:products',
            'name' => 'required|max:255|unique:products,name,'.$product_id,
            'description' => 'required:products',
            'price' => 'required:products',
            'weight' => 'required:products',
            'shipping_rates_id' => 'required:products',
            'image' => 'image:products',
        ],[
            'category_id.required' =>'please choose category',
            'name.required' =>'please enter product name',
            'name.unique' =>'The product name already exists, please enter another product name',
            'description.required' =>'please enter product description',
            'price.required' =>'please enter product price',
            'weight.required' =>'please enter product weight',
            'shipping_rates_id.required' =>'please shipping country',
            'image.image' =>'file type must be an image',
        ]);
        $product_img = null;
        $file = $request->file('image');
        $image_has_changed = false;
        if ($file != Null) {
            $path = public_path('product_images/') . $product_image;
            File::delete($path);
            $num = time().rand(1, 2500). '.'.$file->getClientOriginalExtension();
            $prod_name = $num;
            $product_img = $prod_name;
            $file->move(public_path('product_images/'), $prod_name);
            $image_has_changed = true;
        }
        $products = products::findOrFail($product_id);
        $products->update([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'weight' => $request->weight,
            'shipping_rates_id' =>$request->shipping_rates_id,
            'image' => ($image_has_changed == false) ? $product_image : $product_img,
        ]);
        session()->flash('edit', 'Edit Product Done Successfully');
        return redirect()->route('products.index');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\products  $products
     * @return \Illuminate\Http\Response
     */

    // delete product
    public function destroy(Request $request)
    {
        $product_img = products::where('id', $request->id)->first()->image;
        if($product_img){
            $path = public_path('product_images/').$product_img;
            File::delete($path);
        }
        products::find($request->id)->delete();
        session()->flash('delete','Delete Product Done Successfully');
        return redirect()->route('products.index');
    }
}
