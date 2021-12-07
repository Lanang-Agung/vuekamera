<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Testimonial;

class apiTestimonialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $testimonials = Testimonial::all();

        return response()->json($testimonials);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        $testimonial = Testimonial::create($data);
        
        return response()->json([
            'message' => 'Create Data Berhasil',
            'data' => $testimonial
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $testimonial = Testimonial::find($id);

        return response()->json($testimonial);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        $testimonial = Testimonial::find($id);
        $testimonial->update($data);
        // $testimonial->nama_kamera = $request->nama_kamera;
        // $testimonial->harga_rental = $request->harga_rental;
        // $testimonial->hari = $request->hari;
        // if($request->hasFile('gambar_kamera')){
        //     if($request->gambar_kamera && file_exists(storage_path('app/public/'.$request->gambar_kamera))){
        //         Storage::delete('public/'.$request->gambar_kamera);
        //     }
        //     $file = $request->file('gambar_kamera')->store('gambars','public');
        //     $testimonial->gambar_kamera = $file;
        // } 
        // $testimonial->save();

        return response()->json([
            'message' => 'Update Data Berhasil',
            'data' => $testimonial
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $testimonial = Testimonial::find($id)->delete();

        return response()->json([
            'message' => 'Hapus Data Berhasil',
            'data' => $testimonial
        ]);
    }
}
