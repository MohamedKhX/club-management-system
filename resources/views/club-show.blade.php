<x-app-layout>
    <section class="about-sec">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <img src="{{ $club->getFirstMediaUrl('logo') }}" alt="{{ $club->name }}" class="img-fluid">
                </div>
                <div class="col-lg-6" style="margin-top: 10rem">
                    <div class="about-txt">
                        <h2 class="sec-title line-left green">{{ $club->name }}</h2>
                        <p>{{ $club->description }}</p>
                        <div class="mt-4">
                            <p><strong>الموقع:</strong> {{ $club->location }}</p>
                            <p><strong>تاريخ التأسيس:</strong> {{ $club->founded_date }}</p>
                            <p><strong>الهاتف:</strong> {{ $club->phone }}</p>
                            <p><strong>البريد الإلكتروني:</strong> {{ $club->email }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Active Players Section -->
    <section class="team-page sec-padding bg-light">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 mx-auto pb-4 mb-5">
                    <div class="sec-intro text-center">
                        <h2 class="sec-title text-info line text-black">اللاعبون النشطون</h2>
                    </div>
                </div>
            </div>
            <div class="row g-5 d-flex justify-content-center">
                @foreach($players as $player)
                <div class="col-lg-3 col-sm-6">
                    <div class="team-member text-center">
                        <div class="team-img mb-4">
                            <img class="img-fluid rounded-circle text-black" src="{{ $player->getFirstMediaUrl('avatar') }}" alt="{{ $player->name }}">
                        </div>
                        <h3 class="text-uppercase mb-0 text-black">{{ $player->name }}</h3>
                        <p>{{ $player->position }}</p>
                        <p class="text-muted">{{ $player->nationality }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
</x-app-layout>
