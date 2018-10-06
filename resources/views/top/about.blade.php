@extends('common.base')

@section('head')
  <link href="{{ asset('/dist/css/top/about.css') }}" rel="stylesheet">
@endsection

@section('main')
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
  </section>
@endsection

@section('script')
  <script src="{{ asset('dist/js/top/about.js') }}"></script>
@endsection
