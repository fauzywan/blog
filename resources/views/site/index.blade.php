@extends('layouts.site')
@section('content')
    <!-- Page Header-->
    <header class="masthead" style="background-image: url('{{asset('site/assets/img/1.png')}})">
        <div class="container position-relative px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    <div class="site-heading">
                        <h1>Blog</h1>
                        <span class="subheading">Kelompok 2</span>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Main Content-->
<div class="container px-4 px-lg-5">
    <div class="row gx-4 gx-lg-5 justify-content-center">
        <div class="col-md-10 col-lg-8 col-xl-7">
<!-- Post preview-->
@foreach ($posts as $post)
<div class="post-preview">
    <a href="{{$post->permalink==null?$post->id.'/read':$post->permalink.'/read'}}">
        <h2 class="post-title">{{$post->title}}</h2>
    </a>
    <p class="post-meta">
        Posted by
        <a href="#!">{{$post->writter->name}}</a>
        on {{date('F d, Y',strtotime($post->updated_at))}}
    </p>
</div>
<hr class="my-4" />
@endforeach
<!-- Pager-->
<div class="d-flex justify-content-end mb-4"><a class="btn btn-primary text-uppercase" href="#!">Older Posts →</a></div>
</div>
</div>
</div>
@endsection
