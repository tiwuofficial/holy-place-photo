@extends('common.base')

@section('head')
  <link href="{{ asset('/dist/css/photo/create.css') }}" rel="stylesheet">
@endsection

@section('main')
  <section class="c-center-section">
    <h1>写真投稿</h1>

    <form action="{{action('PhotoController@store')}}" method="post" enctype="multipart/form-data" class="p-photo-form">
      {{ csrf_field() }}

      <div class="p-photo-form__group">
        <label class="p-photo-form__group__name" for="name">名前</label>
        <input id="name" type="text" name="name" class="c-input-text">
      </div>

      <div class="p-photo-form__group">
        <label class="p-photo-form__group__name" for="title">タイトル</label>
        <input id="title" type="text" name="title" class="c-input-text">
      </div>

      <div class="p-photo-form__group">
        <label class="p-photo-form__group__name" for="comment">コメント</label>
        <textarea id="comment" name="comment" class="c-textarea"></textarea>
      </div>

      <div class="p-photo-form__group">
        <label class="p-photo-form__group__name" for="password">編集、削除用パスワード</label>
        <input id="password" type="password" name="password" class="c-input-password">
      </div>

      <div class="p-photo-form__group">
        <label class="p-photo-form__group__name" for="password-confirm">編集、削除用パスワード（確認）</label>
        <input id="password-confirm" type="password" name="password-confirm" class="c-input-password">
      </div>

      <div class="p-photo-form__group">
        <div class="p-photo-form__group__name p-photo-form__group__name--img">
          <label for="photo_1">
            写真をアップロード
            <input id="photo_1" type="file" name="photos[]" @change="file_change(1, $event)">
          </label>
          <p v-if="file[1].previewImageSrc !== ''" @click="clearImg(1)">写真を取り消す</p>
        </div>
        <div class="p-photo-form__group__img-wrap">
          <img v-if="file[1].previewImageSrc !== ''" :src="file[1].previewImageSrc">
          <img v-else src="{{asset('img/no_image.png')}}">
        </div>
      </div>

      <div class="p-photo-form__group">
        <div class="p-photo-form__group__name p-photo-form__group__name--img">
          <label for="photo_2">
            写真をアップロード
            <input id="photo_2" type="file" name="photos[]" @change="file_change(2, $event)">
          </label>
          <p v-if="file[2].previewImageSrc !== ''" @click="clearImg(2)">写真を取り消す</p>
        </div>
        <div class="p-photo-form__group__img-wrap">
          <img v-if="file[2].previewImageSrc !== ''" :src="file[2].previewImageSrc">
          <img v-else src="{{asset('img/no_image.png')}}">
        </div>
      </div>

      <h2 class="p-anime-list-header">アニメ一覧</h2>
      <ul class="p-anime-list">
        @foreach($animes as $anime)
          <li class="p-anime-list__item">
            <input id="anime_id_{{$anime->id}}" type="radio" name="anime_id" value="{{$anime->id}}">
            <label for="anime_id_{{$anime->id}}">{{$anime->name}}</label>
          </li>
        @endforeach
      </ul>

      <button type="submit">保存</button>
    </form>
  </section>
@endsection

@section('script')
  <script src="{{ asset('dist/js/photo/create.js') }}"></script>
@endsection