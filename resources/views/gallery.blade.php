
@include('layouts.header')
<head>
<link rel="stylesheet" href="css/style_galery.css">
<link rel="stylesheet" href="css/titulos.css">
<!-- jQuery (obligatorio) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<!-- Fancybox CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css" />

<!-- Fancybox JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>

</head>
<main >
<section class="hero-wrap hero-wrap-2" style="background-image: url('images/bg_2.jpg');" data-stellar-background-ratio="0.5">
    <div class="overlay">
        <div class="container d-flex justify-content-center align-items-center" style="padding: 7%; position: relative;">
            <h1 class="text-center titulo">Our Stars !!</h1>
        </div>
    </div>
</section>


<div>
    <div class="wrapper">
        <div class="gallery">
            <div class="gallery__item gallery__item--1">
                <a href="img/nina&mocca.jpg" class="gallery__link" data-fancybox="gallery">
                    <img src="img/nina&mocca.jpg" class="gallery__image" />
                    <div class="gallery__overlay">
                        <span>Show More</span>
                    </div>
                </a>
            </div>
            <div class="gallery__item gallery__item--2">
                <a href="img/DOG_WALKING/galleryy_h1.png" class="gallery__link" data-fancybox="gallery">
                    <img src="img/DOG_WALKING/galleryy_h1.png" class="gallery__image" />
                    <div class="gallery__overlay">
                        <span>Show More</span>
                    </div>
                </a>
            </div>
            <div class="gallery__item gallery__item--3">
                <a href="img/buddy.jpg" class="gallery__link" data-fancybox="gallery">
                    <img src="img/buddy.jpg" class="gallery__image" />
                    <div class="gallery__overlay">
                        <span>Show More</span>
                    </div>
                </a>
            </div>
            <div class="gallery__item gallery__item--4">
                <a href="img/juan&dogs.jpg" class="gallery__link" data-fancybox="gallery">
                    <img src="img/juan&dogs.jpg" class="gallery__image" />
                    <div class="gallery__overlay">
                        <span>Show More</span>
                    </div>
                </a>
            </div>
            <div class="gallery__item gallery__item--5">
                <a href="img/DOG_WALKING/GOPR0097.JPG" class="gallery__link" data-fancybox="gallery">
                    <img src="img/DOG_WALKING/GOPR0097.JPG" class="gallery__image" />
                    <div class="gallery__overlay">
                        <span>Show More</span>
                    </div>
                </a>
            </div>
            <div class="gallery__item gallery__item--6">
                <a href="img/DOG_WALKING/IMG_4354.jpg" class="gallery__link" data-fancybox="gallery">
                    <img src="img/DOG_WALKING/IMG_4354.jpg" class="gallery__image" />
                    <div class="gallery__overlay">
                        <span>Show More</span>
                    </div>
                </a>
            </div>
            <div class="gallery__item gallery__item--7 d-none">
                <a href="img/DOG_WALKING/gallery_4.png" class="gallery__link">
                    <img src="img/DOG_WALKING/gallery_4.png" class="gallery__image" data-fancybox="gallery" />
                    <div class="gallery__overlay">
                        <span>Show More </span> 
                    </div>
                </a>
            </div>
            <div class="gallery__item gallery__item--8 d-none">
                <a href="img/DOG_WALKING/IMG_8620_2.jpg" class="gallery__link">
                    <img src="img/DOG_WALKING/IMG_8620_2.jpg" class="gallery__image"  data-fancybox="gallery" />
                    <div class="gallery__overlay">
                        <span>Show More</span>
                    </div>
                </a>
            </div>
            <div class="gallery__item gallery__item--9 d-none">
                <a href="img/DOG_PARTIES/dogparty.png" class="gallery__link">
                    <img src="img/DOG_PARTIES/dogparty.png" class="gallery__image" data-fancybox="gallery" />
                    <div class="gallery__overlay">
                        <span>Show More</span>
                    </div>
                </a>
            </div>
            <div class="gallery__item gallery__item--10 d-none">
                <a href="img/DOG_WALKING/IMG_1474.jpg" class="gallery__link">
                    <img src="img/DOG_WALKING/IMG_1474.jpg" class="gallery__image"  data-fancybox="gallery" />
                    <div class="gallery__overlay">
                        <span>Show More</span>
                    </div>
                </a>
            </div>
            <div class="gallery__item gallery__item--11 d-none">
                <a href="img/DOG_WALKING/gallery_h2.png" class="gallery__link">
                    <img src="img/DOG_WALKING/gallery_h2.jpg" class="gallery__image"  data-fancybox="gallery"/>
                    <div class="gallery__overlay">
                        <span>Show More</span>
                    </div>
                </a>
            </div>
            <div class="gallery__item gallery__item--12 d-none">
                <a href="img/DOG_WALKING/gallery_3.png" class="gallery__link">
                    <img src="img/DOG_WALKING/gallery_3.png" class="gallery__image"  data-fancybox="gallery"/>
                    <div class="gallery__overlay">
                        <span>Show More</span>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>
</main>
@include('layouts.footer')