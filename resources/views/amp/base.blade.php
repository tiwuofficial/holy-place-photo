<!doctype html>
<html amp lang="ja">
<head>
  <meta charset="utf-8">
  <script async src="https://cdn.ampproject.org/v0.js"></script>
  @yield('head')
  <link rel="canonical" href="{{$canonicalUrl}}">
  <meta name="viewport" content="width=device-width,minimum-scale=1,initial-scale=1">
  <title>{{$title}}</title>
  <meta name="description" content="{{$description}}">
  <link rel="manifest" href="/manifest.json">
  <meta name="theme-color" content="#e1e4e8"/>
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
  @if(app()->environment('production'))
    <link rel="preconnect" href="https://res.cloudinary.com">
    <link rel="preconnect" href="https://adservice.google.com">
    <link rel="preconnect" href="https://www.googletagservices.com">
    <link rel="preconnect" href="https://adservice.google.co.jp">
    <link rel="preconnect" href="https://googleads.g.doubleclick.net">
    <link rel="preconnect" href="https://www.google-analytics.com">
    <link rel="preconnect" href="https://pagead2.googlesyndication.com">

    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-68543693-6"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'UA-68543693-6');
    </script>
  @endif

  <style amp-boilerplate>
    body {
      -webkit-animation: -amp-start 8s steps(1, end) 0s 1 normal both;
      -moz-animation: -amp-start 8s steps(1, end) 0s 1 normal both;
      -ms-animation: -amp-start 8s steps(1, end) 0s 1 normal both;
      animation: -amp-start 8s steps(1, end) 0s 1 normal both
    }

    @-webkit-keyframes -amp-start {
      from {
        visibility: hidden
      }
      to {
        visibility: visible
      }
    }

    @-moz-keyframes -amp-start {
      from {
        visibility: hidden
      }
      to {
        visibility: visible
      }
    }

    @-ms-keyframes -amp-start {
      from {
        visibility: hidden
      }
      to {
        visibility: visible
      }
    }

    @-o-keyframes -amp-start {
      from {
        visibility: hidden
      }
      to {
        visibility: visible
      }
    }

    @keyframes -amp-start {
      from {
        visibility: hidden
      }
      to {
        visibility: visible
      }
    }</style>
  <noscript>
    <style amp-boilerplate>body {
        -webkit-animation: none;
        -moz-animation: none;
        -ms-animation: none;
        animation: none
      }</style>
  </noscript>
</head>
<body>
  <main>
    @yield('main')
  </main>
</body>
</html>