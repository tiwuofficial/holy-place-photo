@extends('common.base')

@section('head')
  <link href="{{ asset('/dist/css/photo/show.css') }}" rel="stylesheet">
@endsection

@section('main')
  <h1>写真詳細</h1>
  <div class="js-slider p-swiper swiper-container">
    <div class="swiper-wrapper">
      @foreach($photo->urls as $url)
        <div class="swiper-slide" style="background-image:url({{$s3Url . $url->url}})"></div>
      @endforeach
    </div>
    <div class="swiper-pagination"></div>
    <div class="swiper-button-prev swiper-button-white"></div>
    <div class="swiper-button-next swiper-button-white"></div>
  </div>


  <section class="c-center-section">
    <div class="p-photo-detail">
      <div class="p-photo-detail__info">
        <h2 class="p-photo-detail__info__title">{{$photo->title}}</h2>
        <p class="p-photo-detail__info__create">{{$photo->created_at}}</p>
        <p class="p-photo-detail__info__name">Photo by {{$photo->name}}</p>
        <p class="p-photo-detail__info__comment">{{$photo->comment}}</p>
      </div>

      <div class="p-photo-detail__action">
        <a href="javascript:void(0);" @click="editModalOpen" class="c-button">編集</a>
        <a href="javascript:void(0);" @click="deleteModalOpen" class="c-button">削除</a>
      </div>
    </div>
    <p v-like-count="{{$photo->likeCount}}">@{{ likeCount }}</p>
    <div>
      <a href="javascript:void(0);" @click="like('{{$photo->id}}')" v-like-done="{{$photo->likeDone($user)}}">@{{ likeText }}</a>
    </div>
  </section>

  <modal :is-show="editModalFlg" @close="editModalClose">
    <div slot="contents">
      <p>編集しますか？</p>
      <form action="{{action('PhotoController@edit', $photo->id)}}" method="post">
        {{ csrf_field() }}
        パスワード
        <input type="password" name="password">
        <button type="submit">編集画面へ</button>
      </form>
    </div>
  </modal>


  <modal :is-show="deleteModalFlg" @close="deleteModalClose">
    <div slot="contents">
      <p>削除しますか？</p>
      <form action="{{action('PhotoController@destory', $photo->id)}}" method="post">
        {{ csrf_field() }}
        @method('delete')
        パスワード
        <input type="password" name="password">
        <button type="submit">削除</button>
      </form>
    </div>
  </modal>

  <h2>このユーザーの他の写真</h2>

  <ul class="p-photo-list">
    @foreach($userPhotos as $photo)
      <li class="p-photo-list__item">
        <a href="{{action('PhotoController@show', $photo->id)}}" class="p-photo-cassette">
          <img src="{{$s3Url . $photo->urls->first()->url}}">
        </a>
      </li>
    @endforeach
  </ul>

  <h2>同じアニメの写真</h2>

  <ul class="p-photo-list">
    @foreach($animePhotos as $photo)
      <li class="p-photo-list__item">
        <a href="{{action('PhotoController@show', $photo->id)}}" class="p-photo-cassette">
          <img src="{{$s3Url . $photo->urls->first()->url}}">
        </a>
      </li>
    @endforeach
  </ul>

@endsection

@section('script')
  <script src="{{ asset('dist/js/photo/show.js') }}"></script>
@endsection