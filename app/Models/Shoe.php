<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shoe extends Model
{
    protected $table = 'shoes';
    protected $fillable = [
        'sku',
        'shoe_detail_id',
        'size',
        'color',
        'is_hidden',
        'stock',
    ];

    public function shoeDetail()
    {
        return $this->belongsTo(ShoeDetail::class, 'shoe_detail_id');
    }
}
