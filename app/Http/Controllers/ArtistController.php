<?php

namespace App\Http\Controllers;

use App\Models\Artist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ArtistController extends Controller
{
  public function index()
  {
    $artists = Artist::with('songs:id,name')->paginate(20);

    $transformed = $artists->getCollection()->map(function ($artist) {
      return [
        'id' => $artist->id,
        'name' => $artist->name,
        'songs' => $artist->songs->map(function ($song) {
          return [
            'name' => $song->name
          ];
        })
      ];
    });

    $artists->setCollection($transformed);

    return view('artists.index', ['artists' => $artists]);
  }

  public function create(Request $request)
  {
    $data = $request->validate([
      'name' => 'required|string|max:255'
    ]);

    $artist = Artist::create([
      'name' => $data['name']
    ]);

    $rowHtml = view('artists.partials._row', [
      'artist' => $artist,
      'index' => Artist::count()
    ])->render();

    return response()->json([
      'id' => $artist->id,
      'html' => $rowHtml
    ], 201);
  }

  public function delete($id)
  {
    $artist = Artist::findOrFail($id);

    $artist->delete();

    return response()->json(['stattus' => 'success'], 200);
  }

  public function find($id)
  {
    $artist = Artist::findOrFail($id);

    return response()->json([
      'id' => $artist->id,
      'name' => $artist->name
    ]);
  }

  public function update($id, Request $request)
  {
    Log::info($request);
    $data = $request->validate([
      'name' => 'required|string|max:255'
    ]);

    $artist = Artist::findOrFail($id);
    $artist->update(['name' => $data['name']]);

    return response()->json([
      'id' => $artist->id,
      'name' => $artist->name
    ], 200);
  }
}
