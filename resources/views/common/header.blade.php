<header class="l-header">
  <div class="l-header__item l-header__item--logo">
    <a href="{{action('TopController@index')}}" class="l-header__item__link js-sw-fetch">Holy Place Photo</a>
  </div>
  <div class="l-header__item">
    <a href="{{action('PhotoController@create')}}" class="l-header__item__link">投稿する</a>
  </div>
  <div class="l-header__item">
    <a href="{{action('AnimeController@index')}}" class="l-header__item__link">アニメ一覧</a>
  </div>
  @if($user->auth_id)
    <div class="l-header__item">
      <a href="{{action('Auth\TwitterController@logout')}}" class="l-header__item__link">ログアウト</a>
    </div>
  @else
    <div class="l-header__item">
      <a href="{{action('Auth\TwitterController@redirectToProvider')}}" class="l-header__item__link">ログイン</a>
    </div>
  @endif
  <div class="l-header__item l-header__item--icon">
    <a href="javascript:void(0);" @click="sideMenuOpen">
      <img src="/img/icon/menu.svg" alt="menu icon" class="l-header__item__icon">
    </a>
  </div>
</header>