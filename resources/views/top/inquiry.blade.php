@extends('common.base')

@section('head')
  <link href="{{ asset('/dist/css/top/inquiry.css') }}" rel="stylesheet">
@endsection

@section('main')
  <h1>お問い合わせ</h1>
  <div  class="p-inquiry-form">
    @if (session('status'))
      <p>{{ session('status') }}</p>
    @endif

    <form method="POST" action="{{action('TopController@inquiryStore')}}">
      {{ csrf_field() }}
      <input type="text" name="name" class="c-input-text" placeholder="お名前" required>
      <input type="email" name="email" class="c-input-text" placeholder="メールアドレス" required>
      <textarea name="message" class="c-textarea" placeholder="ご要望・お問い合わせ内容" required></textarea>
      <button type="submit" class="c-button">送信</button>
    </form>
  </div>
@endsection

@section('script')
  <script src="{{ asset('dist/js/top/inquiry.js') }}"></script>
@endsection