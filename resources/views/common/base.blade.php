<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, minimum-scale=1.0, initial-scale=1">

  <title>{{$title}}</title>

  <script type="module" src="{{asset('web-components/header.js')}}"></script>

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
  <link rel="preconnect" href="https://adservice.google.com">
  <link rel="preconnect" href="https://www.googletagservices.com">
  <link rel="preconnect" href="https://pagead2.googlesyndication.com">
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
    <hpp-header
      login="{{$user->auth_id}}"
      top-href="{{action('TopController@index')}}"
      photo-create-href="{{action('PhotoController@create')}}"
      anime-href="{{action('AnimeController@index')}}"
      logout-href="{{action('Auth\TwitterController@logout')}}"
      login-href="{{action('Auth\TwitterController@redirectToProvider')}}"
    >
    </hpp-header>
    <hpp-side-menu
      login="{{$user->auth_id}}"
      photo-create-href="{{action('PhotoController@create')}}"
      anime-href="{{action('AnimeController@index')}}"
      logout-href="{{action('Auth\TwitterController@logout')}}"
      login-href="{{action('Auth\TwitterController@redirectToProvider')}}"
      about-href="{{action('TopController@about')}}"
      inquiry-href="{{action('TopController@inquiry')}}"
      kiyaku-href="{{action('TopController@kiyaku')}}"
      privacy-href="{{action('TopController@privacy')}}"
      hidden
    >
    </hpp-side-menu>
    <main>
      @yield('main')
    </main>
    <hpp-footer></hpp-footer>
  </div>
  @yield('script')
  <script type="module" src="{{asset('web-components/side-menu.js')}}"></script>
  <script type="module" src="{{asset('web-components/footer.js')}}"></script>
</body>
</html>
