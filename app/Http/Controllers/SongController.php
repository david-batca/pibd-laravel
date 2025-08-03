<?php

namespace App\Http\Controllers;

use App\Models\Song;
use Illuminate\Http\Request;

class SongController extends Controller
{
  public function index()
  {
    $songs = Song::with('artists:id,name')->get()->map(function ($song) {
      return [
        'id' => $song->id,
        'name' => $song->name,
        'artists' => $song->artists->map(function ($artist) {
          return [
            'name' => $artist->name
          ];
        })
      ];
    });

    return view('songs', ['songs' => $songs]);
  }

  public function create() {}

  public function delete($id) {}
}
