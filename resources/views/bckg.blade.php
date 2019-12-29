@section('bckg')
<style>
  .videos{
    position: absolute;
    z-index: -1;
    overflow: hidden;
    width: 100vw; 
    height: 100vh
  }

  @media(max-width: 768px){
    .videos-v{
      overflow: hidden;
      height: 100vh;
      width: auto;
    }
  }

  @media(min-width: 768px){
    .videos-v{
      width: 100vw;
      max-width: 100%;
    }
  }
</style>
  <div class="videos">
    <video class="videos-v" autoplay loop>
      <source src="{{asset('assets/videos.mp4')}}" type="video/mp4">
    </video>
  </div>

  @endsection
