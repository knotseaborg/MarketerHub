<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Tag;
use App\User;
use App\Invite;
use Session;

class SenderActionController extends Controller
{
    
	public function putRemove($id){
        $invite = Invite::find($id); 
        $invite->show_to_sender = 0;
        $invite->save();

        Session::flash('success', 'Invite has been deleted!');
        return redirect()->route('invite.sent');       
    }

    public function getShowSender($id){
        $invite = Invite::find($id);    
        if($invite->show_to_sender == 1){
            return view('invites.show')->with('invite', $invite);    
        }else{
            return 'This invitation has been deleted';
        }   
    }

    public function destroy($id)
    {
        $invite = Invite::find($id);
        if($invite->accepted == 0 && $invite->rejected == 0){
            $invite->delete();

            Session::flash('success', 'Invitation has been Cancelled');
            return redirect()->route('invite.sent');
        }
    }

}
