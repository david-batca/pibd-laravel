<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Song extends Model
{
  protected $fillable = [
    'name',
  ];

  public function artists()
  {
    return $this->belongsToMany(Artist::class, 'song_artists', 'song_id', 'artist_id');
  }
}
