<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, minimum-scale=1.0, initial-scale=1">

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
  <link rel="preconnect" href="https://res.cloudinary.com">

  <style>
    .l-header {
      width: 100%;
      height: 50px;
      display: -webkit-box;
      display: -ms-flexbox;
      display: flex;
      padding: 0 20px;
    }

    .l-header__item {
      display: -webkit-box;
      display: -ms-flexbox;
      display: flex;
      -webkit-box-align: center;
      -ms-flex-align: center;
      align-items: center;
    }

    .l-header__item:first-of-type {
      -webkit-box-flex: 1;
      -ms-flex-positive: 1;
      flex-grow: 1;
    }

    .l-header__item + .l-header__item {
      margin-left: 20px;
    }

    .l-header__item__link {
      color: #000;
    }

    .l-header__item__icon {
      height: 30px;
    }

    @media (max-width: 1100px) {
      .l-header__item {
        display: none;
      }

      .l-header__item--logo,
      .l-header__item--icon {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
      }
    }
  </style>

  @yield('head')

  @if(app()->environment('production'))
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
  @if(isset($googleAdsense) && app()->environment('production'))
    <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    <script>
      (adsbygoogle = window.adsbygoogle || []).push({
        google_ad_client: "ca-pub-6663866582332841",
        enable_page_level_ads: true
      });
    </script>
  @endif
</head>
<body>
  <div id="wrapper" data-sw-cache-list="{{$swCacheList}}">
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
