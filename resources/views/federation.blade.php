<x-app-layout>
    <section class="about-sec">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <img src="{{ $federation->getFirstMediaUrl('logo') }}" alt="{{ $federation->name }}" class="img-fluid">
                </div>
                <div class="col-lg-6" style="margin-top: 10rem">
                    <div class="about-txt">
                        <h2 class="sec-title line-left green">{{ $federation->name }}</h2>
                        <p>{{ $federation->description }}</p>
                        <div class="mt-6">
                            <p><strong>الهاتف:</strong> {{ $federation->phone }}</p>
                            <p><strong>البريد الإلكتروني:</strong> {{ $federation->email }}</p>
                            <p><strong>الموقع:</strong> <a href="{{ $federation->website }}">{{ $federation->website }}</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Clubs Section Start -->
    <section class="team-page sec-padding bg-light">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 mx-auto pb-4 mb-5">
                    <div class="sec-intro text-center">
                        <h2 class="sec-title text-info line text-black">أندية {{ $federation->name }}</h2>
                    </div>
                </div>
            </div>
            <div class="row g-5 justify-content-center d-flex">
                @foreach($clubs as $club)
                <div class="col-lg-4 col-sm-6 ">
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
</x-app-layout>
