<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Movie_List;
use App\Models\ListofMovies;
use App\Models\Streaming_Providers;
use App\Repositories\Dictionaries\StreamingProviders;
use App\Repositories\MoviesRepository;

class UserController extends Controller
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
        $this->moviesRepository = $moviesRepository;

    }

    /**
     * Show user details
     * 
     */
    public function show()
    {
        $user = $this->userData();
        $id = $user['id'];

        $user = User::find($id);
        $lists = ListofMovies::get()->where('user_id', $id);
        foreach ($lists as $list) {
            $list['movies'] = count(Movie_List::where('list_id', $list->id)->get());
            if ($list['movies'] === 0) {
                $list['movies'] = 'Empty list';
            }
        }
        $data = Streaming_Providers::where('user_id', $user->id)->get()->first()->toArray();
        $userStreamingProviders = $this->moviesRepository->userStreamingProviders($data);
        
        return view('userProfile', compact('user', 'lists', 'userStreamingProviders'));
    }

    /**
     * Edit users Data
     * 
     */
    public function edit()
    {
        $user = $this->userData();
        $countriesList = config('Countries');
        $streamingProviders = StreamingProviders::$map;
        $data = Streaming_Providers::where('user_id', $user->id)->get()->first()->toArray();
     
        $userStreamingProviders = [
            'Netflix' => $data['Netflix'],
            'Amazon_Prime_Video' => $data['Amazon_Prime_Video'],
            'Disney_Plus' => $data['Disney_Plus'],
            'HBO' => $data['HBO'],
        ];

        return view('/editProfile', compact('user', 'countriesList', 'streamingProviders', 'userStreamingProviders'));
    }

    /**
     * Update user data
     * 
     */
    public function update(Request $request)
    {
        $data = $request->all();
        $user = $this->userData();
        
        $user->name = $data['userName'];
        $user->country = $data['countries-list'];
        $user->save();

        $providers = Streaming_Providers::where('user_id', $user->id)->first();
       
        if (!$providers) {
            $providers = new Streaming_Providers();
            $providers->user_id = $user->id;
            $providers->Netflix = $request->has('Netflix');
            $providers->Amazon_Prime_Video = $request->has('Amazon_Prime_Video');
            $providers->Disney_Plus = $request->has('Disney_Plus');
            $providers->HBO = $request->has('HBO');
            $providers->save();
        } else {
            $provider = Streaming_Providers::find($providers->id);
            $provider->user_id = $user->id;
            $provider->Netflix = $request->has('Netflix');
            $provider->Amazon_Prime_Video = $request->has('Amazon_Prime_Video');
            $provider->Disney_Plus = $request->has('Disney_Plus');
            $provider->HBO = $request->has('HBO');
            $provider->update();
        }

        return redirect()->route('user.show');
    }

    /**
     * Get user data
     * 
     * @return User
     */
    protected function userData()
    {
        $userData = auth()->user();
        $id = $userData['id'];
        $user = User::find($id);
      
        return $user;
    }
}
