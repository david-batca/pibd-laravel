<?php

namespace App\Http\Controllers;

use App\Models\Artist;
use App\Models\Song;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ArtistController extends Controller
{
  public function index()
  {
    $artists = Artist::with('songs:id,name')->paginate(10);

    $transformed = $artists->getCollection()->map(function ($artist) {
      return [
        'id' => $artist->id,
        'name' => $artist->name,
        'songs' => $artist->songs->map(function ($song) {
          return [
            'id' => $song->id,
            'name' => $song->name
          ];
        })
      ];
    });

    $artists->setCollection($transformed);

    $songs = Song::all(['id', 'name']);

    return view('artists.index', ['artists' => $artists, 'songs' => $songs]);
  }

  public function create(Request $request)
  {
    $data = $request->validate([
      'name' => 'required|string|max:255'
    ]);

    $artist = Artist::create([
      'name' => $data['name']
    ]);

    $artist->songs()->sync($request->song_ids);

    return redirect()->route('artists.index')->with('success', 'Artistul a fost adaugat cu succes');
  }

  public function delete($id, Request $request)
  {
    $artist = Artist::findOrFail($id);

    $artist->delete();

    return redirect()->route('artists.index')->with('success', 'Artistul a fost sters cu succes');
  }

  public function update($id, Request $request)
  {
    Log::info($request);
    $data = $request->validate([
      'name' => 'required|string|max:255'
    ]);

    $artist = Artist::findOrFail($id);
    $artist->update(['name' => $data['name']]);
    $artist->songs()->sync($request->song_ids);

    return redirect()->route('artists.index')->with('success', 'Artistul a fost actualizat cu succes');
  }
}
