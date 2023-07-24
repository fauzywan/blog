@extends('layouts.index')
@section('content')
@section('content')
@if (Session::has('message'))
<div class="alert alert-{{Session::get('status')}}" role="alert">
  {{Session::get('message')}}
</div>
@endif
<div class="row">
    <div class="col-4">
        <div class="card">
            <div class="card-header">
                <div class="row">
                  <div class="col-9">
                  <span>
                      Post
                    </span>
                  </div>
                  <div class="col">
                    <a href="/{{auth()->user()->role_id!=3?'admin':'creator'}}/comment" class="btn-sm btn-danger">Back</a>
                  </div>
                </div>
            </div>
            <div class="card-body text-center">
                    <h2>{{$post->writter->name}}</h2>
                  </div>
                  <ul class="list-group list-group-flush">
                    <li class="list-group-item">Title:{{$post->title}}</li>
                    <li class="list-group-item">Created At : {{$post->created_at}}</li>
                    <li class="list-group-item text-center">
                <a href="/{{auth()->user()->role_id!=3?'admin':'creator'}}/post/{{$post->id}}/edit">Edit</a>

                    </li>
                  </ul>
        </div>
            <a href="/{{auth()->user()->role_id!=3?'admin':'creator'}}/categories/{{$post->id}}/delete" 
                onclick="return confirm('Are you sure you want to delete this item?');" class="btn btn-danger w-100 mt-2">delete</a>
    </div>
    <div class="col">
      <div class="card">
        <div class="card-header bg-primary text-white">
          <span>Comment</span>
        </div>
        <div class="card-body">
          <table class="table table-striped">
            <tr>
                <th>Comment</th>
                <th>Action</th>
            </tr>
          
            @foreach ($post->comments as $comment)
            <tr>
                <td>{{$comment->text}}</td>
                <td>
                    <a href="/{{auth()->user()->role_id!=3?'admin':'creator'}}/comment/{{$comment->id}}/delete" 
                      onclick="return confirm('Are you sure you want to delete this item?');" class="badge badge-sm badge-danger">delete</a>
                </td>
            </tr>
            @endforeach
          </table>
        </div>
      </div>
    </div>
    
</div>


@endsection