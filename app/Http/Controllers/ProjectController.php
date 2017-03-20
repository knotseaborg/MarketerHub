<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
use App\Project;
use App\Category;
use App\Category_type;
use App\Tag;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }
    
    public function getStarred()
    {
        $projects = Project::where('user_id', Auth::id())->orderBy('id', 'desc')->limit(5)->get();
        return view('projects.starred')->with('projects', $projects);
    }
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
        $category_project_id = Category_type::where('type', 'project')->first()->id;
        if(!isset($category_project_id)){
            dd("Make Project category type first");
        }
        $categories = Category::where('category_type_id', $category_project_id)->get();
        $cat_arr = [];
        foreach($categories as $category){
            $cat_arr[$category->id] = $category->category;
        }
        $tags = Tag::all();
        $tag_arr = [];
        foreach($tags as $tag){
            $tag_arr[$tag->id] = $tag->tag;
        }
        return view('projects.create')->with('categories', $cat_arr)->with('tags', $tag_arr);
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

        $project->tags()->sync($request->input('tag_id'), false);//To assiciate project with tags. False means don't replace.

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
        $project = Project::find($id);
        $categories = Category::all();
        $cat_arr = [];
        foreach($categories as $category){
            $cat_arr[$category->id] = $category->category;
        }
        $tags = Tag::all();
        $tag_arr = [];
        foreach ($tags as $tag) {
            $tag_arr[$tag->id] = $tag->tag;     
        }
        $tagsForThisProject = $project->tags->pluck('id');
        return view('projects.edit')->with('project', $project)->with('categories', $cat_arr)->with('tags', $tag_arr)->with('tagsForThisProject', json_encode($tagsForThisProject));
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

        $project->tags()->sync($request->input('tag_id'), true);

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
