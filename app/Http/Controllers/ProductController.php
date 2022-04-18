<?php

namespace App\Http\Controllers;

use App\Models\Product;

use Illuminate\Http\Request;


class ProductController extends Controller
{
    public function index()
    {
        $product = Product::all();
        return response()->json($product);
    }
    public function show($id)
    {
        $product = Product::find($id);
        return response()->json($product);
    }
    public function create(Request $request)
    {
        $this->validate($request, [
            "nama" => "required|string",
            "harga" => "required|string",
            "warna" => "required|string",
            "kondisi" => "required|in:baru,lama",
            "deskripsi" => "required|string",

        ]);
        $data = $request->all();

        $product = Product::create($data);
        return response()->json($product);
    }
}
