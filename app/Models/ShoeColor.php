<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShoeColor extends Model
{
    protected $table = 'shoe_colors';
    protected $fillable = ['color'];

    public function shoes()
    {
        return $this->hasMany(Shoe::class, 'shoe_color_id');
    }
}
