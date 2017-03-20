<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Tag;
use App\User;
use App\Invite;
use App\Comment;
use App\Category;
use App\Category_type;
use Session;

class ReceiverActionController extends Controller
{
//Marks to "remove" the invitation
    public function putRemove($id){
        $invite = Invite::find($id);        
        $invite->show_to_receiver = 0;
        $invite->save();

        Session::flash('success','Invite has been deleted!');
        return redirect()->route('invite.received');                
    }
//Marks invitation checked
    public function putChecked($id){        
        $invite = Invite::find($id);
        $invite->checked = 1;
        $invite->save();
        return redirect()->route('invite.show_receiver', $id);
    }
//Marks invitation as Accepted
    public function putAccepted($id){       
        $invite = Invite::find($id);
        $invite->accepted = 1;
        $invite->rejected = 0;
        $invite->checked = 1;
        $invite->save();
    }
//Marks invitation as Rejected
    public function putRejected($id){        
        $invite = Invite::find($id);
        $invite->rejected = 1;
        $invite->accepted = 0;
        $invite->checked = 1;
        $invite->save();       
    }
//Shows the Invitaion to the receiver
    public function getShowReceiver($id){
        $category = Category::where('category', 'invite')->first();
        $comments = Comment::where('post_id', $id)->where('category_id',$category->id)->orderby('id', 'desc')->get();
        $invite = Invite::find($id);        
        if($invite->show_to_receiver == 1){
            return view('invites.show')->with('invite', $invite)->with('comments', $comments);
        }else{
            return 'This invitation has been Deleted';
        }
    }
//Stores the Receiver comment
    public function postReceiverComment(Request $request, $id){
        $comment = new Comment();
        $category = Category::where('category', 'invite')->first();

        if(!isset($category)){
            return 'Create Invite comment type and try again';
        }

        $this->validate($request, [
            'comment' => 'required|min:5',
        ]);

        $comment->post_id = $id;
        $comment->user_id = Auth::id();
        $comment->comment = $request->input('comment');
        $comment->category_id = $category->id;

        $comment->save();

        Session::flash('success','Comment has been saved');

        return redirect()->route('invite.show_receiver', $id);

    }
}
