<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
      'user_id',
      'description',
      'resolution',
      'image',

    

  ];

    /**
      * Get the user record associated with the image.
      */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
