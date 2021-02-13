@extends('layouts.app')

@section('title', 'Post New Books')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" id="card">
                <div class="card-header">{{ __('本を追加') }}</div>
                <div class="card-body">
                    <form action="/books" method="post">
                        @csrf
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('書名') }}</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                          <div class="col-md-8 offset-md-4">
                            <div class="btn btn-secondary" id="search">
                              {{ __('書名から検索') }}
                            </div>
                          </div>
                        </div>
                        <div class="form-group row">
                            <label for="author" class="col-md-4 col-form-label text-md-right">{{ __('著者') }}</label>
                            <div class="col-md-6">
                                <input id="author" type="text" class="form-control @error('author') is-invalid @enderror" name="author" value="{{ old('author') }}" required>
                                @error('author')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                          <label for="isbn" class="col-md-4 col-form-label text-md-right">{{ __('ISBN') }}</label>
                          <div class="col-md-6">
                            <input id="isbn" type="number" class="form-control @error('isbn') is-invalid @enderror" name="isbn" value="{{ old('isbn') }}"  autofocus>
                            @error('isbn')
                            <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                          </div>
                        </div>
                        <div class="form-group row">
                            <label for="score" class="col-md-4 col-form-label text-md-right">{{ __('評価') }}</label>
                            <div class="col-md-6">
                                <select id="score" class="form-control @error('score') is-invalid @enderror" name="score" value="{{ old('score') }}" required>
                                  <option>5</option>
                                  <option>4</option>
                                  <option>3</option>
                                  <option>2</option>
                                  <option>1</option>
                                </select>
                                @error('score')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="comment" class="col-md-4 col-form-label text-md-right">{{ __('感想') }}</label>
                            <div class="col-md-6">
                                <textarea id="comment" class="form-control @error('comment') is-invalid @enderror" rows="5" name="comment" value="{{ old('comment') }}" required></textarea>
                                @error('comment')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('追加') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="/js/title.js"></script>
@endsection
