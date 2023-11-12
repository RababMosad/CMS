@extends('layouts.main' , ['noSideBar' => true])


@section('content')
<div class=" center container text-muted">
    <div class="row mb-4">
        <div>
            <center><img src="{{ $contents->profile_photo_url }}" width="150px" class="rounded-circle mx-auto"/></center>
            <h2 class="text-center mt-1">{{ $contents->name }}</h2>
        </div>
    </div>
      <div class="row p-3">
        <ul class="nav nav-tabs mb-3">
            @php
              $user_id= $contents->id;
              $comments = Route::current()->getName() == 'user_comments';
            @endphp
            <li class="nav-item " style="list-style:none">
             <a href="{{route('profile', $user_id)}}" class="nav-link {{$comments? '' : 'active'}}">منشوراتي</a>

            </li>
            <li class="nav-item " style="list-style:none">
                <a href="{{route('user_comments', $user_id)}}" class="nav-link {{$comments? 'active' : ''}}">تعليقاتي</a>

            </li>
        </ul>
          @if($comments)
            @include('user.comments_section')
          @else
             @include('user.posts_section')
          @endif
      </div>
  </div>
@endsection

