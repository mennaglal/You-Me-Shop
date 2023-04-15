<?php

namespace App\Http\Controllers;

use App\Models\products;
use Illuminate\Http\Request;

class VisitorController extends Controller
{
    //  return to visitor website
    public function index()
    {
        $products=products::all();
        return view('visitor.main',compact('products'));
    }
}
