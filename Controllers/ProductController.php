<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request('search') && !request('filter')) {
            $products = Product::where('nama_kamera', 'like', '%' . request('search') . '%')
                                ->get();
        } elseif (!request('search') && request('filter')) {
            $products = Product::where('lokasi', 'like', '%' . request('filter') . '%')
                                ->get();
        } elseif (request('search') && request('filter')){
            $products = Product::where('nama_kamera', 'like', '%' . request('search') . '%')
                                ->orWhere('lokasi', 'like', '%' . request('filter') . '%')
                                ->get();
        } else {
            $products = Product::all();
        }

        return view('home', compact(
            'products'
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create');
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
        Product::create($data);
        return redirect()->back()->with('status','Kamera berhasil ditambah');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        return view('edit', compact('product'));
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
        $request->validate([
            'nama_kamera' => 'required|min:4',
            'gambar_kamera' => 'image|nullable'
        ]);

        $product = Product::findOrFail($id);
        $product->nama_kamera = $request->nama_kamera;
        $product->harga_rental = $request->harga_rental;
        $product->hari = $request->hari;
        if($request->hasFile('gambar_kamera')){
            if($request->gambar_kamera && file_exists(storage_path('app/public/'.$request->gambar_kamera))){
                Storage::delete('public/'.$request->gambar_kamera);
            }
            $file = $request->file('gambar_kamera')->store('gambars','public');
            $product->gambar_kamera = $file;
        } 
        $product->save();
        return redirect()->back()->with('status','Kamera Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();
        return redirect()->back()->with('status','Kamera Berhasil dihapus');
    }
}
