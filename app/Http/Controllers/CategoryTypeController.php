<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category_type;
use App\Category;
use App\Project;
use Session;

class CategoryTypeController extends Controller
{

    protected $table = 'category_types';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $category_types = Category_type::all();
        return view('category_types.index')->with('category_types', $category_types);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Not required
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $category_type = new Category_type();

        $this->validate($request, [
            'type' => 'required|max:191'
        ]);

        $category_type->type = $request->input('type');

        $category_type->save();

        Session::flash('success','New Category Type has been Created');

        return redirect()->route('category_type.index');
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
        $category_type = Category_type::find($id);
        
        return view('category_types.edit')->with('category_type', $category_type);
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
        $category_type = Category_type::find($id);

        $this->validate($request, [
            'type' => 'required|unique:category_types,type,'.$id
        ]);

        $category_type->type = $request->input('type');
        $category_type->save();

        Session::flash('success', 'Category Type has been Updated');

        return redirect()->route('category_type.index');
    }

    public function delete($id){
        $category_type = Category_type::find($id);
        return view('category_types.delete')->with('category_type', $category_type);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category_type = Category_type::find($id);
        $category_type->delete();

        Session::flash('success', 'Category type has been Deleted');

        return redirect()->route('category_type.index');
    }
}
