<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;

class apiProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();

        return response()->json($products);
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
        $data['gambar_kamera'] = $request->file('gambar_kamera')->store('gambars','public');
        $product = Product::create($data);
        
        return response()->json([
            'message' => 'Create Data Berhasil',
            'data' => $product
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
        $product = Product::find($id);

        return response()->json($product);
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
        $product = Product::find($id);
        if ($request->gambar_kamera) {
            $data['gambar_kamera'] = $request->file('gambar_kamera')->store('gambars','public');
        }
        $product->update($data);
        // $product->nama_kamera = $request->nama_kamera;
        // $product->harga_rental = $request->harga_rental;
        // $product->hari = $request->hari;
        // if($request->hasFile('gambar_kamera')){
        //     if($request->gambar_kamera && file_exists(storage_path('app/public/'.$request->gambar_kamera))){
        //         Storage::delete('public/'.$request->gambar_kamera);
        //     }
        //     $file = $request->file('gambar_kamera')->store('gambars','public');
        //     $product->gambar_kamera = $file;
        // } 
        // $product->save();

        return response()->json([
            'message' => 'Update Data Berhasil',
            'data' => $product
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
        $product = Product::find($id)->delete();

        return response()->json([
            'message' => 'Hapus Data Berhasil',
            'data' => $product
        ]);
    }
}
