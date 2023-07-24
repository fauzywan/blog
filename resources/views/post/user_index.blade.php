@extends('layouts.index')
@section('content')
<div class="col-md-12">
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow">
      <button
        class="navbar-toggler"
        type="button"
        data-toggle="collapse"
        data-target="#navbarNav"
        aria-controls="navbarNav"
        aria-expanded="false"
        aria-label="Toggle navigation"
      >
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav" style="font-size: 14px">
            <li class="nav-item">
                <a   
                @if (Request::segment(3)=='')
                class="nav-link
                active border-active"
                style="color: #ff2468"
                @else
                class="nav-link"
                @endif
                  href="/creator/post"
                  >Post</a
                >
              </li>
            <li class="nav-item text-danger">
                <a      
                 @if (Request::segment(3)=='draff')
                class="nav-link
                active border-active"
                style="color: #ff2468"
                @else
                class="nav-link"
                @endif 
                href="/creator/post/draff">Draff </a>
              </li>
              <li class="nav-item text-danger">
                <a 
                @if (Request::segment(3)=='confirm')
                class="nav-link
                active border-active"
                style="color: #ff2468"
                @else
                class="nav-link"
                @endif 
                class="nav-link" href="/creator/post/confirm">Confirm </a>
              </li>
          
        </ul>
      </div>
    </nav>
  </div>
  <div class="row mt-2">
    <div class="col-10"></div>
    <div class="col"><a href="/creator/post/create" class="btn btn-primary"  style="background-color: #f06359;border:unset">Create Post</a></div>
  </div>
  <div class="row mt-2">

    <table class="table table-striped">
    
        <tr>
            <th>no</th>
            <th>Title</th>
            <th>Writter</th>
            <th>Editor</th>
            <th>Action</th>
        </tr>
        @foreach ($posts as $post)
        <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$post->title}}</td>
            <td>{{$post->writter->name}}</td>
            <td>{{$post->editor->name}}</td>
            <td>
                @if (Request::segment(3)!='confirm')
                <a href="/creator/post/{{$post->id}}/edit" class="badge  badge-primary">edit</a>
                @endif
                <a href="/creator/post/{{$post->id}}/delete" class="badge  badge-danger" 
                  onclick="return confirm('Are you sure you want to delete this item?');">delete</a>
            </td>
        </tr>
            
        @endforeach
      </table>
  </div>
@endsection