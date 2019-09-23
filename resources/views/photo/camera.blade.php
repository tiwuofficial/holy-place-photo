@extends('common.base')

@section('head')
  <style>
    video {
      width: 100vw;
      height: 100vw;
    }
    .is-reverse {
      transform: scale(-1, 1);
    }
    .camera {
      position: relative;
    }
    .i-reload {
      position: absolute;
      right: 10px;
      top: 10px;
      width: 30px;
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

    <button id="snap">snap</button>
    <button id="front">Front</button>
    <button id="in">In</button>
    <div class="camera">
      <video autoplay playsinline></video>
      <img src="/img/icon/reload.svg" alt="menu icon" class="i-reload" id="js-change-camera">
    </div>
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

    document.querySelector('#snap').addEventListener('click', () => {
      console.log('snap');
      canvas.width = video.clientWidth;
      canvas.height = video.clientHeight;
      context.restore();
      if (!frontCamera) {
        context.scale(-1, 1);
        context.translate(-video.clientWidth, 0);
        context.drawImage(video, 0, 0, video.clientWidth, video.clientHeight);
        alert('inaa');
      } else {
        context.drawImage(video, 0, 0, video.clientWidth, video.clientHeight);
      }
    });

    let frontCamera = true;

    document.querySelector('#js-change-camera').addEventListener('click', async () => {
      if (frontCamera) {
        video.srcObject = await navigator.mediaDevices.getUserMedia({
          audio: false,
          video: {
            width: 300,
            height: 300,
            facingMode: "user"
          }
        });
        frontCamera = false;
        video.classList.add('is-reverse');
      } else {
        video.srcObject = await navigator.mediaDevices.getUserMedia({
          audio: false,
          video: {
            width: 300,
            height: 300,
            facingMode: {
              exact: "environment"
            }
          }
        });
        frontCamera = true;
        video.classList.remove('is-reverse');
      }
    });

    // document.querySelector('#front').addEventListener('click', async () => {
    //   video.srcObject = await navigator.mediaDevices.getUserMedia({
    //     audio: false,
    //     video: {
    //       facingMode: "user"
    //     }
    //   });
    // });

    //
    // document.querySelector('#in').addEventListener('click', async () => {
    //   video.srcObject = await navigator.mediaDevices.getUserMedia({
    //     audio: false,
    //     video: {
    //       facingMode: {
    //         exact: "environment"
    //       }
    //     }
    //   });
    // });

    (async () => {
      video.srcObject = await navigator.mediaDevices.getUserMedia({
        audio: false,
        video: {
          width: 300,
          height: 300,
          facingMode: {
            exact: "environment"
          }
        }
      });
      // video.srcObject = await navigator.mediaDevices.getUserMedia({
      //   audio: false,
      //   video: {
      //     width: 300,
      //     height: 300,
      //     facingMode: "user"
      //   }
      // });
      // video.classList.add('is-reverse');
    })();
  </script>
@endsection