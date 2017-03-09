<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Setting;
use App\Category_type;
use App\Category;
use Session;

class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $locations= Category_type::where('type', 'location')->first()->categories;
        //dd($locations);
        foreach($locations as $location){
            $loc_arr[$location->id] = $location->category;
        } 
        $user_id = Auth::id();
        $settings = Setting::find($user_id);
        return view('settings.index')->with('settings', $settings)->with('locations', $loc_arr);
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
        $setting->location = $request->input('location');
        $setting->institution = $request->input('institution');

        $setting->save();

        Session::flash('success', 'Changes to your Settings have been saved');

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
            'bio' => 'min:50|max:200',
            'url' => 'url|max:100',
            'location' => 'max:100',
            'institution' => 'max:100',
        ]);

        $setting->user_id = Auth::id();
        $setting->bio = $request->input('bio');
        $setting->url = $request->input('url');
        $setting->location = $request->input('location');
        $setting->institution = $request->input('institution');

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
