<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Services</title>
</head>

<body>
@include('layouts.header')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<style>
  .imagen{
    width: 50%;
  }
  .texto{ width: 50%;
  }
  .leftcarrousel{
    margin-left: 2%
  }
  .rightcarrousel{
    margin-left: -2%
  }
</style>  
<div class="section" style="width: 100%;text-align: -webkit-center;">
  <div class="row d-flex" style="width: 100%;">
    <div class="container imagen" >
      <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
          <div class="carousel-inner leftcarrousel">
            <div class="carousel-item active">
              <img src="/imagess/walk1.jpg" class="d-block  h-40" alt="...">
            </div>
            
            <div class="carousel-item">
              <img src="/imagess/walk2.jpg" class="d-block  h-40" alt="...">
            </div>
            <div class="carousel-item">
              <img src="/imagess/walk3.jpg" class="d-block h-40" alt="...">
            </div>
            
          </div>
        </div>
      </div>
    <div class="container texto d-block text-white"  >
      <div class="">
        <h1>Pre​mium​ Dog Walking</h1>
      </div>
        2-3 Hour Adventures with Safe Pick-up and Drop-off
        Experience the best in dog walking services with our premium offering. Treat your furry friend to 2-3 hour adventures filled with exploration and excitement. We prioritize safety and convenience, providing secure pick-up and drop-off for your peace of mind. Trust us to give your dog an unforgettable outdoor experience. Book now and let the adventures begin!
      </div>
    </div>
  <div>
  <div class="row d-flex" style="width: 100%;">
    <div class="container texto" >
    2
    </div>  
    <div class="container imagen">
      <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
          <div class="carousel-inner rightcarrousel">
            <div class="carousel-item active">
              <img src="/imagess/walk1.jpg" class="d-block img-fluid h-50" alt="...">
            </div>
            <div class="carousel-item">
              <img src="/imagess/walk2.jpg" class="d-block img-fluid h-50" alt="...">
            </div>
            <div class="carousel-item">
              <img src="/imagess/walk3.jpg" class="d-block img-fluid h-50" alt="...">
            </div>
          </div>
        </div>
      </div>
  <div>
</div>  

</body>
</html>