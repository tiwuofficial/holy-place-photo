@extends('common.base')

@section('head')
  <link href="{{ mix('/dist/css/photo/create.css') }}" rel="stylesheet">
  <style>
    hpp-heading + .p-photo-form {
      margin-top: 30px;
    }
    hpp-fieldset + hpp-fieldset {
      margin-top: 30px;
    }
  </style>
@endsection

@section('main')
  <section class="c-center-section" v-user="{{$user}}">
    <hpp-heading>
      <h1>写真投稿</h1>
    </hpp-heading>
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

      <hpp-fieldset
        label-for="name"
        label-text="名前"
        required
      >
        <hpp-input>
          <input type="text" name="name" id="name" required v-model="photo.name">
        </hpp-input>
      </hpp-fieldset>

      <hpp-fieldset
        label-for="title"
        label-text="タイトル"
        required
      >
        <hpp-input>
          <input type="text" id="title" name="title" required v-model="photo.title">
        </hpp-input>
      </hpp-fieldset>

      <hpp-fieldset
        label-for="comment"
        label-text="コメント"
      >
        <hpp-textarea>
          <textarea id="comment" name="comment" v-model="photo.comment"></textarea>
        </hpp-textarea>
      </hpp-fieldset>

      <hpp-fieldset
        label-for="shooting_date"
        label-text="撮影日時"
      >
        <hpp-input>
          <input type="date" id="shooting_date" name="shooting_date" v-model="photo.shooting_date">
        </hpp-input>
      </hpp-fieldset>

      <hpp-fieldset
        label-for="password"
        label-text="編集、削除用パスワード"
        required
      >
        <div>
          <hpp-input>
            <input id="password" type="password" name="password" required v-model="photo.password">
          </hpp-input>
          <hpp-form-caution-text
            text="※投稿を修正・削除する場合に必要になるパスワードです。"
          ></hpp-form-caution-text>
          <hpp-form-caution-text
            text="※4文字以上で入力しください。"
          ></hpp-form-caution-text>
        </div>
      </hpp-fieldset>

      <hpp-fieldset
        label-for="password_confirmation"
        label-text="編集、削除用パスワード（確認）"
        required
      >
        <hpp-input>
          <input id="password_confirmation" type="password" name="password_confirmation" required v-model="photo.passwordConfirm">
        </hpp-input>
      </hpp-fieldset>

      <div class="p-photo-form__group--img-desc">
        <hpp-heading>
          <h2>写真</h2>
        </hpp-heading>
        <hpp-form-caution-text
          text="※1枚は必須です"
        ></hpp-form-caution-text>
        <hpp-form-caution-text
          text="※5MB以内、ファイル形式はjpgまたはpngの画像を選択してください。"
        ></hpp-form-caution-text>
      </div>

      @for ($i = 0; $i < 5; $i++)
        @component('components.photo-form.photo', [
          'id' => $i
        ])
        @endcomponent
      @endfor

      @component('components.photo-form.map')
      @endcomponent

      @component('components.photo-form.anime')
      @endcomponent
      <p class="p-photo-form__caution">投稿ボタンをクリックすることで、<a href="{{action('TopController@kiyaku')}}">利用規約</a>と<a href="{{action('TopController@privacy')}}">プライバシーポリシー</a>に同意したものとみなします。</p>
      <button type="submit" class="c-button" v-bind:disabled="isDisabled">投稿</button>
    </form>
  </section>
@endsection

@section('script')
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCdlSVTp1S7ryq4cQVBonRdAXPwPH1mhQ8"></script>
  <script src="{{ mix('dist/js/photo/create.js') }}"></script>
  <script type="module" src="{{asset('web-components/heading.js')}}"></script>
  <script type="module" src="{{asset('web-components/fieldset.js')}}"></script>
  <script type="module" src="{{asset('web-components/input.js')}}"></script>
  <script type="module" src="{{asset('web-components/textarea.js')}}"></script>
  <script type="module" src="{{asset('web-components/form-caution-text.js')}}"></script>
@endsection