<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class invoices extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function product()
    {
        return $this->belongsTo('App\Models\products','product_id','id');
    }
    public function customer()
    {
        return $this->belongsTo('App\Models\customers','customer_id','id');
    }
    public function order()
    {
        return $this->belongsTo('App\Models\orders','order_id','id');
    }
}
