@extends('common.base')

@section('head')
  <link href="{{ asset('/dist/css/photo/edit.css') }}" rel="stylesheet">
@endsection

@section('main')
  <h1 v-photo="{{$photo}}">写真編集</h1>

  <form action="{{action('PhotoController@update', $photo->id)}}" method="post" enctype="multipart/form-data" class="p-photo-form">
    {{ csrf_field() }}
    @method('put')

    @component('components.photo-form.name')
    @endcomponent

    @component('components.photo-form.title')
    @endcomponent

    @component('components.photo-form.comment')
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
    <button type="submit">修正</button>
  </form>
@endsection

@section('script')
  <script src="{{ asset('dist/js/photo/edit.js') }}"></script>
@endsection