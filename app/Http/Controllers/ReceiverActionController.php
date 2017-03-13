<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Tag;
use App\User;
use App\Invite;
use Session;

class ReceiverActionController extends Controller
{
    public function putRemove($id){
        $invite = Invite::find($id);        
        $invite->show_to_receiver = 0;
        $invite->save();

        Session::flash('success','Invite has been deleted!');
        return redirect()->route('invite.received');                
    }

    public function putChecked($id){        
        $invite = Invite::find($id);
        $invite->checked = 1;
        $invite->save();
        return redirect()->route('invite.show', $id);
    }

    public function putAccepted($id){       
        $invite = Invite::find($id);
        $invite->accepted = 1;
        $invite->rejected = 0;
        $invite->checked = 1;
        $invite->save();
        //return view('invites.response')->with('sender_id', $invite->sender);
    }

    public function putRejected($id){        
        $invite = Invite::find($id);
        $invite->rejected = 1;
        $invite->accepted = 0;
        $invite->checked = 1;
        $invite->save();
        
        //return view('invites.response')->with('sender_id', $invite->sender);        
    }

    public function getShowReceiver($id){
        $invite = Invite::find($id);        
        if($invite->show_to_receiver == 1){
            return view('invites.show')->with('invite', $invite);
        }else{
            return 'This invitation has been Deleted';
        }       
    }
}
