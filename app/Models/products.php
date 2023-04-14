<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class products extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function ShippingRate()
    {
        return $this->belongsTo('App\Models\shipping_rates','shipping_rates_id','id');
    }
    public function category()
    {
        return $this->belongsTo('App\Models\categories','category_id','id');
    }
}
