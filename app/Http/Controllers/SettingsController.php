<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Setting;
use App\Category_type;
use App\Category;
use App\Tag;
use App\User;
use Session;

class SettingsController extends Controller
{
    public function __construct(){
            $this->middleware('auth');
        }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        //Location and sector must be created in category_types table
        $locations= Category_type::where('type', 'location')->first()->categories;
        //dd($locations);
        if(isset($locations)){
            foreach($locations as $location){
                $loc_arr[$location->id] = $location->category;
            }
        }
        $sectors= Category_type::where('type', 'sector')->first()->categories;
        if(isset($sectors)){
            foreach($sectors as $sector){
                $sector_arr[$sector->id] = $sector->category;
            }  
        }
        //Tags should also be created
        $tags= Tag::all();
        $tag_arr = [];
        foreach($tags as $tag){
            $tag_arr[$tag->id] = $tag->tag;
        }
        $user_id = Auth::id();
        $details = Setting::find($user_id);
        return view('settings.index')->with('details', $details)->with('locations', $loc_arr)->with('sectors', $sector_arr)->with('tags', $tag_arr);
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
        $setting = new Setting();

        $this->validate($request, [
            'bio' => 'min:50|max:200',
            'url' => 'url|max:100',
            'location' => 'max:100',
            'institution' => 'max:100',
        ]);

        $setting->user_id = Auth::id();
        $setting->bio = $request->input('bio');
        $setting->url = $request->input('url');
        $setting->sector = $request->input('sector_id');
        $setting->service_description = $request->input('service_description');
        $setting->location = $request->input('location_id');
        $setting->save();

        $user = User::find(Auth::id());
        if($user->tags->count()>0){
            foreach($user->tags as $del){
                $del->pivot->delete();
            }
        }
        foreach($request->input('tag_id') as $tag_id){
            $arr = [$tag_id, ['type' => 'provides']];
            $user->tags()->attach($tag_id, ['type' => 'provides']);
        }

        foreach($request->input('interest_id') as $int_id){
            $arr = [$int_id, ['type' => 'requires']];
            $user->tags()->attach($int_id, ['type' => 'requires']);
            //$user->tags()->updateExistingPivot($int_id, ['type' => 'requires']);
           
        }     

        Session::flash('success', 'Changes to your` Settings have been saved');

        return redirect()->route('setting.index');
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $setting = Setting::find(Auth::id());

        $setting->user_id = Auth::id();
        $setting->bio = $request->input('bio');
        $setting->url = $request->input('url');
        $setting->sector = $request->input('sector_id');
        $setting->service_description = $request->input('service_description');
        $setting->location = $request->input('location_id');
        $setting->save();



        $user = User::find(Auth::id());
        if($user->tags->count()>0){
            foreach($user->tags as $del){
                $del->pivot->delete();
            }
        }
        foreach($request->input('tag_id') as $tag_id){
            $arr = [$tag_id, ['type' => 'provides']];
            $user->tags()->attach($tag_id, ['type' => 'provides']);
        }

        foreach($request->input('interest_id') as $int_id){
            $arr = [$int_id, ['type' => 'requires']];
            $user->tags()->attach($int_id, ['type' => 'requires']);
            //$user->tags()->updateExistingPivot($int_id, ['type' => 'requires']);
           
        }     

        Session::flash('success', 'Changes to your Settings have been saved');

        return redirect()->route('setting.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
