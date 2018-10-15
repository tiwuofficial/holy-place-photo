@extends('common.base')

@section('head')
  <link href="{{ asset('/dist/css/photo/show.css') }}" rel="stylesheet">
@endsection

@section('main')
  <div class="js-slider p-swiper swiper-container">
    <div class="swiper-wrapper">
      @foreach($photo->urls as $url)
        <div class="swiper-slide" style="background-image:url({{$url->full_url}})"></div>
      @endforeach
    </div>
    <div class="swiper-pagination"></div>
    <div class="swiper-button-prev swiper-button-white"></div>
    <div class="swiper-button-next swiper-button-white"></div>
  </div>

  <section class="c-center-section" v-photo="{{$photo}}">

    <div class="p-photo-detail">
      <div class="p-photo-detail__info">
        <h1 class="p-photo-detail__info__title">{{$photo->title}}</h1>
        <p class="p-photo-detail__info__anime">Anime is {{$photo->anime_name}}</p>
        <p class="p-photo-detail__info__name">Photo by {{$photo->name}}</p>
        <p class="p-photo-detail__info__comment">{!! nl2br($photo->comment) !!}</p>
        <p class="p-photo-detail__info__create">
          <span>{{$photo->created_at}}</span>
          <a href="javascript:void(0);" @click="editModalOpen">編集</a>
          <a href="javascript:void(0);" @click="deleteModalOpen">削除</a>
        </p>
      </div>
      <div id="map" class="p-photo-detail__map"></div>
    </div>

    <div class="p-photo-detail--footer">
        <a href="javascript:void(0);" class="c-button" @click="like('{{$photo->id}}')" v-like-done="{{$photo->likeDone($user)}}" v-like-count="{{$photo->likeCount}}">尊いね！ @{{ likeCount }}件</a>
        <a target="_blank" href="" rel="nofollow" class="js-tw-share tw-share-button c-button--light-blue">
          Twitterでシェア
        </a>
    </div>
  </section>

  <modal :is-show="editModalFlg" @close="editModalClose">
    <div slot="contents">
      <p>編集しますか？</p>
      <form action="{{action('PhotoController@edit', $photo->id)}}" method="post">
        {{ csrf_field() }}
        <div>
          パスワード
          <input type="password" name="password">
        </div>
        <button type="submit" class="c-button">編集画面へ</button>
      </form>
    </div>
  </modal>


  <modal :is-show="deleteModalFlg" @close="deleteModalClose">
    <div slot="contents">
      <p>削除しますか？</p>
      <form action="{{action('PhotoController@destory', $photo->id)}}" method="post">
        {{ csrf_field() }}
        @method('delete')
        <div>
          パスワード
          <input type="password" name="password">
        </div>
        <button type="submit" class="c-button">削除</button>
      </form>
    </div>
  </modal>
  <div class="p-photo-detail--other">
    @if(count($userPhotos) > 0)
      <h2>このユーザーの他の写真</h2>
      <ul class="p-photo-list">
        @foreach($userPhotos as $photo)
          <li class="p-photo-list__item">
            <a href="{{action('PhotoController@show', $photo->id)}}" class="p-photo-cassette">
              <img src="{{$photo->urls->first()->full_url}}">
            </a>
          </li>
        @endforeach
      </ul>
    @endif

    @if(count($animePhotos) > 0)
      <h2>同じアニメの写真</h2>
      <ul class="p-photo-list">
        @foreach($animePhotos as $photo)
          <li class="p-photo-list__item">
            <a href="{{action('PhotoController@show', $photo->id)}}" class="p-photo-cassette">
              <img src="{{$photo->urls->first()->full_url}}">
            </a>
          </li>
        @endforeach
      </ul>
    @endif
  </div>
@endsection

@section('script')
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCdlSVTp1S7ryq4cQVBonRdAXPwPH1mhQ8"></script>
  <script src="{{ asset('dist/js/photo/show.js') }}"></script>
@endsection