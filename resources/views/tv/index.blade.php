@extends('layouts.main')

@section('content')
    <div class="container mx-auto px-4 pt-16">
        <!-- Popular shows Start -->
        <div class="popular-tv">
            <h2 class="uppercase tracking-wider text-yellow-600 text-lg font-semibold">Popular Shows</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-5">
                @foreach($popularTv as $tv)
                    <x-tv-card :tv="$tv"/>
                @endforeach
            </div>
        </div>
        <!-- Popular shows End -->
        <!-- top rated shows start -->
        <div class="now-playing-movies py-24">
            <h2 class="uppercase tracking-wider text-yellow-600 text-lg font-semibold">Top Rated Shows</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-5">
                @foreach($topRatedTv as $tv)
                    <x-tv-card :tv="$tv"/>
                @endforeach
            </div>
        </div>
        <!-- top rated shows end -->
    </div>
@endsection
