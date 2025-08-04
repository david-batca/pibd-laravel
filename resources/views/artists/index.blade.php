@extends('layouts.app')

@section('content')
  <div class="flex items-center justify-between p-5 bg-slate-800 rounded-2xl mb-10">
    <h1 class="text-2xl">Artisti</h1>

    <x-artist-create-form :songs="$songs" />
  </div>

  <div class="overflow-x-auto p-5 bg-slate-800 rounded-2xl mb-10">
    <table class="table">
      <thead>
        <tr>
          <th></th>
          <th>Nume</th>
          <th>Melodii</th>
          <th></th>
        </tr>
      </thead>
      <tbody id="artists-table">
        @foreach ($artists as $index => $artist)
          @include('artists.partials._row', ['artist' => $artist, 'index' => $index + 1])
        @endforeach
      </tbody>
    </table>
  </div>

  {{ $artists->links() }}
@endsection
