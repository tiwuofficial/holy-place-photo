@extends('common.base')

@section('head')
  <link href="{{ asset('/dist/css/photo/create.css') }}" rel="stylesheet">
@endsection

@section('main')
  <section class="c-center-section" v-user="{{$user}}">
    <h1>写真投稿</h1>

    <form action="{{action('PhotoController@store')}}" method="post" enctype="multipart/form-data" class="p-photo-form">
      {{ csrf_field() }}

      @component('components.photo-form.name')
      @endcomponent

      @component('components.photo-form.title')
      @endcomponent

      @component('components.photo-form.comment')
      @endcomponent

      @component('components.photo-form.password')
      @endcomponent

      @component('components.photo-form.password-confirm')
      @endcomponent

      <h2 class="p-photo-form__photo-title">写真</h2>
      <p class="p-photo-form__caution p-photo-form__caution">※1枚は必須です</p>
      <p class="p-photo-form__caution p-photo-form__caution">※5MB以内、ファイル形式はjpgまたはpngの画像を選択してください。</p>

      @for ($i = 0; $i < 5; $i++)
        @component('components.photo-form.photo', [
          'id' => $i
        ])
        @endcomponent
      @endfor

      @component('components.photo-form.map')
      @endcomponent

      @component('components.photo-form.anime', [
        'animes' => $animes
      ])
      @endcomponent
      <button type="submit" class="c-button">投稿</button>
    </form>
  </section>
@endsection

@section('script')
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCdlSVTp1S7ryq4cQVBonRdAXPwPH1mhQ8"></script>
  <script src="{{ asset('dist/js/photo/create.js') }}"></script>
@endsection