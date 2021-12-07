<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'nama_kamera','harga_rental','hari','status_kamera','gambar_kamera','lokasi'
    ];

    public function testimonial()
    {
        return $this->hasMany(Testimonial::class, 'product_id');
    }

}
