<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShoeSize extends Model
{
    protected $table = 'shoe_sizes';
    protected $fillable = ['us_size', 'eur_size', 'uk_size', 'cm_size'];

    public function shoes()
    {
        return $this->hasMany(Shoe::class, 'shoe_size_id');
    }   
}
