@extends('layouts.not_sidebar')

@section('content')
@if (Session::has('message'))
<div class="alert alert-{{Session::get('status')}}" role="alert">
  {{Session::get('message')}}
</div>
@endif
<style>
    input{
border: unset !important; 
border-bottom: 1px solid #eaeaea !important;
    }
    </style>  
<form action="" method="POST" enctype="multipart/form-data">
@csrf
@method('post')
<div class="card" style="border-radius: unset;">
    <div class="card-body">
        <div class="row">
            <div class="col-9">
                <input type="text" class="form-control form-title" name="title" placeholder="title" required>
            </div>
            <div class="col">
                <button type="submit "class="btn btn-sm btn-secondary mr-2"><i class="fa-solid fa-bookmark mr-2"></i>Save</button>
        </div>
    </div>
</div>
<div class="container-fluid" style="border-top:1px solid #eaeaea !important;padding-top:2em">

<div class="row">
    <div class="col-9">
        <div class="card">
            <textarea id="editor" name="content">
            </textarea>
            <input type="hidden" name="text" id="text">
        
            </div>
        </div>
        <div class="col-3" style="">
            <div class="card mb-2">
                <div class="card-body">
                    <label for="">Thumbnail</label>
                    <input type="file" class="form-control" name="thumbnail">
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <label for="">Category</label>
                        <input type="text" name="permallink" class="form-control" placeholder="categories">
                    </div>
                    <div class="form-group">
                        <label for="">Link</label>
                        <input type="text" name="permallink" class="form-control" placeholder="permallink">
                    </div>
                    <div class="form-group">
                        <label for="">Comment</label>
                    <select name="comment" id="" class="form-control">
                            <option value="1">Allowed</option>
                            <option value="0">Not Allowed</option>
                    </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

</form>

@endsection