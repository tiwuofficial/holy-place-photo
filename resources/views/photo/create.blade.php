@extends('common.base')

@section('head')
  <link href="{{ mix('/dist/css/photo/create.css') }}" rel="stylesheet">
@endsection

@section('main')
  <section class="c-center-section" v-user="{{$user}}">
    <h1>写真投稿</h1>
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif
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

      <div class="p-photo-form__group--img-desc">
        <h2 class="p-photo-form__photo-title">写真</h2>
        <p class="p-photo-form__caution">※1枚は必須です</p>
        <p class="p-photo-form__caution">※5MB以内、ファイル形式はjpgまたはpngの画像を選択してください。</p>
      </div>

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
      <p class="p-photo-form__caution">投稿ボタンをクリックすることで、<a href="{{action('TopController@kiyaku')}}">利用規約</a>と<a href="{{action('TopController@privacy')}}">プライバシーポリシー</a>に同意したものとみなします。</p>
      <button type="submit" class="c-button" v-bind:disabled="isDisabled">投稿</button>
    </form>
  </section>
@endsection

@section('script')
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCdlSVTp1S7ryq4cQVBonRdAXPwPH1mhQ8"></script>
  <script src="{{ mix('dist/js/photo/create.js') }}"></script>
@endsection