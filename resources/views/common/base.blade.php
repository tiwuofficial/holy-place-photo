<!DOCTYPE html>
<html>
<head prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# article: http://ogp.me/ns/article#">
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">

  <title>Holy Place Photo</title>
  <meta name="description" content="聖地を共有しよう！">
  @yield('head')
</head>
<body>
@include('common.header')
<div id="wrapper">
  <main class="main">
    @yield('main')
  </main>
</div>
@yield('script')
</body>
</html>
