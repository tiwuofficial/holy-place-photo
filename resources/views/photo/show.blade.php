@extends('common.base')

@section('main')
  <h1>写真詳細</h1>

  <p>{{$photo->name}}</p>
  <p>{{$photo->title}}</p>
  <p>{{$photo->comment}}</p>
  <p v-like-count="{{$photo->likeCount}}">@{{ likeCount }}</p>
  <a href="javascript:void(0);" @click="editModalOpen">編集</a>
  <a href="javascript:void(0);" @click="deleteModalOpen">削除</a>
  <div>
    <a href="javascript:void(0);" @click="like('{{$photo->id}}')" v-like-done="{{$photo->likeDone($user)}}">@{{ likeText }}</a>
  </div>
  @foreach($photo->urls as $url)
    <img src="{{$s3Url . $url->url}}">
  @endforeach

  <modal :is-show="editModalFlg" @close="editModalClose">
    <div slot="contents">
      <p>編集しますか？</p>
      <form action="{{action('PhotoController@edit', $photo->id)}}" method="post">
        {{ csrf_field() }}
        パスワード
        <input type="password" name="password">
        <button type="submit">編集画面へ</button>
      </form>
    </div>
  </modal>


  <modal :is-show="deleteModalFlg" @close="deleteModalClose">
    <div slot="contents">
      <p>削除しますか？</p>
      <form action="{{action('PhotoController@destory', $photo->id)}}" method="post">
        {{ csrf_field() }}
        @method('delete')
        パスワード
        <input type="password" name="password">
        <button type="submit">削除</button>
      </form>
    </div>
  </modal>

  <h2>このユーザーの他の写真</h2>

  @foreach($userPhotos as $photo)
    <p>{{$photo->name}}</p>
    <p>{{$photo->title}}</p>
    <p>{{$photo->comment}}</p>
    @foreach($photo->urls as $url)
      <img src="{{$s3Url . $url->url}}">
    @endforeach
  @endforeach

  <h2>同じアニメの写真</h2>

  @foreach($animePhotos as $photo)
    <p>{{$photo->name}}</p>
    <p>{{$photo->title}}</p>
    <p>{{$photo->comment}}</p>
    @foreach($photo->urls as $url)
      <img src="{{$s3Url . $url->url}}">
    @endforeach
  @endforeach
@endsection

@section('script')
  <script src="{{ asset('dist/js/photo/show.js') }}"></script>
@endsection