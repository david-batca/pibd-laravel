@extends('layouts.app')

@section('content')
  <div class="flex items-center justify-between p-5 bg-slate-800 rounded-2xl mb-10">
    <h1 class="text-2xl">Melodii</h1>

    <x-song-create-form :artists="$artists" />
  </div>

  <div class="overflow-x-auto p-5 bg-slate-800 rounded-2xl mb-10">
    <table class="table">
      <thead>
        <tr>
          <th>Id</th>
          <th>Nume</th>
          <th>Artisti</th>
          <th></th>
        </tr>
      </thead>
      <tbody id="songs_table">
        @foreach ($songs as $song)
          @include('songs.partials._row', ['song' => $song])
        @endforeach
      </tbody>
    </table>
  </div>

  {{ $songs->links() }}
@endsection
