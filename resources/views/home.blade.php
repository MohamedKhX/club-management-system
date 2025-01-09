<x-app-layout>

    <!-- Header Section End -->
    <section class="cricket-banner bg-dark position-relative">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 mx-auto">
                    <div class="banner-txt text-center jarallax">
                        <p class="lead text-gr">Transfer Arena</p>
                        <h3 style="margin-top: 1.5rem" class="text-info text-uppercase"> منصة المواطن لمتابعة أخبار الرياضة</h3>
                        <p style="line-height: 2.0; margin-top: 1rem; font-size: 26px">
                            مرحبًا بكم في منصة TransferArena، وجهتكم الأولى لمتابعة أخبار الرياضة المحلية والتفاعل مع الأندية والاتحادات الرياضية. تتيح لكم المنصة التعرف على تفاصيل الأندية، متابعة اللاعبين، والاطلاع على أحدث الانتقالات الرياضية. نحن هنا لنقربكم من عالم الرياضة بأسلوب جديد ومميز.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Header Section End -->

    <!-- Banner Gallery Start -->
    <div class="banner-gallery">
        <div class="container-fluid">
            <div class="row g-3 gallery-wrap">
                <div class="col">
                    <a class="my-image-links" data-gall="gallery01" href="images/main/third.jpg">
                        <img class="img-fluid" src="images/main/third.jpg" alt="Cricket">
                    </a>
                </div>
                <div class="col">
                    <a class="my-image-links" data-gall="gallery01" href="images/main/second.jpg">
                        <img class="img-fluid" src="images/main/second.jpg" alt="Cricket">
                    </a>
                </div>
                <div class="col">
                    <a class="my-image-links" data-gall="gallery01" href="images/main/first.webp">
                        <img class="img-fluid" src="images/main/first.webp" alt="Cricket">
                    </a>
                </div>
                <div class="col">
                    <a class="my-image-links" data-gall="gallery01" href="images/main/forth.jpg">
                        <img class="img-fluid" src="images/main/forth.jpg" alt="Cricket">
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- Banner Gallery End -->

    <!-- About Section Start -->
    <section class="about-sec">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 order-2 order-lg-1">
                    <div class="about-txt">
                        <p class="lead text-success">تعرف علينا</p>
                        <h2 class="sec-title line-left green">الرياضة تجمعنا وتلهمنا نحو مستقبل أفضل</h2>
                        <p>في منصة TransferArena، نقدم للمواطنين تجربة رياضية فريدة تتيح لهم متابعة أخبار الأندية والاتحادات الرياضية بكل شفافية وسهولة. رؤيتنا هي تعزيز التفاعل بين عشاق الرياضة والمجتمع الرياضي المحلي.</p>
                        <ul class="my-5">
                            <li>الرياضة توحدنا وتلهمنا لتحقيق الأفضل</li>
                            <li>معرفة الرياضة حق للجميع</li>
                            <li>إبقَ على اطلاع دائم على أحدث أخبار الرياضة</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6 ps-lg-5 order-1 order-lg-2 mb-5 mb-lg-0 col-sm-10">
                    <div class="about-img position-relative text-center">
                        <img class="img-fluid" src="images/batter.jpg" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- About Section End -->

    <!-- SportFederation Section Start -->
    <section class="match-schedule sec-padding bg-success">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 mx-auto pb-4 mb-5">
                    <div class="sec-intro text-center">
                        <h2 class="sec-title text-info line">الاتحادات الرياضية</h2>
                    </div>
                </div>
            </div>
            <div class="row" style="height: 100%;">
                <div class="col-lg-12" style="height: 100%;">
                    <div class="match-carousel swiper" style="height: 100%;">
                        <div class="swiper-wrapper d-flex flex-grow-1" style="display: flex; height: 100%; align-items: stretch;">
                            @foreach($federations as $federation)
                                <div class="swiper-slide" style="display: flex; align-items: stretch; height: 380px; border-radius: 6rem !important;">
                                    <div class="single-match bg-info text-center" style="display: flex; flex-direction: column; flex-grow: 1; width: 100%;">
                                        <div class="d-flex justify-content-around px-4 mb-4">
                                            <a href="{{ route('federation.show', $federation) }}">
                                                <img width="100" src="{{ $federation->getFirstMediaUrl('logo') }}" alt="{{ $federation->name }}">
                                            </a>
                                        </div>
                                        <h3 class="text-uppercase mt-1 mb-3">
                                            <a href="{{ route('federation.show', $federation) }}">{{ $federation->name }}</a>
                                        </h3>
                                        <p>{{ Str::limit($federation->description, 100) }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="swiper-pagination text-center"></div>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <!-- SportFederation Section End -->

    <!-- Clubs Section Start -->
    <section class="team-page sec-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 mx-auto pb-4 mb-5">
                    <div class="sec-intro text-center">
                        <h2 class="sec-title text-black text-info line">الأندية</h2>
                    </div>
                </div>
            </div>
            <div class="row g-5 flex justify-content-center">
                @foreach($clubs as $club)
                <div class="col-lg-4 col-sm-6">
                    <div class="team-member text-center">
                        <div class="team-img mb-4">
                            <a href="{{ route('club.show', $club) }}">
                                <img class="img-fluid" src="{{ $club->getFirstMediaUrl('logo') }}" alt="{{ $club->name }}">
                            </a>
                        </div>
                        <h3 class="text-uppercase mb-0">
                            <a href="{{ route('club.show', $club) }}">{{ $club->name }}</a>
                        </h3>
                        <p>{{ Str::limit($club->description, 100) }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- Clubs Section End -->

    <!-- Text Slide Section Start -->
    <div class="text-slide cricket-text overflow-hidden">
        <div class="slide-bar green-slide position-relative">
            <div class="box d-flex">
                <div class="box-item">
                    <span><img src="images/tennis.png" alt="Star"></span>
                    <span>Transfer Arena</span>
                </div>
                <div class="box-item">
                    <span><img src="images/tennis.png" alt="Star"></span>
                    <span>Transfer Arena</span>
                </div>
                <div class="box-item">
                    <span><img src="images/tennis.png" alt="Star"></span>
                    <span>Transfer Arena</span>
                </div>
                <div class="box-item">
                    <span><img src="images/tennis.png" alt="Star"></span>
                    <span>Transfer Arena</span>
                </div>
            </div>
        </div>
        <div class="slide-bar green-slide reverse position-relative">
            <div class="box d-flex">
                <div class="box-item">
                    <span><img src="images/tennis.png" alt="Star"></span>
                    <span>Transfer Arena</span>
                </div>
                <div class="box-item">
                    <span><img src="images/tennis.png" alt="Star"></span>
                    <span>Transfer Arena</span>
                </div>
                <div class="box-item">
                    <span><img src="images/tennis.png" alt="Star"></span>
                    <span>Transfer Arena</span>
                </div>
                <div class="box-item">
                    <span><img src="images/tennis.png" alt="Star"></span>
                    <span>Stay At The Winning Side</span>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
