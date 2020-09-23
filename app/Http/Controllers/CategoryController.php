<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected   $page = 'category',
                $validate = [
                    'name' => 'required',
                    'description' => 'required',
                ];
    
    public function __construct(Request $request)
    {
        // if ($request->has('api_token')) {
        //     $this->middleware('auth:api');
        // } else {
        //     $this->middleware('auth');
        // }
    }
    public function index(Request $request)
    {
        $rows = Category::all();
        return $rows;
        // if ($request->has('api_token')) {
        //     return $rows;
        // } else {
        //     return view('pages.category.index',compact('rows'));
        // }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, $this->validate);
        $data = new Category;
        $data->name = $request->name;
        $data->description = $request->description;
        $data->created_by = $request->created_by;
        if($data->save()) return 1;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,Category $category)
    {
        // if (Gate::allows('MainGate', $category)) {
        //     return response()->json($category);
        // } else {
        //     return response()->json([
        //         'status' => 'error',
        //         'message' => 'access denied'
        //     ]);
        // }
        // echo json_encode($request->url());
        if ($request->is('api/*')) {
            //
            echo 1;
        } else {
            echo 0;
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        // if (Gate::allows('MainGate', $category)) {
        //     $row=$category;            
        //     return view('pages.category.edit',compact('row'));
        // } else {
        //     return redirect('/'.$this->page);
        // }
        echo \json_encode($category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        // $this->validate($request, $this->validate);
        // if (Gate::allows('MainGate', $category)) {
        //     $data = Category::find($category->id);
        //     if ($data) {
        //         $data->name = $request->name;
        //         $data->description = $request->description;
        //         $data = $data->save();
        //         session()->flash('message', __('text.successfully_updated'));
        //         session()->flash('alert-class','alert-success');
        //     } 
        // }
        // return redirect('/'.$this->page);
        $this->validate($request, $this->validate);
        $data = Category::find($category->id);
        if ($data) {
            $data->name = $request->name;
            $data->description = $request->description;
            $data = $data->save();
        } 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        // if (Gate::allows('MainGate', $category)) {
        //     $category->delete();
        //     session()->flash('message', __('text.successfully_deleted'));
        //     session()->flash('alert-class','alert-success');
        // }
        // return redirect('/'.$this->page);
        $category->delete();
    }
}
