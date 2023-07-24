@extends('layouts.index')

@section('content')
@if (Session::has('message'))
<div class="alert alert-{{Session::get('status')}}" role="alert">
  {{Session::get('message')}}
</div>
@endif

@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<div class="row mt-2">
  <div class="col"></div>
    <form class="col row" action="" method="POST">
      @csrf
      @method("POST")
      <div class="col">
        <input type="text" name="name" placeholder="Category" class="form-control">
      </div>
        <button type="submit" class="btn btn-primary mb-3" style="background-color: #f06359;border:unset">create</button>
    </form>
  </div>

<div class="row mt-2">
    <table class="table table-striped">
        <tr>
            <th>no</th>
            <th>Name</th>
            <th>Action</th>
        </tr>
        @foreach ($categories as $category)
        <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$category->name}}</td>
            <td>
                <a href="/admin/categories/{{$category->id}}/detail">detail</a>
                <a href="/admin/categories/{{$category->id}}/edit">Edit</a>
                <a href="/admin/categories/{{$category->id}}/delete" 
                  onclick="return confirm('Are you sure you want to delete this item?');">delete</a>
            </td>
        </tr>
        @endforeach
      </table>
  </div>
@endsection