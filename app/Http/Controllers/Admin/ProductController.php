<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::paginate(10);
        return view('cruds.product.index', compact('products'));
    }

    public function create()
    {
        return view('cruds.product.create');
    }

    public function store(Request $request)
    {
        $validated = $this->validate($request, [
            "name"            => "required|min:3|max:100",
            "commission"      => "required|numeric",
            "image"           => "required|mimes:jpg,jpeg,png",
            "expiration_days" => "required|numeric|min:1",
            "clicks"          => "required|numeric|min:1",
            "price"           => "required|numeric|min:1",
        ]);
        $image = $request->file('image');

        $product = new Product();
        $product->fill($request->all());
        $product->image = substr(md5(date('YmdHis')),0,7). '.' . $image->getClientOriginalExtension();
        if ($product->save()) {
            $request->image->storeAs('public/products/', $product->image);
            Alert::success('', 'Registro exitoso');
            return redirect()->route('product.edit', $product->id);
        }
    }

    public function edit(Product $product)
    {

        return view('cruds.product.edit', compact('roles', 'product'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $this->validate($request, [
            "name"  => "required|min:3|max:100",
            "image" => "required|mimes:jpg,jpeg,png"
        ]);
        $image = $request->file('image');

        $product->fill($request->all());
        if ($product->save()) {
            $request->image->storeAs('public/products/', $product->image);
            Alert::success('', 'Registro actualizado');
        }

        return redirect()->back();
    }

    public function destroy(Product $product)
    {
        $product->delete();
        Alert::success('','Registro eliminado');
        return redirect()->back();
    }
}
