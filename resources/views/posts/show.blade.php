@extends('layouts.main')

@section('content')
<p class="h4 my-4">{{$post->title}}</p>
<input id="postId" type="hidden" value="{{$post->id}}">
<div class="col-md-8">
    <div class="bg-white p-5">
        <img style="float:right" src="{{ $post->user->profile_photo_url }}" width="50px" class="rounded-full"/>
        <p class="mt-2 me-3" style="display:inline-block;"><strong>{{$post->user->name}}</strong></p>   
        <div class="row mt-2 mb-4">
            <div class="col-3">
                <i class="far fa-clock"></i> <span class="comment_date text-secondary">{{$post->created_at->diffForHumans()}}</span>
            </div>
            <div class="col-3">
                <i class="fa-solid fa-align-justify"></i> <span class="comment_date text-secondary">{{$post->category->title?? 'None'}}</span>
            </div>
            <div class="col-3">
                <i class="fa-solid fa-comment"></i> <span class="comment_date text-secondary">{{ $post->comments->count() }} تعليقات</span>
            </div>
        </div>
        @if(file_exists(public_path('/storage/images/'.$post->image_path)))
            <img class="mb-4 mx-auto post-img" src="{{ asset('/storage/images/'.$post->image_path) }}" alt="">
        @endif
        <p class="lh-lg">{!!$post->body!!}</p>
        @auth
            <div class="row form-group mt-5">
                <div class="col-lg-12 col-md-6 col-xs-11">
                    <form action="{{route('comment.store')}}" id="comments" method="post">
                        @csrf
                        <div class="form-group">
                            <textarea class="form-control @error('body') is-invalid @enderror" rows="5" name="body" placeholder=" اضف تعليق جديد"></textarea>
                                    @error('body')
                                    <span class="invalid-feedback">
                                    <strong>{{$message}}</strong>
                                    </span>
                                @enderror
                        </div>
                        <button type="submit" class="btn btn-outline-dark mt-3">تعليق</button>
                        <input type="hidden" name="post_id" value="{{$post->id}}">
                    </form>
                </div>
            </div>
        @else  
         <div class="alert alert-info" role="alert">
            يرجى تسجيل الدخول كي تستطيع وضع تعليقات
         </div>
        @endauth

    </div>
    <div id="comments" class="p-0 word-break container mt-5">
        <h4 class="mb-5">التعليقات</h4>
         @include('comments.all' , ['comments' => $comments , 'post_id' => $post->id])
    </div>
  </div>
  
@endsection