@extends('layouts.index')
@section('content')
<div class="row">
    <div class="col-4">
        <div class="card">
            <div class="card-header">
                <div class="row">
                  <div class="col-9">
                  <span>
                      Category
                    </span>
                  </div>
                  <div class="col">
                    <a href="/admin/categories" class="btn-sm btn-danger">Back</a>
                  </div>
                </div>
            </div>
            <div class="card-body text-center">
                    <h2>{{$category->name}}</h2>
            </div>
        </div>
            <a href="/admin/categories/{{$category->id}}/delete" 
                onclick="return confirm('Are you sure you want to delete this item?');" class="btn btn-danger w-100 mt-2">delete</a>
    </div>
    <div class="col">
        <div class="card ">

            <div class="card-header text-center bg-primary text-white">
                Posts
            </div>
        <table class="table table-striped">
            <tr>
                <th>no</th>
                <th>Name</th>
                <th>Action</th>
            </tr>
            @foreach ($category->posts as $post)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$post->title}}</td>
                <td>
                    <a href="/admin/post/{{$category->id}}/detail">detail</a>
                    <a href="/admin/post/{{$category->id}}/edit">Edit</a>
                    <a href="/admin/post/{{$category->id}}/delete" 
                      onclick="return confirm('Are you sure you want to delete this item?');">delete</a>
                </td>
            </tr>
            @endforeach
          </table>
        </div>

    </div>
</div>


@endsection