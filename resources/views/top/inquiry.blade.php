@extends('common.base')

@section('head')
  <link href="{{ asset('/dist/css/top/inquiry.css') }}" rel="stylesheet">
@endsection

@section('main')
  <h1>お問い合わせ</h1>
  @if (session('status'))
    {{ session('status') }}
  @endif

  @foreach($hoge as $fuga)
    <p>{!! nl2br(e($fuga->message)) !!}</p>
    @endforeach
  <form method="POST" action="{{action('TopController@inquiryStore')}}">
    {{ csrf_field() }}
    <input type="text" name="name" placeholder="お名前">
    <input type="email" name="email" placeholder="メールアドレス">
    <textarea name="message" placeholder="ご要望・お問い合わせ内容" required></textarea>
    <button type="submit">送信</button>
  </form>
@endsection
