<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">

  <title>{{$title}}</title>
  <meta name="description" content="{{$description}}">

  <meta property="og:url" content="{{'https://' . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]}}">
  <meta property="og:type" content="{{isset($top) ? 'website' : 'article'}}">
  <meta property="og:title" content="{{$title}}">
  <meta property="og:description" content="{{$description}}">
  <meta property="og:site_name" content="Holy Place Photo">
  <meta property="og:locale" content="ja_JP">
  @if(isset($summaryLargeImage))
    <meta name="twitter:card" content="summary_large_image" >
  @else
    <meta name="twitter:card" content="summary">
  @endif
  <meta name="twitter:site" content="@holyplace_photo">

  <link href="https://fonts.googleapis.com/earlyaccess/notosansjapanese.css" rel="stylesheet" />


  @yield('head')

  <script async src="https://www.googletagmanager.com/gtag/js?id=UA-68543693-6"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'UA-68543693-6');
  </script>
</head>
<body>
  <div id="wrapper">
    @include('common.header')
    @include('common.sideMenu')
    <main>
      @yield('main')
    </main>
    @include('common.footer')
  </div>
  @yield('script')
</body>
</html>
