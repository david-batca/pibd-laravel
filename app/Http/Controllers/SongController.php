<?php

namespace App\Http\Controllers;

use App\Models\Artist;
use App\Models\Song;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SongController extends Controller
{
  public function index()
  {
    $songs = Song::with('artists:id,name')->paginate(5);

    $transformed = $songs->getCollection()->map(function ($song) {
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

    $songs->setCollection($transformed);

    $artists = Artist::all(['id', 'name']);

    return view('songs.index', ['songs' => $songs, 'artists' => $artists]);
  }

  public function create(Request $request)
  {
    $data = $request->validate([
      'name' => 'required|string|max:255'
    ]);

    $song = Song::create([
      'name' => $data['name']
    ]);

    return redirect()->route('songs.index', $request->query());
  }

  public function delete($id, Request $request)
  {
    $song = Song::findOrFail($id);

    $song->delete();

    return redirect()->route('songs.index', $request->query());
  }

  public function update($id, Request $request)
  {
    $data = $request->validate([
      'name' => 'required|string|max:255'
    ]);

    $song = Song::findOrFail($id);
    $song->update(['name' => $data['name']]);

    return response()->json([
      'id' => $song->id,
      'name' => $song->name
    ], 200);
  }
}
