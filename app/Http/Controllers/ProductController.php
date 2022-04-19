<?php

namespace App\Http\Controllers;

use App\Models\Product;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

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
            "harga" => "required|int",
            "warna" => "required|string",
            "kondisi" => "required|in:baru,lama",
            "deskripsi" => "required|string",

        ]);
        $data = $request->all();

        $product = Product::create($data);
        return response()->json($product);
    }
    public function update(Request $request, $id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => "Product not found"], 404);
        };


        $this->validate($request, [
            "nama" => "string",
            "harga" => "int",
            "warna" => "string",
            "kondisi" => "in:baru,lama",
            "deskripsi" => "string",

        ]);

        $data = $request->all();
        $data['id'] = $id;
        $product->fill($data);
        $product->save();

        return response()->json($product);
    }
    public function delete(Request $request, $id)
    {
        $product = Product::find($id);
        $res = $product;

        if (!$product) {
            return response()->json(['message' => "Product not found"], 404);
        };

        $product->delete();
        return response()->json(["data" => $product, 'message' =>  "Product success delete"]);
    }
}
