@extends('common.base')

@section('head')
  <link href="{{ mix('/dist/css/top/about.css') }}" rel="stylesheet">
@endsection

@section('main')
  {{-- todo web components --}}
  <div class="c-plane-section">
    <section>
      <h1>Holy Place Photoは聖地の写真投稿・共有サイトです</h1>
      <p>
        アニメの聖地に初めて行ったときの感動を覚えているでしょうか？<br>
        まるでアニメの中に入り込んだような不思議な感覚を覚えているでしょうか？<br>
        夢中で写真を撮ったあの気持ちを覚えているでしょうか？<br>
        たまに、撮った写真を見返して思い出してエモくなったり・・・。<br>
        溢れ出たこの気持を、この写真を共有したい！！！と盛り上がった管理人が勢いでこのサイトを作りました<br>
        皆さん是非使ってください！
      </p>
    </section>

    <section>
      <h2>管理人より</h2>
      <p>
        はじめまして。このサイトを作った<a href="https://twitter.com/tiwu_official">TIWU</a>です。<br>
        溢れ出た思いで開発をしてなんとか完成しました。個人開発なので至らぬ点は多々とあるとおもいます。<br>
        要望等何かあれば、<a href="https://twitter.com/holyplace_photo">公式アカウント</a>や<a href="{{action('TopController@inquiry')}}">お問い合わせ</a>から気軽に連絡をいただけると嬉しいです！<br>
      </p>
    </section>
  </div>
@endsection

@section('script')
  <script src="{{ mix('dist/js/top/about.js') }}"></script>
@endsection
