<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected   $page = 'product',
                $validate = [
                    'name' => 'required',
                    // 'description' => 'required',
                ];
    
    public function __construct(Request $request)
    {
        $this->middleware('auth:sanctum');
    }
    public function test(Request $request)
    {
        $rows = Category::all();
        return $rows;
    }
    public function index(Request $request)
    {
        // $rows = Product::all();
        $rows = Product::with('category')->get();
        return $rows;
    }
    public function create()
    {
        return view('pages.category.create');
    }
    public function store(Request $request)
    {
        $this->validate($request, $this->validate);
        $data = new Category;
        $data->name = $request->name;
        $data->description = $request->description;
        $data->created_by = $request->created_by;
        if($data->save()) return 1;
    }
    public function show(Request $request,Category $category)
    {
        if ($request->is('api/*')) {
            //
            echo 1;
        } else {
            echo 0;
        }
    }
    public function edit(Category $category)
    {
        echo \json_encode($category);
    }
    public function update(Request $request, Category $category)
    {
        $this->validate($request, $this->validate);
        $data = Category::find($category->id);
        if ($data) {
            $data->name = $request->name;
            $data->description = $request->description;
            $data = $data->save();
        } 
    }
    public function destroy(Category $category)
    {
        $category->delete();
    }
}
