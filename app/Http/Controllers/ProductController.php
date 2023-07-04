<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;


class ProductController extends Controller
{
    public function index()
    {
        $products = Product::latest()->paginate(10);

        return view('product.index', compact('products'))
            ->with('i', (request()->input('page', 1) - 1) * 10);
    }



    public function create()
    {
        $categories = Category::all();
        return view('product.create', ['categories' => $categories]);
    }

    public function store(Request $request)
    {
        if ($request->isMethod('POST')) {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'description' => 'required',
                'price' => 'required',
                'imageProduct' => 'required|image|mimes:jpg,jpeg,png|max:1000',
                'audioProduct' => 'required|mimes:audio/mpeg,mpga,mp3,wav',
                'lyric' => 'required'

            ]);
            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }
            if ($request->hasFile('imageProduct')) {
                $file = $request->file('imageProduct');
                $path = public_path('image/product');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $file->move($path, $fileName);
            } else {
                $fileName = 'noname.jpg';
            }
            if ($request->hasFile('audioProduct')) {
                $file = $request->file('audioProduct');
                $path = public_path('audio/product');
                $fileNameAudio = time() . '_' . $file->getClientOriginalName();
                $file->move($path, $fileNameAudio);
            } else {
                $fileNameAudio = 'noname.mp3';
            }
            $newProduct = new Product();
            $newProduct->product_name = $request->name;
            $newProduct->product_price = $request->price;
            $newProduct->product_description = $request->description;
            $newProduct->audio = $fileNameAudio;
            $newProduct->lyric = $request->lyric;
            $newProduct->product_image = $fileName;
            $newProduct->category_id = $request->category;
            $newProduct->save();
            return redirect()->route('products.index')
                ->with('success', 'Product created successfully.');
        }
    }

    public function show($product_id)
    {
        $product = Product::find($product_id);
        return view('product.show', ['product' => $product]);
    }

    public function edit($product_id)
    {
        $categories = Category::all();
        $product = Product::with('category')->find($product_id);
        return view('product.edit', ['product' => $product, 'categories' => $categories]);
    }

    public function update(Request $request, $product_id)
    {
        if ($request->isMethod('POST')) {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'description' => 'required',
                'price' => 'required'
            ]);
            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }
            $fileName = "";
            if ($request->hasFile('imageProduct')) {
                $file = $request->file('imageProduct');
                $path = public_path('image/product');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $file->move($path, $fileName);
            }
            $fileNameAudio = "";
            if ($request->hasFile('audioProduct')) {
                $file = $request->file('audioProduct');
                $path = public_path('audio/product');
                $fileNameAudio = time() . '_' . $file->getClientOriginalName();
                $file->move($path, $fileNameAudio);
            }

            $product = Product::find($product_id);
            if ($product != null) {
                $product->product_name = $request->name;
                $product->product_price = $request->price;
                $product->category_id = $request->category;
                $product->product_description = $request->description;
                $product->lyric = $request->lyric;
                if ($fileName) {
                    $product->product_image = $fileName;
                }
                if ($fileNameAudio) {
                    $product->audio = $fileNameAudio;
                }
                $product->save();
                return redirect()->route('products.index')
                    ->with('success', 'Product updated successfully');
            } else {
                return redirect()->route('products.index')
                    ->with('Error', 'Product not update');
            }
        }
    }
    public function destroy($product_id)
    {
        $product = Product::find($product_id);
        $image_path = "/image/product/.$product->image";  // Value is not URL but directory file path
        if (File::exists($image_path)) {
            File::delete($image_path);
        }
        $product->delete();
        return redirect()->route('products.index')
            ->with('success', 'Product deleted successfully');
    }
}
