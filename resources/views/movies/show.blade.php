@extends('layouts.main')

@section('content')
    <!-- Movie Info start -->
    <div class="movie-info border-b border-gray-800">
        <div class="container mx-auto px-4 py-16 flex flex-col md:flex-row">
            <div class="flex-none">
                <img src="{{ $movie['poster_path'] }}" alt="{{ $movie['title'] }}" class="w-64 lg:w-96">
            </div>
            <div class="md:ml-24">
                <h2 class="text-4xl mt-4 mb-2 md:mt-0 font-semibold">{{ $movie['title'] }} <span class="ml-2">({{ $movie['movie_year'] }})</span></h2>
                <div class="flex flex-wrap items-center text-gray-400 text-sm">
                    <svg class="fill-current text-yellow-500 w-4" viewBox="0 0 24 24">
                        <g data-name="Layer 2">
                            <path d="M17.56 21a1 1 0 01-.46-.11L12 18.22l-5.1 2.67a1 1 0 01-1.45-1.06l1-5.63-4.12-4a1 1 0 01-.25-1 1 1 0 01.81-.68l5.7-.83 2.51-5.13a1 1 0 011.8 0l2.54 5.12 5.7.83a1 1 0 01.81.68 1 1 0 01-.25 1l-4.12 4 1 5.63a1 1 0 01-.4 1 1 1 0 01-.62.18z" data-name="star"/>
                        </g>
                    </svg>
                    <span class="ml-1">{{ $movie['vote_average'] }}</span>
                    <span class="mx-2">|</span>
                    <span>{{ $movie['release_date'] }}</span>
                    <span class="mx-2">|</span>
                    <span>{{ $movie['genres'] }}</span>
                    <span class="mx-2">|</span>
                    <svg class="fill-current text-yellow-500 w-4" viewBox="0 0 16 16">
                        <path d="M8.5 5.6a.5.5 0 1 0-1 0v2.9h-3a.5.5 0 0 0 0 1H8a.5.5 0 0 0 .5-.5V5.6z"/>
                        <path d="M6.5 1A.5.5 0 0 1 7 .5h2a.5.5 0 0 1 0 1v.57c1.36.196 2.594.78 3.584 1.64a.715.715 0 0 1 .012-.013l.354-.354-.354-.353a.5.5 0 0 1 .707-.708l1.414 1.415a.5.5 0 1 1-.707.707l-.353-.354-.354.354a.512.512 0 0 1-.013.012A7 7 0 1 1 7 2.071V1.5a.5.5 0 0 1-.5-.5zM8 3a6 6 0 1 0 .001 12A6 6 0 0 0 8 3z"/>
                    </svg>
                    <span class="ml-1">{{ $movie['runtime'] }}</span>
                </div>
                <p class="text-gray-300 mt-8">
                    {{ $movie['overview'] }}
                </p>
                <div class="mt-12">
                    <h4 class="text-white font-semibold">Featured Crew</h4>
                    <div class="flex mt-4">
                        @foreach($movie['crew'] as $crew)
                            <div class="mr-8">
                                <div>{{ $crew['name'] }}</div>
                                <div class="text-sm text-gray-400">{{ $crew['job'] }}</div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="mt-4">
                    <h4 class="text-white font-semibold">Production Companies</h4>
                    <div class="flex mt-2">
                        @foreach($movie['production_companies'] as $pCompany)
                            <div class="mr-8">
                                <div>{{ $pCompany['name'] }}</div>
                                <div class="text-sm text-gray-400">{{ $pCompany['origin_country'] }}</div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div x-data="{ isOpen: false }">
                    @if(count($movie['videos']['results']) > 0)
                        <div class="mt-12">
                            <button href="https://www.youtube.com/watch?v={{ $movie['videos']['results'][0]['key'] }}"
                                    class="flex inline-flex items-center bg-yellow-500 text-gray-900 rounded font-semibold px-5 py-4 hover:bg-yellow-600 transition ease-in-out duration-150"
                                    @click="isOpen = true"
                            >
                                <svg class="w-6 fill-current" viewBox="0 0 24 24">
                                    <path d="M0 0h24v24H0z" fill="none"/>
                                    <path d="M10 16.5l6-4.5-6-4.5v9zM12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z"/>
                                </svg>
                                <span class="ml-2">Play Trailer</span>
                            </button>
                        </div>
                        <template x-if="isOpen">
                            <div style="background-color: rgba(0, 0, 0, .5);"
                                 class="fixed top-0 left-0 w-full h-full flex items-center shadow-lg overflow-y-hidden"
                                 x-show.transition.opacity="isOpen"
                            >
                                <div class="container mx-auto lg:px-32 rounded-lg overflow-y-auto">
                                    <div class="bg-gray-900 rounded">
                                        <div class="flex justify-end pr-4 pt-2">
                                            <button @click="isOpen = false"
                                                    @keydown.escape.window="isOpen = false"
                                                    class="text-3xl leading-none hover:text-gray-300"
                                            >&times;</button>
                                        </div>
                                        <div class="modal-body px-8 py-8">
                                            <div class="responsive-container overflow-hidden relative" style="padding-top: 56.25%">
                                                <iframe class="responsive-iframe absolute top-0 left-0 w-full h-full"
                                                        width="560" height="315"
                                                        src="https://www.youtube.com/embed/{{ $movie['videos']['results'][0]['key'] }}" style="border:0;"
                                                        allow="autoplay; encrypted-media" allowfullscreen>
                                                </iframe>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </template>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!-- Movie Info end -->
    <!-- Movie cast start -->
    <div class="movie-cast border-b border-gray-800">
        <div class="container mx-auto px-4 py-16">
            <h2 class="text-4xl font-semibold">Cast</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
                @foreach($movie['cast'] as $cast)
                    <div class="mt-8">
                        <a href="{{ route('actors.show', $cast['id']) }}">
                            @if($cast['profile_path'])
                                <img src="{{ 'https://image.tmdb.org/t/p/w300'.$cast['profile_path'] }}" alt="{{ $cast['name'] }}" class="hover:opacity-75 transition ease-in-out duration-150">
                            @else
                                <img src="{{ asset('/img/rsz_avatar.jpg') }}" alt="{{ $cast['name'] }}" class="hover:opacity-75 transition ease-in-out duration-150">
                            @endif
                        </a>
                        <div class="mt-2">
                            <a href="{{ route('actors.show', $cast['id']) }}" class="text-lg mt-2 hover:text-gray-300">{{ $cast['name'] }}</a>
                            <div class="text-gray-400 text-sm">
                                {{ $cast['character'] }}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Movie cast end -->
    <!-- Movie images start -->
    <div class="movie-images" x-data="{ isOpen: false, image: '' }">
        <div class="container mx-auto px-4 py-16">
            <h2 class="text-4xl font-semibold">Movie Images</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-5">
                @foreach($movie['images']['backdrops'] as $image)
                    <div class="mt-8">
                        <a href="#"
                           @click.prevent="
                           isOpen = true
                           image = '{{ 'https://image.tmdb.org/t/p/original'.$image['file_path'] }}'
                          "
                        >
                            <img src="{{ 'https://image.tmdb.org/t/p/w300'.$image['file_path'] }}" alt="" class="hover:opacity-75 transition ease-in-out duration-150">
                        </a>
                    </div>
                @endforeach
            </div>
            <div style="background-color: rgba(0, 0, 0, .5);"
                 class="fixed top-0 left-0 w-full h-full flex items-center shadow-lg overflow-y-hidden"
                 x-show.transition.opacity="isOpen"
            >
                <div class="container mx-auto lg:px-32 rounded-lg overflow-y-auto">
                    <div class="bg-gray-900 rounded">
                        <div class="flex justify-end pr-4 pt-2">
                            <button @click="isOpen = false"
                                    @keydown.escape.window="isOpen = false"
                                    class="text-3xl leading-none hover:text-gray-300"
                            >&times;</button>
                        </div>
                        <div class="modal-body px-8 py-8">
                            <img :src="image" alt="poster">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Movie images end -->
@endsection
