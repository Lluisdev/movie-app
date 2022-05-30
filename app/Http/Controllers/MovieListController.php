<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie_List;
use App\Models\ListofMovies;
use App\Models\Movie;
use App\Repositories\MoviesRepository;

class MovieListController extends Controller
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
     * Get all movie lists from user
     */
    public function show()
    {
        $user = auth()->user();
        $id = $user['id'];
        
        $lists = ListofMovies::get()->where('user_id', $id);

        return view('userProfile', compact('lists'));
    }

    /**
     * Create a movie list
     */
    public function create()
    {
        return view('movieList.create-form');
    }

    /**
     * Save movie list
     */
    public function save(Request $request, ListofMovies $list)
    {
        $data = $request->all();
        /**@var ListofMovies $list */
        $user = auth()->user();
        $id = $user['id'];
        $list = new ListofMovies();
        $list->name = $data['listName'];
        $list->user_id = $id;

    
        $list->save();

        return redirect()->route('user.show');
    }

    /**
     * Show List details
     */
    public function detailsList($id)
    {
        $listOfMovies = Movie_List::where('list_id', $id)->get();
        $list = ListofMovies::find($id);
        $movies = [];
        
        foreach ($listOfMovies as $movie) {
            $movieDetails = $this->moviesRepository->getMovieDetails($movie['movie_id']);
            $movies[] = $movieDetails;
        }

        return view('movieList.details-form', compact('list', 'movies'));
    }

    /**
     * Show form to add movie to list
     */
    public function addMovie($id)
    {
        $user = auth()->user();
        $movie = $this->moviesRepository->getMovieDetails($id);
        $lists = ListofMovies::get()->where('user_id', $user['id']);
        
        return view('movieList.addMovie-form', compact('user', 'lists', 'movie'));
    }

    /**
     * Save movie into list
     */
    public function addMovieToList($id, Request $request, Movie_List $list, Movie $movie)
    {
        $data = $request->all();
        $movie_id = $id;
        $user = auth()->user();

        $movieDetails = $this->moviesRepository->getMovieDetails($id);

        $movieLists = ListofMovies::where('user_id', $user['id'])->where('name', $data['listName'])->get();
        foreach ($movieLists as $movieList) {
            $listId = $movieList['id'];
        }

        $list = new Movie_List();
        $list->list_id = $listId;
        $list->movie_id = $id;
        $list->user_id = $user['id'];
        $list->save();
        

        $movie = new Movie();
        $movie->id = $id;
        $movie->title = $movieDetails['original_title'];
        $movie->list_id = $listId;
       
        $movie->save();

        return redirect()->route('user.show');
    }

    /**
     * Delete movie from list
     */
    public function deleteMovie($listId, $movieId)
    {
        $movieList = Movie_list::where('list_id', $listId)->where('movie_id', $movieId)->get();
        foreach ($movieList as $list) {
            $list->delete();
        }
        $movie = Movie::find($movieId);
        $movie->delete();

        return redirect()->route('user.show');
    }

    public function deleteList($id)
    {
        $movies = Movie::where('list_id', $id)->get();
        foreach ($movies as $movie) {
            $movie->delete();
        }

        $lists = Movie_List::where('list_id', $id)->get();
        foreach ($lists as $list) {
            $list->delete();
        }

        $listOfMovies = ListofMovies::find($id);
        $listOfMovies->delete();

        return redirect()->route('user.show');
    }
}
