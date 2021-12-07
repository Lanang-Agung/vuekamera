<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id','isi'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
