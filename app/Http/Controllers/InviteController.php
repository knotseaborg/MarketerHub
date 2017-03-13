<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Tag;
use App\User;
use App\Invite;
use Session;

class InviteController extends Controller
{

    private function receiver_id_check($id){
        if(Invite::where('id', $id)->where('receiver_id', Auth::id())->count() >0){
            return true;
        }else{
            return false;
        }
    }

    private function sender_id_check($id){
        if(Invite::where('id', $id)->where('sender_id', Auth::id())->count() > 0){
            return true;
        }else{
            return false;
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$invites = Invite::all();

        //return view('invites.index')->with('invites', $invites);
    }

    public function getSent(){
        $invites = Invite::where('sender_id', Auth::id())->where('show_to_sender', 1)->get();

        return view('invites.index')->with('invites',$invites);
    }

    public function getReceived(){
        $invites = Invite::where('receiver_id', Auth::id())->where('show_to_receiver', 1)->get();

        return view('invites.index')->with('invites', $invites);
    }

    public function getNotify(){
        $invites = Invite::where('receiver_id', Auth::id())->where('checked', 0)->get();
        return view('invites.notify')->with('invites', $invites);
    }

    public function getDenied(){
        return view('invites.denied');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        $user_arr = [];
        foreach($users as $user){
            $user_arr[$user->id] = $user->name;
        }
        $tags = Tag::all();
        $tag_arr = [];
        foreach($tags as $tag){
            $tag_arr[$tag->id] = $tag->tag;
        }

        return view('invites.create')->with('tags', $tag_arr)->with('users', $user_arr);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $invite = new Invite();

        $this->validate($request, [
            'receiver_id' => 'required|integer',
            'subject' => 'required|min:5|max:191',
            'message' => 'required|min:20',
            'tag_id[]' => 'integer',
            'tag_id' => 'required',
        ]);

        $invite->receiver_id = $request->input('receiver_id');
        $invite->sender_id = Auth::id();
        $invite->subject = $request->input('subject');
        $invite->message = $request->input('message');

        $invite->save();

        $invite->tags()->sync($request->input('tag_id'), true);

        Session::flash('success', 'Invitation has been Sent');

        return redirect()->route('invite.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   
        $invite = Invite::find($id);
        //Can be modified. This is a duplicate
        if($invite->show_to_receiver == 1 && $this->receiver_id_check($id)){
            return view('invites.show')->with('invite', $invite);
        }elseif($invite->show_to_sender == 1 && $this->sender_id_check($id)){
            return view('invites.show')->with('invite', $invite);
        }
        else{
            return 'GTFO!';
        }
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $invite = Invite::find($id);
        if($this->sender_id_check($id)){
            if($invite->accepted == 0 && $invite->rejected == 0){
                $invite->delete();

                Session::flash('success', 'Invitation has been Cancelled');
                return redirect()->route('invite.sent');
            }        
        }else{
            return 'GTFO!';
        }
        
    }
}
