<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{


    public function index()
    {
        $categories = Category::latest()->paginate(5);

        return view('category.index', compact('categories'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function create()
    {
        return view('category.create');
    }

    public function store(Request $request)
    {
        if ($request->isMethod('POST')) {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'description' => 'required'
            ]);
            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }
            $newCategory = new Category();
            $newCategory->category_name = $request->name;
            $newCategory->category_description = $request->description;
            $newCategory->save();
            return redirect()->route('category.index')
                ->with('success', 'Category created successfully.');
        }
    }

    public function show($category_id)
    {
        $category = Category::find($category_id);
        return view('category.show', ['category' => $category]);
    }

    public function edit($category_id)
    {
        $category = Category::find($category_id);
        return view('category.edit', ['category' => $category]);
    }

    public function update(Request $request, $category_id)
    {
        if ($request->isMethod('POST')) {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'description' => 'required',
            ]);
            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }
            $category = Category::find($category_id);
            if ($category != null) {
                $category->category_name = $request->name;
                $category->category_description = $request->description;
                $category->save();
                return redirect()->route('category.index')
                    ->with('success', 'Category updated successfully');
            } else {
                return redirect()->route('category.index')
                    ->with('Error', 'Category not update');
            }
        }
    }
    public function destroy($category_id)
    {
        $category = Category::find($category_id);
        $category->delete();
        return redirect()->route('category.index')
            ->with('success', 'Category deleted successfully');
    }
}
