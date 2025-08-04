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
    $songs = Song::with('artists:id,name')->paginate(20);

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
    Log::info($request);
    $data = $request->validate([
      'name' => 'required|string|max:255'
    ]);

    $song = Song::create([
      'name' => $data['name']
    ]);

    $rowHtml = view('songs.partials._row', [
      'song' => $song,
      'index' => Song::count()
    ])->render();

    return response()->json([
      'id' => $song->id,
      'html' => $rowHtml
    ], 201);
  }

  public function delete($id)
  {
    $song = Song::findOrFail($id);

    $song->delete();

    return response()->json(['status' => 'success'], 200);
  }

  public function find($id)
  {
    $song = Song::findOrFail($id);

    return response()->json([
      'id' => $song->id,
      'name' => $song->name
    ]);
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
