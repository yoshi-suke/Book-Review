@extends('layouts.app')

@section('title', 'User Index')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h3>ユーザー一覧</h3>
            <a class="btn btn-secondary mb-1" href="/books" role="button">戻る</a>
              @foreach($users as $user)
                <a href="{{ action('BooksController@showOtherUserBooks', $user->id)}}" class="text-decoration-none">
                  <div class="media border border-secondary rounded bg-white py-3 mb-1">
                    <img src="" class="mr-3" alt="">
                    <div class="media-body">
                      <h5 class="mt-0 mb-1">{{ $user->name }}さん</h5>
                    </div>
                  </div>
                </a>
            @endforeach
        </div>
    </div>
</div>
@endsection
