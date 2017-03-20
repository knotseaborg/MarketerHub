<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Setting;
use App\Category;
use App\Category_type;
use App\Tag;
use App\Project;

class ExploreController extends Controller
{
    public function getSearch(){
    	$settings = Setting::all();

    	$sector_type = Category_Type::where('type', 'sector')->first();
    	$sectors = Category::where('category_type_id', $sector_type->id)->get();
    	
    	$sec_arr = [];
    	foreach($sectors as $sector){
    		$sec_arr[$sector->id] = $sector->category; 
    	}

    	$location_type = Category_Type::where('type', 'location')->first();
    	$locations = Category::where('category_type_id', $location_type->id)->get();

    	$loc_arr = [];
    	foreach($locations as $location){
    		$loc_arr[$location->id] = $location->category;
    	}

    	
    	$tags = Tag::all();
    	$tag_arr = [];
    	foreach($tags as $tag){
    		$tag_arr[$tag->id] = $tag->tag;
    	}

    	//Temporary
    	$users = User::all();
    	$user_arr=[];
    	foreach($users as $user){
    		$user_arr[$user->id] = $user->name;
    	}
    	return view('explore.search')->with('settings', $settings)->with('sectors', $sec_arr)->with('locations', $loc_arr)->with('tags', $tag_arr)->with('users', $user_arr);
    }
    //Not using this yet
    public function getResult(Request $request){
    	$settings = Setting::all();

    	$this->validate($request, [
    		''
    	]);

    	$sector_type = Category_Type::where('type', 'sector')->first();
    	$sectors = Category::where('category_type_id', $sector_type->id)->get();

    	$sec_arr = [];
    	foreach($sectors as $sector){
    		$sec_arr[$sector->id] = $sector->category; 
    	}

    	$location_type = Category_Type::where('type', 'location')->first();
    	$locations = Category::where('category_type_id', $location_type->id)->get();

    	$loc_arr = [];
    	foreach($locations as $location){
    		$loc_arr[$location->id] = $location->category;
    	}

    	
    	$tags = Tag::all();
    	$tag_arr = [];
    	foreach($tags as $tag){
    		$tag_arr[$tag->id] = $tag->tag;
    	}

    	return view('explore.result')->with('settings', $settings)->with('sectors', $sec_arr)->with('locations', $loc_arr)->with('tags', $tag_arr);
    }

    public function getUser(Request $request){
    	$this->validate($request, [
    		'user_id' => 'required'
    	]);
    	$user = User::find($request->input('user_id'));
    	$details = Setting::where('user_id', $request->user_id)->first();
    	if(isset($details)){
    		$location = Category::find($details->location)->category;
    		$sector = Category::find($details->sector)->category;
    	}else{
    		$location = null;
    		$sector = null;
    	}
    	return view('explore.show_user')->with('details', $details)->with('user', $user)->with('location', $location)->with('sector', $sector);
    }

    //Not using this either
    public function getResultByCategory(Request $request){
    	$this->validate($request, [
    		'location' => 'int',
    		'sector' => 'int'
    	]);
    	//$details = Setting::where('location', $request->location_id)->where('sector', );
    }

    public function getProjectIndex(Request $request){
    	$this->validate($request, [
    		'user_id' => 'int'
    	]);

    	$user = User::find($request->input('user_id'));

    	 $projects = Project::where('user_id', $request->input('user_id'))->orderby('id', 'desc')->paginate(10);
        return view('explore.projects.index')->with('projects', $projects)->with('user', $user);
    }

    public function getProjectShow($id){
        $project = Project::find($id);

        return view('explore.projects.show')->with('project', $project);
    }
}
