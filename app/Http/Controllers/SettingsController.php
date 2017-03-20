<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
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

        /*
        * Location and sector must be created in category_types table
        *
        */
        //Pulling in Categories of type location
        $locations = Category_type::where('type', 'location')->first()->categories;
        $loc_arr = [];
        //Creating associative array for select
        if(isset($locations)){
            foreach($locations as $location){
                $loc_arr[$location->id] = $location->category;
            }
        }
        //Pulling categories of type Sector
        $sectors= Category_type::where('type', 'sector')->first()->categories;
        $sector_arr = [];
        //Creating associative array for select
        if(isset($sectors)){
            foreach($sectors as $sector){
                $sector_arr[$sector->id] = $sector->category;
            }  
        }
        //Tags should be created beforehand
        $tags= Tag::all();
        $tag_arr = [];
        foreach($tags as $tag){
            $tag_arr[$tag->id] = $tag->tag;
        }
        //Pulling details of the user
        $user_id = Auth::id();
        $details = Setting::find($user_id);
        
        $user = User::find(Auth::id());

        //Pulling interests and tags of user
        $chosen_tags = $user->provides->pluck('id');
        $chosen_interests = $user->requires->pluck('id');

        $data = ['details' => $details, 'loc_arr' => $loc_arr, 'sector_arr' => $sector_arr, 'tag_arr' =>$tag_arr, 'chosen_tags' => $chosen_tags, 'chosen_interests' => $chosen_interests];

        return view('settings.index')->with('data', $data);
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
            'bio' => 'min:20|max:200',
            'url' => 'url|max:100',
            'location' => 'int',
            'image' => 'sometimes|image',
        ]);

        if($request->hasFile('image')){
            $image = $request->file('image');
            $filename = time().'.'.$image->getClientOriginalExtension(); //Intervention library function
            $location = public_path('images/'.$filename);
            Image::make($image)->resize(800,400)->save($location); //Saves image 

            $setting->image = $filename; //Database has image name

        }

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
        dd();
        if($request->input('tag_id') != null){
            foreach($request->input('tag_id') as $tag_id){
                $user->tags()->attach($tag_id, ['type' => 'provides']);
            }
        }

        if($request->input('interest_id') != null){
            foreach($request->input('interest_id') as $int_id){
                $user->tags()->attach($int_id, ['type' => 'requires']);
            }
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

        $this->validate($request, [
            'bio' => 'min:20|max:200',
            'url' => 'url|max:100',
            'location_id' => 'int',
            'sector_id' => 'int',
            'image' => 'sometimes|image',
        ]);

        $setting->user_id = Auth::id();
        $setting->bio = $request->input('bio');
        $setting->url = $request->input('url');
        $setting->sector = $request->input('sector_id');
        $setting->service_description = $request->input('service_description');
        $setting->location = $request->input('location_id');
        

        $user = User::find(Auth::id());
        if($user->tags->count()>0){
            foreach($user->tags as $del){
                $del->pivot->delete();
            }
        }

        if($request->input('tag_id') != null){
            foreach($request->input('tag_id') as $tag_id){
                $user->tags()->attach($tag_id, ['type' => 'provides']);
            }
        }

        if($request->input('interest_id')!= null){
            foreach($request->input('interest_id') as $int_id){
                $user->tags()->attach($int_id, ['type' => 'requires']);
            }
        }     

        if($request->hasFile('image')){
            $image = $request->file('image');
            $filename = time().'.'.$image->getClientOriginalExtension(); //Intervention library function
            $location = public_path('images/'.$filename);
            Image::make($image)->resize(800,400)->save($location); //Saves image 
            //Grab old file name
            $oldfilename = $setting->image;
            //Put the new file name           
            $setting->image = $filename;
            //Delete old file
            Storage::delete($oldfilename);//To use Storage, make changes in confid/filesystems
        }

        $setting->save();

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
