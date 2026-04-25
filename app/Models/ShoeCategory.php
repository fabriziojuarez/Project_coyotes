<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShoeCategory extends Model
{
    protected $table = 'shoe_categories';
    protected $fillable = ['name'];

    public function shoes()
    {
        return $this->hasMany(ShoeDetail::class, 'category_id');
    }
}
