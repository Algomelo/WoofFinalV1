
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
                <a href="img/gallery/Taco & Billie.jpg" class="gallery__link" data-fancybox="gallery">
                    <img src="img/gallery/Taco & Billie.jpg" class="gallery__image" />
                    <div class="gallery__overlay">
                        <span>Taco & Billie</span>
                    </div>
                </a>
            </div>
            <div class="gallery__item gallery__item--2">
                <a href="img/gallery/Ghost & Loki.jpg" class="gallery__link" data-fancybox="gallery">
                    <img src="img/gallery/Ghost & Loki.jpg" class="gallery__image" />
                    <div class="gallery__overlay">
                        <span>Ghost & Loki</span>
                    </div>
                </a>
            </div>
            <div class="gallery__item gallery__item--3">
                <a href="img/gallery/Alfie & Lulu.jpg" class="gallery__link" data-fancybox="gallery">
                    <img src="img/gallery/Alfie & Lulu.jpg" class="gallery__image" />
                    <div class="gallery__overlay">
                        <span>Alfie & Lulu</span>
                    </div>
                </a>
            </div>
            <div class="gallery__item gallery__item--4">
                <a href="img/juan&dogs.jpg" class="gallery__link" data-fancybox="gallery">
                    <img src="img/juan&dogs.jpg" class="gallery__image" />
                    <div class="gallery__overlay">
                        <span>Juan</span>
                    </div>
                </a>
            </div>
            <div class="gallery__item gallery__item--5">
                <a href="img/gallery/Funny Lulu & Loki.jpg" class="gallery__link" data-fancybox="gallery">
                    <img src="img/gallery/Funny Lulu & Loki.jpg" class="gallery__image" />
                    <div class="gallery__overlay">
                        <span>Funny Lulu & Loki</span>
                    </div>
                </a>
            </div>
            <div class="gallery__item gallery__item--6">
                <a href="img/gallery/Buddy & Gucci.jpg" class="gallery__link" data-fancybox="gallery">
                    <img src="img/gallery/Buddy & Gucci.jpg" class="gallery__image" />
                    <div class="gallery__overlay">
                        <span>Buddy & Gucci</span>
                    </div>
                </a>
            </div>
            <div class="gallery__item gallery__item--9 d-none">
                <a href="img/gallery/darby.jpg" class="gallery__link">
                    <img src="img/gallery/darby.jpg" class="gallery__image" data-fancybox="gallery" />
                    <div class="gallery__overlay">
                        <span>Show More</span>
                    </div>
                </a>
            </div>
            <div class="gallery__item gallery__item--9 d-none">
                <a href="img/gallery/Whisky.jpg" class="gallery__link">
                    <img src="img/gallery/Whisky.jpg" class="gallery__image" data-fancybox="gallery" />
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
            <div class="gallery__item gallery__item--9 d-none">
                <a href="img/gallery/Happy faces.jpg" class="gallery__link">
                    <img src="img/gallery/Happy faces.jpg" class="gallery__image" data-fancybox="gallery" />
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