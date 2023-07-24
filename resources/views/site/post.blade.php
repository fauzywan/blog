@extends('layouts.site')
@section('content')
<header class="masthead" style="background-image: url({{asset('images/'.$post->thumbnail)}})">
 
</header>
<article class="mb-4">
    <div class="container px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
                <h1>{{$post->title}}</h1>
            {!!$content!!}
            </div>
        </div>
        <hr>
        @if($post->categories)
        @foreach ($post->categories as $category)
            
        <a href="/category/{{$category->name}}" style="color:#ff2468">#{{$category->name}} <span class="text-dark">,</span></a>
        @endforeach
        @endif
    </div>
</article>
<hr>
<div class="container my-4">
    <div class="row">
<div class="col-8 m-auto">
    <h3 class="mb-3">Comment</h3>
    <ul >
        @foreach ($post->comments as $comment)
        
        <li>
            <div class="row">
            <div class="col">
                <span style="font-size: 15px">
                    {{$comment->text}}
                </span>
            </div>
            <small  style="font-size: 14px" class="col">{{$comment->created_at}}</small>
        </div>
        </li>
        @endforeach

    </ul>
@if(auth()->user() && $post->comment==1)
<hr>

    <form id="contactForm" action="" data-sb-form-api-token="API_TOKEN" method="POST">
        @csrf
        @method('post')
        <div class="form-floating">
            <textarea class="form-control" id="message" placeholder="Enter your message here..." style="height: 8rem" data-sb-validations="required" name="text"></textarea>
            <label for="message">Message</label>
        </div>
        <br />
        <div class="d-none" id="submitErrorMessage"><div class="text-center text-danger mb-3">Error sending message!</div></div>
        <!-- Submit Button-->
        <button class="btn btn-primary text-uppercase" type="submit">Send</button>
    </form>
    @else
    <span>Comment Not Allowed</span>
    @endif
</div>
</div>
</div>
@endsection
