<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class SiteController extends Controller
{
    public function index()
    {
        $data['posts']=Post::where('status',1)->get();
        return view('site.index',$data);
    }
    public function category($category)
    {
        $data['posts']=[];
        $category=Category::where('name',$category)->first();
        if($category)
        {
            $data['posts']=$category->posts;
        }
        return view('site.index',$data);
    }
    public function about()
    {
        $data['settings']=json_decode(file_get_contents(public_path('json/settings.json')), JSON_PRETTY_PRINT);
        return view('site.about',$data);
    }
    public function post($link)
    {
        $post=[];
        
        if($link){

        $post=Post::find($link);
        if($post==null){
            $post=Post::where('permalink',$link)->first();
        }
        $data['post']=$post;
        

        $data['content']=File::get('php/'.$post->content);
        return view('site.post',$data);
    }
    return abort(404);
}
public function comment($link,Request $request)
{  
    $post=[];
    if($link){

    $post=Post::find($link);
    if($post==null){
        $post=Post::where('permalink',$link)->first();
    }
    $data['post']=$post;
    Comment::create(['post_id'=>$post->id,'text'=>$request->text]);
    return redirect()->back();
}
return abort(404);

}
            
}
