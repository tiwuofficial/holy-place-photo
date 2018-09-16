@extends('common.base')

@section('head')
  <link href="{{ asset('/dist/css/photo/create.css') }}" rel="stylesheet">
@endsection

@section('main')
  <section class="c-center-section">
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

      @for ($i = 1; $i <= 5; $i++)
        @component('components.photo-form.photo', [
          'id' => $i
        ])
        @endcomponent
      @endfor


      @component('components.photo-form.anime', [
        'animes' => $animes
      ])
      @endcomponent
      <button type="submit">保存</button>
    </form>
  </section>
@endsection

@section('script')
  <script src="{{ asset('dist/js/photo/create.js') }}"></script>
@endsection