<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Streaming_Providers extends Model
{
    use HasFactory;

     /**
     * Attributes that are mass assignable
     * 
     * @var array
     */
    protected $fillable = ['user_id', 'Netflix', 'Amazon_Prime_Video', 'HBO', 'Disney_Plus'];

    protected $table = 'streaming_providers';

    /**
     * Get user
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
