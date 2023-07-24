<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\PostCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{

    public function index(){
        if(auth()->user()->role_id==1){
            $data['posts']= Post::where('status',1)->get();
        }else{
            $data['posts']=auth()->user()->posts->where('status',1);
        }
        return view('post.index',$data);
    }
    public function confirmFile($post,$content)
    {

        $fileName=$post->id.'_confirm'.".php";
        File::put(public_path("php/$fileName"),$content);

        $post->update(['content'=>$post->id.".php"]);

    }
    public function createFile($post,$content)
    {
        $fileName=$post->id.".php";
        File::put(public_path("php/$fileName"),$content);

        $post->update(['content'=>$fileName]);

    }
    public function categories($request,$post)
    {
        if($request->categories!=null)
        {
            foreach(explode('#',$request->categories) as $category){
                if($category!=null)
                {
                    if(Category::where('name',$category)->count()>0){
                        $id=Category::where('name',$category)->first()->id;
                    }else{
                        Category::create(['name'=>$category]);
                        $id=Category::latest()->first()->id;
                    }
                        
                        if(PostCategory::where('post_id',$post->id)
                        ->where('category_id',$id)->count()==0){
                            PostCategory::create(['post_id'=>$post->id,'category_id',$id]);
                        }
                }
            }
        }
    }
   
    public function draff()
    {
        if(auth()->user()->role_id==1){
            $data['posts']= Post::where('status',0)->get();
            return view('post.index',$data);
        }else{
            $data['posts']=auth()->user()->posts->where('status',0);
            return view('post.user_index',$data);
        }
    }
    public function confirm()
    {
        if(auth()->user()->role_id==1){
            $data['posts']= Post::where('status','!=',0)->where('status','!=',1)->get();
            return view('post.index',$data);
        }else{
            $data['posts']=auth()->user()->posts->where('status','!=',0)->where('status','!=',1);
            return view('post.user_index',$data);
        }
    }
    public function create()
    {
        $data['categories']=Category::all();
        return view('post.create',$data);
    }
    public function store(Request $request)
    {
        // Perintah untuk menambahkan gambar
$pictureName='';
        if($request->file('thumbnail')){  
            $thumbnail=$request->file('thumbnail');
            $extension=$thumbnail->getClientOriginalExtension();
            $pictureName=substr($request->title,0,5)."-".now()->timestamp;
            $pictureName.=".".$extension;
            $thumbnail->move(public_path('images'),$pictureName);
        }

        $status='danger';
        $message='Process unsuccess';

        $create=Post::create([
        'title'=>$request->title,
        'user_id'=>auth()->user()->id,
        'editor_id'=>1,
        'thumbnail'=>$pictureName,
        'content'=>'',
        'status'=>0,
        'comment'=>$request->comment,
        'permalink'=>$request->permalink
    ]);
        if($create){
            $status='success';
            $message='Delete Category Success';
            $post=Post::latest()->first();            
            $this->createFile($post,$request->content);
            if(auth()->user()->role_id!=3)
            {
                $url="admin/post/$post->id/edit";
            }else{
                
                $url="creator/post/$post->id/edit";
                $post->update(['status'=>2]);
            }
            $this->categories($request,$post);
        }

        return redirect($url)->with('status',$status)->with('message',$message);
    }
    public function edit(Post $post){
        
            $data['post']= $post;
            $categories='';
            if($post->categories->count()>0){
                foreach ($post->categories as $category ) {
                    $categories.=" #$category->name";
                }
            }
            $data['categories']=$categories;
            if(File::exists('php/'.$post->id.'_confirm.php')){
                $data['content']=file_get_contents(public_path('php/'.$post->id.'_confirm.php'));

            }else{

                $data['content']=file_get_contents(public_path('php/'.$post->content));
            }
            return view('post.edit',$data);
        }
        public function save(Request $request,Post $post)
        {
            $pictureName=$post->thumbnail;
            if($request->file('thumbnail')){  
                $thumbnail=$request->file('thumbnail');
                $extension=$thumbnail->getClientOriginalExtension();
                $pictureName=$post->id.".".$extension;
                
                if($post->thumbnail!=null)
                {
                    unlink(public_path('images').'/'.$post->thumbnail,);
                }
                $thumbnail->move(public_path('images'),$pictureName);
            }
            if(auth()->user()->role_id!=3){
                $url='admin/post';
                    $status=$post->status;
                    $this->createFile($post,$request->content);
            }else{
                $url='creator/post';
                $this->confirmFile($post,$request->content);
                if($post->status!=1){
                    $post->update(['status'=>2]);
                }else{
                    $post->update(['status'=>3]);

                }
            }
            $this->categories($request,$post);
            $create=$post->update([
                'title'=>$request->title,
                'thumbnail'=>$pictureName,
                'comment'=>$request->comment,
                'permalink'=>$request->permalink
            ]);
                if($create){
                    $status='success';
                    $message='Save Post Success';
                }
                return redirect($url)->with('status',$status)->with('message',$message);
        }

        public function publish(Request $request,Post $post)
        {
            $pictureName=$post->thumbnail;
            if($request->file('thumbnail')){  
                $thumbnail=$request->file('thumbnail');
                $extension=$thumbnail->getClientOriginalExtension();
                $pictureName=$post->id.".".$extension;
                
                if($post->thumbnail!=null)
                {
                    unlink(public_path('images').'/'.$post->thumbnail,);
                }
                $thumbnail->move(public_path('images'),$pictureName);
            }
            if(auth()->user()->role_id!=3){
                $url="admin/post";
                if($post->status==1)
                {
                    $status=0;
                }else{
                    $status=1;
                    $this->createFile($post,$request->content);
                }
            }else{
                $url='creator/post';
                if($post->status==1)
                {
                    $status=0;
                }else{
                    $status=2;
                    
                }
                $this->confirmFile($post,$request->content);
            }

            $this->categories($request,$post);
            $create=$post->update([
                'title'=>$request->title,
                'thumbnail'=>$pictureName,
                'status'=>$status,
                'comment'=>$request->comment,
                'permalink'=>$request->permalink
            ]);
                if($create){
                    $status='success';
                    $message='Save Post Success';
                }

                return redirect($url)->with('status',$status)->with('message',$message);
        }
        public function delete(Post $post)
        {
            $status='danger';
            $message='Process unsuccess';
            PostCategory::where('post_id',1)->delete();
            $create= $post->delete();
            if($create){
                $status='success';
                $message='Delete Post Success';
            }
            if(auth()->user()->role_id==3){

                return redirect("creator/post/")->with('status',$status)->with('message',$message);
            }
            return redirect("admin/post/")->with('status',$status)->with('message',$message);
        }
        public function approve(Post $post)
        {

            $nama_file=public_path('php/'.implode('_confirm.php',explode('.php',$post->content)));
            $content=File::get('php/'.$post->content);
            if (File::exists($nama_file)) {
            $content=File::get($nama_file);
            File::put('php/'.$post->content,$content);
            File::delete($nama_file);             
            }

            $post->update(['status'=>1,'editor_id'=>auth()->user()->id]);
            $status='success';
            $message='Publish Post Successfully';

            if(auth()->user()->role_id==3){

                return redirect('creator/post')->with('status',$status)->with('message',$message);
            }
            return redirect('admin/post')->with('status',$status)->with('message',$message);
}
}