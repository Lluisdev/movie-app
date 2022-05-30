<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use App\Repositories\MoviesRepository;
use App\Repositories\Dictionaries\StreamingProviders;
use App\Models\User;
use App\Models\Streaming_Providers;

class HomeController extends Controller
{
    /**
     * Movie Repository instance
     * 
     * @var MoviesRepository
     */
    protected $moviesRepository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(MoviesRepository $moviesRepository)
    {
        $this->middleware('auth');
        $this->moviesRepository = $moviesRepository;

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request, MoviesRepository $moviesRepository, User $user)
    {
        $user = auth()->user();
        $country = $user['country'];
        $countriesList = config('Countries');

        $data = Streaming_Providers::where('user_id', $user->id)->get()->first()->toArray();
        $userStreamingProviders = $this->moviesRepository->userStreamingProviders($data);

        if (!empty($country)) {
            $countryCode = array_search($country, $countriesList);
        } else {
            $countryCode = 'US';
            $country = 'United States';
        }
        
        $streamingProviders = StreamingProviders::$map;
        $popularMoviesPages = $this->moviesRepository->getPopularMovies();
    
       foreach ($popularMoviesPages as $popularMovies) {
            foreach($popularMovies as $key => $popularMovie) {
                $movieId = $popularMovie['id'];
                $streamingProvider = $this->moviesRepository->streamingProvider($movieId);
                if (array_key_exists($countryCode, $streamingProvider['results'])) {
                    if (array_key_exists("flatrate_and_buy", $streamingProvider['results'][ $countryCode])) {
                        $popularMovies[$key]['streamingProvider'] = $streamingProvider['results'][ $countryCode]['flatrate_and_buy'][0]['provider_name'];
                    } elseif (array_key_exists("flatrate", $streamingProvider['results'][ $countryCode])) {
                        $popularMovies[$key]['streamingProvider'] = $streamingProvider['results'][ $countryCode]['flatrate'][0]['provider_name'];
                    } else {
                        $popularMovies[$key]['streamingProvider'] = "Buy on: " . $streamingProvider['results'][ $countryCode]['buy'][0]['provider_name'];
                    }
                } else {
                    $popularMovies[$key]['streamingProvider'] = "Not Available in you Country";
                }
            }
        }
        //dd($popularMovies);

        $topRatedMoviesPages = $this->moviesRepository->getTopRatedMovies();

        foreach ($topRatedMoviesPages as $topRatedMovies) {
            foreach($topRatedMovies as $key => $topRatedMovie) {
                $movieId = $topRatedMovie['id'];
                $streamingProvider = $this->moviesRepository->streamingProvider($movieId);
                if (array_key_exists($countryCode, $streamingProvider['results'])) {
                    if (array_key_exists("flatrate_and_buy", $streamingProvider['results'][$countryCode])) {
                        $topRatedMovies[$key]['streamingProvider'] = $streamingProvider['results'][$countryCode]['flatrate_and_buy'][0]['provider_name'];
                    } elseif (array_key_exists("flatrate", $streamingProvider['results'][$countryCode])) {
                        $topRatedMovies[$key]['streamingProvider'] = $streamingProvider['results'][$countryCode]['flatrate'][0]['provider_name'];
                    } else {
                        $topRatedMovies[$key]['streamingProvider'] = "Buy on: " . $streamingProvider['results'][$countryCode]['buy'][0]['provider_name'];
                    }
                } else {
                    $topRatedMovies[$key]['streamingProvider'] = "Not Available in you Country";
                }
            }
           
        }
        
        return view('home', compact(
            'streamingProviders',
            'countriesList',
            'popularMoviesPages',
            'topRatedMoviesPages',
            'country',
            'userStreamingProviders'
        ));
    }

    /**
     * Get all movie details
     * 
     * @param $movieId
     * @return array
     */
    public function getMovieDetails($movieId)
    {
        $movieDetails = $this->moviesRepository->getMovieDetails($movieId);
        
    }

    /**
     * Get data from Form
     * 
     * @param User $user
     * @param Request $request
     * 
     */
    public function sendRequest(Request $request, User $user)
    {
        $validated = $request->validate([
            'countries-list' => 'required',
        ]);

        $country = $request->input('countries-list');

        $user = auth()->user();;
        $user->country = $country;
        $user->save();
        
        

        return redirect()->route('home');
    }

    /**
     * search a movie in API
     */
    public function searchMovie()
    {
        
    }

}
