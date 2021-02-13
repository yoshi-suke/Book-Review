@extends('layouts.app')

@section('title', 'Books Index')

@section('sidebar')
  @@parent
  <p>本一覧</p>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h3>{{ $loginUser->name }}さんのページ</h3>
            <a class="btn btn-primary mb-1" href="/books/create" role="button">新規追加</a>
            <a class="btn btn-secondary mb-1" href="/books/users" role="button">他の利用者一覧</a>
              @foreach($items as $item)
                <div class="media border border-secondary rounded bg-white py-4 mb-1">
                  <img src="" class="mr-3" alt="">
                  <div class="media-body mr-1">
                    <!-- サムネも入れる予定 -->
                    <h5 class="mt-0 mb-1">{{ $item->name }}</h5>
                    <p class="mt-0 mb-1">{{ $item->author }}</p>
                    <p class="mt-0 mb-1">スコア：{{ $item->score }}</p>
                    <p class="mt-0 mb-1">{{ $item->comment }}</p>

                    <a class="btn btn-secondary" href="{{ action('BooksController@showOtherUsers', $item->id)}}" role="button">この本を読んだ利用者</a>
                    <a class="btn btn-secondary" href="{{ action('BooksController@edit', $item->id)}}" role="button">情報を更新</a>
                    <a class="del btn btn-warning" href="#" role="button" data-id="{{ $item->id }}">削除</a>

                    <form method="post" action="{{ action('BooksController@destroy', $item->id)}}" id="form_{{ $item->id }}">
                      {{ csrf_field() }}
                      {{ method_field('delete') }}
                    </form>
                  </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
<script src="/js/main.js"></script>
@endsection
