<side-menu :is-show="sideMenuFlg" @close="sideMenuClose">
  <ul slot="contents" class="c-side-menu">
    <li class="c-side-menu__item c-side-menu__item--main">
      <a href="{{action('PhotoController@create')}}" class="c-side-menu__item__link">投稿する</a>
    </li>
    <li class="c-side-menu__item c-side-menu__item--main">
      <a href="{{action('AnimeController@index')}}" class="c-side-menu__item__link">アニメ一覧</a>
    </li>
    @if($user->auth_id)
    <li class="c-side-menu__item c-side-menu__item--main">
      <a href="{{action('Auth\TwitterController@logout')}}" class="c-side-menu__item__link">ログアウト</a>
    </li>
    @else
      <li class="c-side-menu__item c-side-menu__item--main">
        <a href="{{action('Auth\TwitterController@redirectToProvider')}}" class="c-side-menu__item__link">ログイン</a>
      </li>
    @endif
    <li class="c-side-menu__item">
      <a href="{{action('TopController@about')}}" class="c-side-menu__item__link">このサイトについて</a>
    </li>
    <li class="c-side-menu__item">
      <a href="{{action('TopController@inquiry')}}" class="c-side-menu__item__link">お問い合わせ</a>
    </li>
    <li class="c-side-menu__item">
      <a href="{{action('TopController@kiyaku')}}" class="c-side-menu__item__link">利用規約</a>
    </li>
    <li class="c-side-menu__item">
      <a href="{{action('TopController@privacy')}}" class="c-side-menu__item__link">プライバシーポリシー</a>
    </li>
  </ul>
</side-menu>