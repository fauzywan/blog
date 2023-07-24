@extends('layouts.index')

@section('content')
@if (Session::has('message'))
<div class="alert alert-{{Session::get('status')}}" role="alert">
  {{Session::get('message')}}
</div>
@endif

<div class="row mt-2">
  <div class="col-10"></div>
   <div class="col">
    <a href="account/create" class="btn btn-primary mb-3" style="background-color: #f06359;border:unset">create Account</a>

   </div>
  </div>
<div class="row mt-2">
    <table class="table table-striped">
        <tr>
            <th>no</th>
            <th>Username</th>
            <th>Email</th>
            <th>Role</th>
            <th>Action</th>
        </tr>
        @foreach ($accounts as $account)
        <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$account->name}}</td>
            <td>{{$account->email}}</td>
            <td>{{$account->role->name}}</td>
            <td>
                <a href="/admin/account/{{$account->id}}/detail">detail</a>
                <a href="/admin/account/{{$account->id}}/edit">Edit</a>
                <a href="/admin/account/{{$account->id}}/delete" 
                  onclick="return confirm('Are you sure you want to delete this item?');">delete</a>
            </td>
        </tr>
        @endforeach
      </table>
  </div>

  @endsection
