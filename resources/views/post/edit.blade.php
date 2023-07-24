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
<form action="" method="POST" enctype="multipart/form-data" id="form">
@csrf
@method('put')
<div class="card" style="border-radius: unset;">
    <div class="card-body">
        <div class="row">
            <div class="col-9">
                <input type="text" class="form-control form-title" name="title" placeholder="title" required value="{{$post->title}}">
            </div>
            <div class="col">
                <button type="button" id="save" class="btn btn-sm btn-secondary mr-2"><i class="fa-solid fa-bookmark mr-2"></i>Save</button>
                @if ($post->status==1)
                
                <button type="button" id="publish" class="btn btn-sm btn-danger mr-2"><i class="fa-solid fa-paper-plane mr-2"></i>Back to Draff</button>
                @else
                <button type="button" id="publish" class="btn btn-sm btn-success mr-2"><i class="fa-solid fa-paper-plane mr-2"></i>Publish</button>
                @endif
        </div>
    </div>
</div>
<div class="container-fluid" style="border-top:1px solid #eaeaea !important;padding-top:2em">

<div class="row">
    <div class="col-9">
        <div class="card">
            <textarea id="editor" name="content">
                {!!$content!!}
            </textarea>
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
                        <input type="text" name="categories" class="form-control" placeholder="categories" value="{{$categories}}">
                    </div>
                    <div class="form-group">
                        <label for="">Link</label>
                        <input type="text" name="permallink" class="form-control" placeholder="permallink" value="{{$post->permalink}}">
                    </div>
                    <div class="form-group">
                        <label for="">Comment</label>
                    <select name="comment" id="" class="form-control">
                        
                        <option value="1">Allowed</option>
                        @if ($post->comment==0)
                        <option value="0" selected>Not Allowed</option>
                        @else
                        <option value="0">Not Allowed</option>
                        @endif
                    </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

</form>

<script>
    
    const save=document.getElementById('save');
    const publish=document.getElementById('publish');
    const form =document.getElementById('form');
    save.addEventListener('click',function(){
        
        form.action=`/{{auth()->user()->role_id!=3?'admin':'creator'}}/post/{{$post->id}}/save`
        form.submit()
    })
    publish.addEventListener('click',function(){
        
        form.action=`/{{auth()->user()->role_id!=3?'admin':'creator'}}/post/{{$post->id}}/publish`

        form.submit()
    })
</script>
@endsection