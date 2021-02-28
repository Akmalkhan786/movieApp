<?php

namespace App\ViewModels;

use Carbon\Carbon;
use Spatie\ViewModels\ViewModel;

class MovieViewModel extends ViewModel
{
    public $movie;
    public function __construct($movie)
    {
        $this->movie = $movie;
    }

    public function movie()
    {
        if (isset($this->movie['runtime'])){
            $runtime = $this->movie['runtime'] / 60;
            $hour = floor($runtime);
            $minutesInDecimal = $runtime - $hour;
            $minutes = $minutesInDecimal * 60;
            $finalRuntime = $hour.'h '. $minutes.'m';
        } else {
            $finalRuntime = '0m';
        }
        return collect($this->movie)->merge([
            'poster_path' => $this->movie['poster_path'] ? 'https://image.tmdb.org/t/p/original'.$this->movie['poster_path'] : 'https://via.placeholder.com/384x576',
            'vote_average' => $this->movie['vote_average'] * 10 . '%',
            'release_date' => Carbon::parse($this->movie['release_date'])->format('M d, Y'),
            'movie_year' => Carbon::parse($this->movie['release_date'])->format('Y'),
            'genres' => collect($this->movie['genres'])->pluck('name')->flatten()->implode(', '),
            'crew' => collect($this->movie['credits']['crew'])->take(2),
            'production_companies' => collect($this->movie['production_companies'])->take(2),
            'cast' => collect($this->movie['credits']['cast'])->take(10),
            'runtime' => $finalRuntime,
        ]);
    }
}
