@extends('common.base')

@section('head')
  <link href="{{ mix('/dist/css/photo/edit.css') }}" rel="stylesheet">
@endsection

@section('main')
  <h1 v-photo="{{$photo}}">写真編集</h1>
  @if ($errors->any())
    <div class="alert alert-danger">
      <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <form action="{{action('PhotoController@update', $photo->id)}}" method="post" enctype="multipart/form-data" class="p-photo-form">
    {{ csrf_field() }}
    @method('put')
    <input type="hidden" v-model="deletePhotoUrls" name="deletePhotoUrls[]">

    @component('components.photo-form.name')
    @endcomponent

    @component('components.photo-form.title')
    @endcomponent

    @component('components.photo-form.comment')
    @endcomponent

    @component('components.photo-form.shooting-date')
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

    <button type="button" class="c-button" @click="editModalOpen" v-bind:disabled="isDisabled">修正</button>

    <modal :is-show="editModalFlg" @close="editModalClose">
      <div slot="contents">
        <p>編集しますか？</p>
        <p>編集用パスワード</p>
        <input type="password" name="edit_password" class="c-input-password">
        <button type="submit" class="c-button" v-bind:disabled="isDisabled">修正</button>
      </div>
    </modal>
  </form>
@endsection

@section('script')
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCdlSVTp1S7ryq4cQVBonRdAXPwPH1mhQ8"></script>
  <script src="{{ mix('dist/js/photo/edit.js') }}"></script>
@endsection