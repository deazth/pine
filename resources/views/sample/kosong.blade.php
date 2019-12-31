@extends(backpack_view('layouts.plain'))

@section('content')
<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img class="d-block w-100-px" src="https://img.rnudah.com/images/96/965910046299702.jpg" alt="First slide">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100-px" src="https://img.webmd.com/dtmcms/live/webmd/consumer_assets/site_images/article_thumbnails/video/caring_for_your_kitten_video/650x350_caring_for_your_kitten_video.jpg" alt="Second slide">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100-px" src="https://assets.theedgemarkets.com/TM-tower_20190829132219_www.tm_.com_.my_.jpg" alt="Third slide">
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
@endsection

@section('after_scripts')
<script type="text/javascript">
$('.carousel').carousel();
</script>
@endsection
