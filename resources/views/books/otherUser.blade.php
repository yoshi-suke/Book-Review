@extends('layouts.app')

@section('title', 'Other Users Books Index')

@section('sidebar')
  @@parent
  <p>本一覧</p>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h3>{{ $user->name }}さんの本一覧</h3>
            <a class="btn btn-secondary mb-1" href="/books/users" role="button">他の利用者一覧</a>
              @foreach($items as $item)
                <div class="media border border-secondary rounded bg-white py-4 mb-1">
                  <img src="" class="mr-3" alt="">
                  <div class="media-body">
                    <h5 class="mt-0 mb-1">{{ $item->name }}</h5>
                    <p class="mt-0 mb-1">{{ $item->author }}</p>
                    <p class="mt-0 mb-1">スコア：{{ $item->score }}</p>
                    <p class="mt-0 mb-1">{{ $item->comment }}</p>
                    <a class="btn btn-secondary" href="{{ action('BooksController@showOtherUsers', $item->id)}}" role="button">この本を読んだ利用者</a>
                  </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
