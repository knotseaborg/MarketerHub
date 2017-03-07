<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Category_type;
use Session;

class CategoryController extends Controller
{
    protected $table = 'categories';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        $category_types = Category_type::all();
        $types_arr =[];
        foreach($category_types as $type){
            $types_arr[$type->id] = $type->type;
        }
        //return $types_arr;
        return view('categories.index')->with('categories', $categories)->with('category_types', $types_arr);
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
        $category = new Category();

        $this->validate($request, [
            'category' => 'required|max:191',
            'category_type_id' => 'required|integer'
        ]);

        $category->category = $request->input('category');
        $category->category_type_id = $request->input('category_type_id');

        $category->save();

        Session::flash('success', 'New Category has been Created');

        return redirect()->route('category.index');
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
        $category_types = Category_type::all();
        $category = Category::find($id);
        $types_arr =[];
        foreach($category_types as $type){
            $types_arr[$type->id] = $type->type;
        }
        return view('categories.edit')->with('category_types', $types_arr)->with('category', $category);
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
        $category = Category::find($id);

        $this->validate($request, [
            'category' => 'required|unique:categories,category,'.$id,
            'category_type_id' => 'required|integer'
        ]);

        $category->category = $request->input('category');
        $category->category_type_id = $request->input('category_type_id');

        $category->save();

        Session::flash('success', 'Category has been updated');

        return redirect()->route('category.index');
    }

    public function delete($id){
        $category = Category::find($id);
        
        return view('categories.delete')->with('category', $category);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        $category->delete();

        Session::flash('success', 'Category has been Deleted');
        return redirect()->route('category.index');
    }
}
