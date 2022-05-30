<?php

namespace App\Repositories;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MoviesRepository
{
    /**
     * Get popular movies
     * 
     * @return Collection
     */
    public function getPopularMovies()
    {
        $popularMovies1 = Http::withToken(config('services.tmdb.token'))
            ->get('http://api.themoviedb.org/3/movie/popular')
            ->json();
        
        $popularMovies2 = Http::withToken(config('services.tmdb.token'))
        ->get('http://api.themoviedb.org/3/movie/popular?page=2')
        ->json();

        $popularMovies3 = Http::withToken(config('services.tmdb.token'))
        ->get('http://api.themoviedb.org/3/movie/popular?page=3')
        ->json();

        $popularMovies4 = Http::withToken(config('services.tmdb.token'))
        ->get('http://api.themoviedb.org/3/movie/popular?page=4')
        ->json();

        $popularMovies['page1'] = $popularMovies1['results'];
        $popularMovies['page2'] = $popularMovies2['results'];
        $popularMovies['page3'] = $popularMovies3['results'];
        $popularMovies['page4'] = $popularMovies4['results'];

        return $popularMovies;
    }

    /**
     * Get the streaming provider of the movie
     * 
     * @param integer $movieId
     * @return Colletion
     */
    public function streamingProvider($movieId)
    {
        $streamingProvider = Http::withToken(config('services.tmdb.token'))
            ->get('http://api.themoviedb.org/3/movie/' . $movieId . '/watch/providers')
            ->json();
        
        return $streamingProvider;
    }

    /**
     * Get movie Details
     * 
     * @param interger $movieId
     * @return Collection
     */
    public function getMovieDetails($movieId)
    {
        $movieDetails = Http::withToken(config('services.tmdb.token'))
            ->get('http://api.themoviedb.org/3/movie/' . $movieId)
            ->json();
        
        return $movieDetails;
    }

    /**
     * Get top rated movies
     * 
     * @return Collection
     */
    public function getTopRatedMovies()
    {
        $topRatedMovies1 = Http::withToken(config('services.tmdb.token'))
        ->get('http://api.themoviedb.org/3/movie/top_rated?page=1')
        ->json();

        $topRatedMovies2 = Http::withToken(config('services.tmdb.token'))
        ->get('http://api.themoviedb.org/3/movie/top_rated?page=2')
        ->json();

        $topRatedMovies3 = Http::withToken(config('services.tmdb.token'))
        ->get('http://api.themoviedb.org/3/movie/top_rated?page3')
        ->json();

        $topRatedMovies4 = Http::withToken(config('services.tmdb.token'))
        ->get('http://api.themoviedb.org/3/movie/top_rated?page=4')
        ->json();

        $topRatedMovies = [
            'page1' => $topRatedMovies1['results'],
            'page2' => $topRatedMovies2['results'],
            'page3' => $topRatedMovies3['results'],
            'page4' => $topRatedMovies4['results'],
        ];
        
        return $topRatedMovies;
    }

    /**
     * Search for a movie
     */
    public function search()
    {
        $results = Http::withToken(config('services.tmdb.token'))
        ->get('http://api.themoviedb.org/3/search/movie')
        ->json();

       
    }

    /** get user streaming providers */
    public function userStreamingProviders($data) {
        $userStreamingProviders = [];

        foreach ($data as $userStreamingProvider => $value) {
            if ($value === 1) {
                if ($userStreamingProvider === 'Amazon_Prime_Video') {
                    $userStreamingProviders[] = 'Amazon Prime Video';
                } else if ($userStreamingProvider == 'Disney_Plus') {
                    $userStreamingProviders[] = 'Disney Plus';
                } else {
                    $userStreamingProviders[] = $userStreamingProvider;
                }
            }
        }
       
        return $userStreamingProviders;
    }


}
