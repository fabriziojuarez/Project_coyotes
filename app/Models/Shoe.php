<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shoe extends Model
{
    protected $table = 'shoe_information';
    protected $fillable = [
        'shoe_detail_id',
        'shoe_size_id',
        'color',
        'is_discontinued',
        'is_promotion',
        'promo_price',
        'price',
        'stock',
    ];

    public function shoeDetail()
    {
        return $this->belongsTo(ShoeDetail::class, 'shoe_detail_id');
    }

    public function shoeSize()
    {
        return $this->belongsTo(ShoeSize::class, 'shoe_size_id');
    }

    public function shoeColor()
    {
        return $this->belongsTo(ShoeColor::class, 'color');
    }   
}
