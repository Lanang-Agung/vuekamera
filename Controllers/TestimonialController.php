<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Testimonial;
use App\Models\Rental;

class TestimonialController extends Controller
{
    public function getTestimonial ($id)
    {
        $product = Product::find($id); 
        return view('testimonial', compact('product'));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['product_id'] = $request->product_id;
        Testimonial::create($data);
        return redirect(route('rental.index'))->with('status','berhasil memberi testimoni');
    }

    public function showTestimonial($id)
    {
        $product = Product::with('testimonial')->where('id', $id)->first(); 
        return view('show-testimonial',  compact('product'));
    }

    public function delete($id)
    {
        $testi = Rental::find($id); 
        $testi->delete();
        return redirect()->back()->with('status','data berhasil dihapus');
    }
}
