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

class SenderActionController extends Controller
{

//Puts "remove" into the table    
	public function putRemove($id){
        $invite = Invite::find($id); 
        $invite->show_to_sender = 0;
        $invite->save();

        Session::flash('success', 'Invite has been deleted!');
        return redirect()->route('invite.sent');       
    }
//Shows the invitation to the sender 
    public function getShowSender($id){
        $category = Category::where('category', 'invite')->first();
        $comments = Comment::where('post_id', $id)->where('category_id',$category->id)->orderby('id', 'desc')->get();
        $invite = Invite::find($id);
        if($invite->show_to_sender == 1){
            return view('invites.show')->with('invite', $invite)->with('comments', $comments);
        }else{
            return 'This invitation has been Deleted';
        }        
    }
//Destroys the Invitation
    public function destroy($id)
    {
        $invite = Invite::find($id);
        if($invite->accepted == 0 && $invite->rejected == 0){
            $invite->delete();

            Session::flash('success', 'Invitation has been Cancelled');
            return redirect()->route('invite.sent');
        }
    }
//Stores the comment of the sender
    public function postSenderComment(Request $request, $id){
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

        Session::flash('Success','Comment has been saved');

        return redirect()->route('invite.show_sender', $id);

    }

}
