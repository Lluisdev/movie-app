<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\NullableFields;


/**
 * Class Movie List
 * 
 * @property int $id
 * @property string $name
 * @property int $user_id
 * @property array $movies
 */
class Movie_List extends Model
{
    use HasFactory;

    /**
     * Attributes that are mass assignable
     * 
     * @var array
     */
    //protected $fillable = ['name'];

    protected $table = 'lists_movies';

    /**
     * Get Movie List owner
     */
     public function user() {

        return $this->belongsTo(User::class);
    }

    public function movie()
    {
        return $this->belongsToMany(Movie::class, 'lists_movies', 'list_id', 'movie_id');
    }

}
