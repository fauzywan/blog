<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class CategoryController extends Controller
{
    public function index()
    {
        $data['categories']=Category::all();
        return view('categories.index',$data);
    }

    public function store(Request $request)
    {
        $status='danger';
        $message='Process unsuccess';
        
        $request->validate(['name'=> 'unique:categories,name']);
        $name=$request->name;
        $create= Category::create(['name'=>$name]);
        if($create){
            $status='success';
            $message='Add Category Success';
        }
        return redirect('admin/categories')->with('status',$status)->with('message',$message);
    }
    
    public function detail(Category $category)
    {
        $data['category']=$category;
        return view('categories.detail',$data);
    }
    public function edit(Category $category)
    {

        $data['category']=$category;
        return view('categories.edit',$data);
    }
    public function delete(Category $category)
    {
        $status='danger';
        $message='Process unsuccess';
        $create= $category->delete();
        if($create){
            $status='success';
            $message='Delete Category Success';
        }
        return redirect('admin/categories')->with('status',$status)->with('message',$message);

    }
    public function update(Category $category,Request $request)
    {
        $status='danger';
        $message='Update Unsuccess';
        if($request->name==$category->name)
        {
            return redirect('/admin/categories')->with('status',$status)->with('message',$message);
        }
        
        $request->validate(['name'=> 'unique:categories,name']);
        
        $update= $category->update(['name'=>$request->name]);
        
        if($update){
            $status="success";
            $message="Update Succesfuly";
        }
        return redirect('/admin/categories')->with('status',$status)->with('message',$message);

    }
}
