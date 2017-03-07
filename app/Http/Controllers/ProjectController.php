<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Project;
use App\Category;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::where('user_id', Auth::id())->orderby('id', 'desc')->paginate(10);
        return view('projects.index')->with('projects', $projects);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $cat_arr = [];
        foreach($categories as $category){
            $cat_arr[$category->id] = $category->category;
        }
        return view('projects.create')->with('categories', $cat_arr);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:191',
            'summary' => 'required',
            'content' => 'required',
            'category_id' => 'required|integer',
        ]);

        $project = new Project();
        $project->name = $request->input('name');
        $project->summary = $request->input('summary');
        $project->content = $request->input('content');
        $project->category_id = $request->input('category_id');
        $project->user_id = Auth::id();

        $project->save();

        Session::flash('success', 'Your project has been saved');

        return redirect()->route('project.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $project = Project::find($id);
        return view('projects.show')->with('project', $project);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = Category::all();
        $cat_arr = [];
        foreach($categories as $category){
            $cat_arr[$category->id] = $category->category;
        }

        $project = Project::find($id);
        return view('projects.edit')->with('project', $project)->with('categories', $cat_arr);
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

        $project = Project::find($id);

        $this->validate($request, [
            'name' => 'required|max:191|unique:projects,name,'.$id,
            'summary' => 'required',
            'content' => 'required',
            'category_id' => 'required|integer',
        ]);

        $project->name = $request->input('name');
        $project->summary = $request->input('summary');
        $project->content = $request->input('content');
        $project->category_id = $request->input('category_id');

        $project->save();

        Session::flash('success', 'Your Project has been Updated');

        return redirect()->route('project.show', $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $project = Project::find($id);
        $project->delete();

        Session::flash('success', 'Project has been Deleted');

        return redirect()->route('project.index');
    }
}
