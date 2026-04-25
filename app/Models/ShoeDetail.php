<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShoeDetail extends Model
{
    protected $table = 'shoe_details';
    protected $fillable = [
        'category_id',
        'brand',
        'model',
        'base_price',
        'is_discontinued',
        'is_promotion',
        'promo_price',
        'promo_descount',
        'description',
    ];

    public function category()
    {
        return $this->belongsTo(ShoeCategory::class, 'category_id');
    }

    public function shoes()
    {
        return $this->hasMany(Shoe::class, 'shoe_detail_id');
    }
}
