<?php require 'layout/header.php'?>

<body>

<div class="hero_area">
    <!-- slider section -->
    <section class="slider_section ">
        <div class="slider_bg_box">
            <img src="images/girlsdance.jpeg" alt="">
        </div>
        <div id="customCarousel1" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="container ">
                        <div class="row">
                            <div class="col-md-7 ">
                                <div class="detail-box">
                                    <h1>
                                        Your Gateway to Unforgettable <br>
                                        Nights & Concerts
                                    </h1>
                                    <p>
                                        Dive into the heart of the nightlife with our curated events and top-tier concert experiences. Whether it’s the pulse of the dance floor or the surge of live music, we connect you with unforgettable moments.
                                    </p>
                                    <div class="btn-box">
                                        <a href="EventPageManager.php" class="btn1">
                                            Discover Events
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="container ">
                        <div class="row">
                            <div class="col-md-7 ">
                                <div class="detail-box">
                                    <h1>
                                        Experience the Best <br>
                                        Live Music Events
                                    </h1>
                                    <p>
                                        From intimate gigs to major festivals, explore a diverse lineup of musical talents and genres. Embrace the live music scene with events that resonate with your rhythm.
                                    </p>
                                    <div class="btn-box">
                                        <a href="EventFetcher.php?type=Concert" class="btn1">
                                            Find Concerts
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="container ">
                        <div class="row">
                            <div class="col-md-7 ">
                                <div class="detail-box">
                                    <h1>
                                        Nightlife & Parties <br>
                                        That Never End
                                    </h1>
                                    <p>
                                        Step into the vibrant world of nightclubs and exclusive parties. Discover venues that set the stage for nights filled with music, dance, and memories waiting to be made.
                                    </p>
                                    <div class="btn-box">
                                        <a href="EventFetcher.php?type=Nightclub" class="btn1">
                                            Join the Party
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <ol class="carousel-indicators">
                <li data-target="#customCarousel1" data-slide-to="0" class="active"></li>
                <li data-target="#customCarousel1" data-slide-to="1"></li>
                <li data-target="#customCarousel1" data-slide-to="2"></li>
            </ol>
        </div>

    </section>
    <!-- end slider section -->
</div>


<!-- service section -->

<section class="service_section layout_padding">
    <div class="service_container">
        <div class="container ">
            <div class="heading_container">
                <h2>
                    Our <span>Events</span>
                </h2>
                <p>
                    Explore a world where music, dance, and culture fuse together to create unforgettable experiences. Our events are crafted to bring people together and make every night a story worth telling.
                </p>
            </div>
            <div class="row">
                <div class="col-md-6 ">
                    <div class="box ">
                        <div class="img-box">
                            <img src="images/champagne.jpeg" alt="">
                        </div>
                        <div class="detail-box">
                            <h5>
                                Club Nights
                            </h5>
                            <p>
                                Experience the essence of nightlife with our selection of club nights. Each event is a journey into the heart of music and dance, offering a unique atmosphere and energy.
                            </p>
                            <a href="about.php">
                                Read More
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 ">
                    <div class="box ">
                        <div class="img-box">
                            <img src="images/concert.jpeg" alt="">
                        </div>
                        <div class="detail-box">
                            <h5>
                                Live Concerts
                            </h5>
                            <p>
                                From emerging talents to global icons, our live concerts span genres and styles, delivering powerful performances and unforgettable memories.
                            </p>
                            <a href="about.php">
                                Read More
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 ">
                    <div class="box ">
                        <div class="img-box">
                            <img src="images/dj.avif" alt="">
                        </div>
                        <div class="detail-box">
                            <h5>
                                DJ Sets & Electronic
                            </h5>
                            <p>
                                Get lost in the beats with DJ sets and electronic music events that showcase cutting-edge soundscapes and vibrant dance floors.
                            </p>
                            <a href="about.php">
                                Read More
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 ">
                    <div class="box ">
                        <div class="img-box">
                            <img src="images/party.jpeg" alt="">
                        </div>
                        <div the="detail-box">
                            <h5>
                                Exclusive Parties
                            </h5>
                            <p>
                                Dive into exclusive parties with curated themes, top-tier entertainment, and a guest list that guarantees an elite nightlife experience.
                            </p>
                            <a href="about.php">
                                Read More
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- end service section -->


<!-- about section -->

<section class="about_section layout_padding-bottom">
    <div class="container  ">
        <div class="row">
            <div class="col-md-6">
                <div class="detail-box">
                    <div class="heading_container">
                        <h2>
                            About <span>Us</span>
                        </h2>
                    </div>
                    <p>
                        At the core of the nightlife and concert scene, we stand as a beacon for those seeking the thrill of live music, dance, and social gatherings. Our passion for creating spaces where memories are made and shared drives us to deliver only the best events.
                    </p>
                    <a href="about.php">
                        Read More
                    </a>
                </div>
            </div>
            <div class="col-md-6 ">
                <div class="img-box">
                    <img src="images/nightlife.jpeg" alt="">
                </div>
            </div>

</section>
<!-- end about section -->

<!-- client section -->
<!--
<section class="client_section layout_padding">
    <div class="container">
        <div class="heading_container">
            <h2>
                What Our <span>Guests Say</span>
            </h2>
        </div>
        <div class="client_container">
            <div class="carousel-wrap ">
                <div class="owl-carousel">
                    <div class="item">
                        <div class="box">
                            <div class="detail-box">
                                <p>
                                    "The vibe at their events is unmatched! I've been to numerous club nights and concerts, and each time it's a unique experience. Great music, awesome crowd, and smooth organization. Can't wait for the next one!"
                                </p>
                            </div>
                            <div class="client_id">
                                <div class="img-box">
                                    <img src="images/client-1.png" alt="" class="img-1">
                                </div>
                                <div class="name">
                                    <h6>
                                        Jordan
                                    </h6>
                                    <p>
                                        Concert Enthusiast
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="box">
                            <div class="detail-box">
                                <p>
                                    "I booked a VIP table for my friend's bachelorette, and we were treated like royalty! The service was impeccable, and the DJ had us dancing all night. It was an unforgettable experience, highly recommended."
                                </p>
                            </div>
                            <div class="client_id">
                                <div class="img-box">
                                    <img src="images/client-2.png" alt="" class="img-1">
                                </div>
                                <div class="name">
                                    <h6>
                                        Mia
                                    </h6>
                                    <p>
                                        Party Planner
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="box">
                            <div class="detail-box">
                                <p>
                                    "As a touring DJ, playing at their venues has always been a highlight. The crowd is always energetic, and the staff makes sure everything goes smoothly. They truly know how to throw a party!"
                                </p>
                            </div>
                            <div class="client_id">
                                <div class="img-box">
                                    <img src="images/client-1.png" alt="" class="img-1">
                                </div>
                                <div class="name">
                                    <h6>
                                        DJ Alex
                                    </h6>
                                    <p>
                                        International DJ
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="box">
                            <div class="detail-box">
                                <p>
                                    "Their event management team helped us launch our album in a way we only dreamed of. The venue, the setup, the promotion – everything was spot on. They're the go-to for any artist looking to make an impact."
                                </p>
                            </div>
                            <div class="client_id">
                                <div class="img-box">
                                    <img src="images/client-2.png" alt="" class="img-1">
                                </div>
                                <div class="name">
                                    <h6>
                                        The Soundwaves
                                    </h6>
                                    <p>
                                        Indie Band
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
-->
<!-- end client section -->
<!-- contact section -->
<section class="contact_section">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4 col-md-5 offset-md-1">
                <div class="heading_container">
                    <h2>
                        Contact Us
                    </h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-5 offset-md-1">
                <div class="form_container contact-form">
                    <form action="">
                        <div>
                            <input type="text" placeholder="Your Name" />
                        </div>
                        <div>
                            <input type="text" placeholder="Phone Number" />
                        </div>
                        <div>
                            <input type="email" placeholder="Email" />
                        </div>
                        <div>
                            <input type="text" class="message-box" placeholder="Message" />
                        </div>
                        <div class="btn_box">
                            <button>
                                SEND
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- end contact section -->

<?php require "layout/footer.php" ?>