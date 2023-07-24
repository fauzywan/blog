<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index(){
        if(auth()->user()->role_id!=3)
        {
            $posts=Post::all();
        }
        else{
            $posts=auth()->user()->posts;
        }
        
        $data['posts']=$posts;
        return view('comment.index',$data);
    }
    
    public function detail(Post $post){
        
         $data['post']=$post;
        return view('comment.detail',$data);
    }
   
    public function delete(Comment $comment){
        $post=$comment->post;
        $delete=$comment->delete();
        if($delete){
            $status='success';
            $message='Delete Category Success';
            if(auth()->user()->role_id!=3)
            {
                $url="admin/comment/$post->id/detail";
            }else{
                
                $url="creator/comment/$post->id/detail";
            }
        }

        return redirect($url)->with('status',$status)->with('message',$message);
    }   

}
