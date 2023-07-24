@extends('layouts.index')
@section('content')


  <div class="row mt-2">
<div class="card col-md-12">
  <div class="card-header bg-primary text-white">Posts</div>
  <div class="card-body">
    <table class="table table-striped text-center">
        <tr>
            <th>no</th>
            <th>Post</th>
            <th>Comment</th>
            <th>Action</th>
        </tr>
        @foreach ($posts as $post)
        <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$post->title}}</td>
            <td><b >{{$post->comments->count()}} </b></td>
            
            <td>
                <a href="/{{auth()->user()->role_id!=3?'admin':'creator'}}/comment/{{$post->id}}/detail" class="badge badge-primary">detail</a>
            </td>
        </tr>
        @endforeach
        <tr >
            <td colspan="4">{{$posts->count()}} Post</td>
        </tr>
      </table>
  </div>
</div>
</div>
  @endsection
