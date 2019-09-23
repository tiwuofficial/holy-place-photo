@extends('common.base')

@section('head')
  <link href="{{ mix('/dist/css/photo/create.css') }}" rel="stylesheet">
  <style>
    video {
      width: 100%;
    }
  </style>
@endsection

@section('main')
  <section class="c-center-section">
    <hpp-heading>
      <h1>写真撮影</h1>
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

    <button>snap</button>
    <video autoplay></video>
    <p>canvas</p>
    <canvas></canvas>
    <p id="errorMsg"></p>
  </section>
@endsection

@section('script')
  <script>
    // Put variables in global scope to make them available to the browser console.
    var video = document.querySelector('video');
    var canvas = document.querySelector('canvas');
    var context = canvas.getContext('2d');

    document.querySelector('button').addEventListener('click', () => {
      console.log('snap');
      canvas.width = video.clientWidth;
      canvas.height = video.clientHeight;
      context.drawImage(video, 0, 0, video.clientWidth, video.clientHeight);
    });

    navigator.mediaDevices.getUserMedia({
      audio: false,
      video: true
    }).then(function(stream) {
      video.srcObject = stream;
    })
    .catch(function(error) {
    });
  </script>
@endsection