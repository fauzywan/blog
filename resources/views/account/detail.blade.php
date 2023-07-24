@extends('layouts.index')
@section('content')
<div class="row">
    <div class="col-4">
        <div class="card">
            <div class="card-header">
                <div class="row">
                  <div class="col-9">
                  <span>
                      account
                    </span>
                  </div>
                  <div class="col">
                    <a href="/admin/account" class="btn-sm btn-danger">Back</a>
                  </div>
                </div>
            </div>
            <div class="card-body text-center">
                    <h2>{{$account->name}}</h2>
                  </div>
                  <ul class="list-group list-group-flush">
                    <li class="list-group-item">{{$account->email}}</li>
                    <li class="list-group-item">{{$account->role->name}}</li>
                    <li class="list-group-item text-center">
                <a href="/admin/account/{{$account->id}}/edit">Edit</a>

                    </li>
                  </ul>
        </div>
            <a href="/admin/categories/{{$account->id}}/delete" 
                onclick="return confirm('Are you sure you want to delete this item?');" class="btn btn-danger w-100 mt-2">delete</a>
    </div>
    <div class="col">
      <div class="card">
        <div class="card-header bg-primary text-white">
          <span>Post</span>
        </div>
        <div class="card-body">
          <table class="table table-striped">
            <tr>
                <th>no</th>
                <th>Title </th>
                <th>Status</th>
                <th>Action</th>
            </tr>
          
            @foreach ($account->posts as $post)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$post->title}}</td>
                <td>
                  @if ($post->status==1)
                  <span class="badge badge-sm alert-success">Publish</span>
                  @elseif ($post->status==2)
                  <span class="badge badge-sm badge-danger">confirm</span>
                  @else
                  <span class="badge badge-sm alert-primary px-2">draff</span>
                  @endif
                </td>
                {{-- <td>{{$post->user->name}}</td> --}}
                {{-- <td>{{$post->role->name}}</td> --}}
                <td>
                    <a href="/admin/post/{{$post->id}}/detail"  class="badge badge-sm badge-primary">detail</a>
                    <a href="/admin/post/{{$account->id}}/delete" 
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