@extends('amp.base')

@section('head')
  <script async custom-element="amp-story" src="https://cdn.ampproject.org/v0/amp-story-1.0.js"></script>
  <style amp-custom>
    body {
      background-color: white;
      line-height: 1;
    }
    .hpp-more-area {
      display: flex;
      flex-direction: column-reverse;
    }
    .hpp-more-button {
      width: 100%;
      border-radius: 3px;
      font-size: 16px;
      color: #333;
      background-color: #fff;
      border: solid 1px #333;
      cursor: pointer;
      display: block;
      padding: 10px 0;
      text-align: center;
      -webkit-appearance: none;
      text-decoration: none;
    }
  </style>
@endsection

@section('main')
  <!-- Cover page -->
  <amp-story standalone
             title="Holy Place Photo Story"
             publisher="Holy Place Photo"
             publisher-logo-src="launcher-144x144.png"
             poster-portrait-src="assets/cover.jpg">
    @foreach($photos as $photo)
      <amp-story-page id="{{$photo->id}}">
        <amp-story-grid-layer template="fill">
          <amp-img src="{{$photo->first_photo_url}}"
                   width="720" height="1280"
                   layout="responsive">
          </amp-img>
        </amp-story-grid-layer>
        <amp-story-grid-layer template="thirds">
          <div grid-area="lower-third" class="hpp-more-area">
            <a href="{{$photo->url}}" class="hpp-more-button">More</a>
          </div>
        </amp-story-grid-layer>
      </amp-story-page>
    @endforeach
    <amp-story-bookend src="/bookend.json" layout="nodisplay"></amp-story-bookend>
  </amp-story>
@endsection
