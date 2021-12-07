<?php

namespace App\Http\Controllers;

use App\Models\Rental;
use App\Models\Product;
use Illuminate\Http\Request;

class RentalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rentals = Rental::with('product','user')->where('user_id', \Auth::user()->id)->get();
        return view('riwayat_rental', compact('rentals'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getRental($id)
    {
        $product = Product::find($id);
        return view('rental-kamera', compact('product'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all(); 
        $data['product_id'] = $request->product_id;
        $data['user_id'] = \Auth::user()->id;
        $data['total_biaya'] = $request->harga_rental * $request->lama_rental;
        $data['gambar'] = $request->file('gambar')->store('rentals','public');
        Rental::create($data);
        return redirect(route('products.index'))->with('status','Berhasil rental');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Rental  $rental
     * @return \Illuminate\Http\Response
     */
    public function show(Rental $rental)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Rental  $rental
     * @return \Illuminate\Http\Response
     */
    public function edit(Rental $rental)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Rental  $rental
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Rental $rental)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Rental  $rental
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rental $rental)
    {
        //
    }
}
