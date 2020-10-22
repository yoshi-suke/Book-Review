<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <title>@yield('title')</title>
</head>
<body>
  <h1>@yield('title')</h1>
  @section('sidebar')
  <a href ="/books/create">新規追加</a>
  @endsection

  <div class="content">
    @yield('content')
  </div>
</body>
</html>
