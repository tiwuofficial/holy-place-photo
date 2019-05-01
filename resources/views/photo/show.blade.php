@extends('common.base')

@section('head')
  <link href="{{ mix('/dist/css/photo/show.css') }}" rel="stylesheet">
  <meta name="twitter:image" content="{{$photo->urls->first()->full_url}}" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.5.0/js/swiper.min.js"></script>
  <script type="module" src="{{asset('web-components/photo-swiper.js')}}"></script>
@endsection

@section('main')
  <hpp-photo-swiper
    swiper-id="js-swiper"
    swiper-prev-class="js-swiper-button-prev"
    swiper-next-class="js-swiper-button-next"
    swiper-pagination-class="js-swiper-pagination"
    swiper-slide-class="swiper-slide"
    class="swiper-container"
    id="js-swiper"
  >
    <div class="swiper-wrapper">
      @foreach($photo->urls as $url)
        <div class="swiper-slide" style="background-image:url({{$url->full_url}})"></div>
      @endforeach
    </div>
    <div class="js-swiper-pagination swiper-pagination"></div>
    <div class="js-swiper-button-prev swiper-button-white"></div>
    <div class="js-swiper-button-next swiper-button-white"></div>
  </hpp-photo-swiper>


  <section class="c-center-section">

    <div class="p-photo-detail">
      <div class="p-photo-detail__info">
        <h1 class="p-photo-detail__info__title">{{$photo->title}}</h1>
        <p class="p-photo-detail__info__text">Anime is <a href="{{action('AnimeController@show', $photo->anime->id)}}" class="p-photo-detail__info__anime">{{$photo->anime_name}}</a></p>
        @if($photo->shooting_date)
          <p class="p-photo-detail__info__text">撮影日時 {{$photo->formatShootingDate}}</p>
        @endif
        <p class="p-photo-detail__info__text">Photo by <a href="{{action('UserController@show', $photo->user_id)}}" class="p-photo-detail__info__user">{{$photo->name}}</a></p>
        <p class="p-photo-detail__info__comment">{!! nl2br($photo->comment) !!}</p>
        <p class="p-photo-detail__info__create">
          <span>{{$photo->created_at}}</span>
          <hpp-photo-edit-link
            link="{{action('PhotoController@edit', $photo->id)}}"
            csrf-token="{{csrf_token()}}"
          >
          </hpp-photo-edit-link>
          <hpp-photo-destroy-link
            link="{{action('PhotoController@edit', $photo->id)}}"
            csrf-token="{{csrf_token()}}"
          >
          </hpp-photo-destroy-link>
        </p>
      </div>
      <hpp-photo-map
        map-id="js-map"
        map-class="map"
        lat="{{$photo->lat}}"
        lng="{{$photo->lng}}"
      >
        <div id="js-map" class="map"></div>
      </hpp-photo-map>
    </div>

    <div class="p-photo-detail--footer">
      <hpp-like-button
        photo-id="{{$photo->id}}"
        like-count="{{$photo->likeCount}}"
        like-done="{{$photo->likeDone($user->id)}}"
      ></hpp-like-button>
      <a target="_blank" href="" rel="nofollow" class="js-tw-share tw-share-button c-button--light-blue">
        Twitterでシェア
      </a>
    </div>
  </section>

  <hpp-user-photo-list
    user-id="{{$photo->user_id}}"
  >
    <h2>このユーザーの聖地写真</h2>
  </hpp-user-photo-list>

  <hpp-anime-photo-list
    anime-id="{{$photo->anime->id}}"
  >
    <h2>同じアニメの聖地写真</h2>
  </hpp-anime-photo-list>
@endsection

@section('script')
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCdlSVTp1S7ryq4cQVBonRdAXPwPH1mhQ8"></script>
  <script src="{{ mix('dist/js/photo/show.js') }}"></script>
  <script type="module" src="{{asset('web-components/photo-map.js')}}"></script>
  <script type="module" src="{{asset('web-components/like-button.js')}}"></script>
  <script type="module" src="{{asset('web-components/user-photo-list.js')}}"></script>
  <script type="module" src="{{asset('web-components/anime-photo-list.js')}}"></script>
  <script type="module" src="{{asset('web-components/photo-card.js')}}"></script>
  <script type="module" src="{{asset('web-components/photo-edit-link.js')}}"></script>
  <script type="module" src="{{asset('web-components/photo-destroy-link.js')}}"></script>
  <script type="module" src="{{asset('web-components/modal.js')}}"></script>
@endsection