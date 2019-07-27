@extends('common.base')

@section('head')
  <link href="{{ mix('/dist/css/photo/show.css') }}" rel="stylesheet">
  <meta name="twitter:image" content="{{$photo->urls->first()->full_url}}" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.5.0/js/swiper.min.js"></script>
  <script type="module" src="{{asset('web-components/photo-swiper.js')}}"></script>
  <style>
    hpp-photo-swiper + hpp-photo-detail,
    hpp-photo-detail + hpp-user-photo-list,
    hpp-user-photo-list + hpp-user-photo-list {
      margin-top: 30px;
    }
  </style>
  <link rel="amphtml" href="{{$ampUrl}}">
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

  <hpp-photo-detail
    title="{{$photo->title}}"
    anime-link="{{action('AnimeController@show', $photo->anime->id)}}"
    anime-name="{{$photo->anime_name}}"
    shooting-date="{{$photo->shooting_date}}"
    user-link="{{action('UserController@show', $photo->user_id)}}"
    user-name="{{$photo->name}}"
    comment="{!! nl2br($photo->comment) !!}"
    created-at="{{$photo->created_at}}"
    edit-link="{{action('PhotoController@edit', $photo->id)}}"
    csrf-token="{{csrf_token()}}"
    lat="{{$photo->lat}}"
    lng="{{$photo->lng}}"
    photo-id="{{$photo->id}}"
    like-count="{{$photo->likeCount}}"
    like-done="{{$photo->likeDone($user->id)}}"
  >
    <div id="js-map" class="map" slot="map"></div>
  </hpp-photo-detail>

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
  <script type="module" src="{{asset('web-components/photo-detail.js')}}"></script>
  <script type="module" src="{{asset('web-components/photo-detail-info.js')}}"></script>
  <script type="module" src="{{asset('web-components/photo-map.js')}}"></script>
  <script type="module" src="{{asset('web-components/like-button.js')}}"></script>
  <script type="module" src="{{asset('web-components/twitter-share-button.js')}}"></script>
  <script type="module" src="{{asset('web-components/user-photo-list.js')}}"></script>
  <script type="module" src="{{asset('web-components/anime-photo-list.js')}}"></script>
  <script type="module" src="{{asset('web-components/photo-card.js')}}"></script>
  <script type="module" src="{{asset('web-components/photo-edit-link.js')}}"></script>
  <script type="module" src="{{asset('web-components/photo-destroy-link.js')}}"></script>
  <script type="module" src="{{asset('web-components/modal.js')}}"></script>
@endsection