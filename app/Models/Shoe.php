<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shoe extends Model
{
    protected $table = 'shoe_information';
    protected $fillable = [
        'shoe_detail_id',
        'size',
        'color',
        'is_discontinued',
        'is_promotion',
        'promo_price',
        'stock',
    ];

    public function shoeDetail()
    {
        return $this->belongsTo(ShoeDetail::class, 'shoe_detail_id');
    }
}
