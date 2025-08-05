@extends('layouts.app')

@section('content')
  @if (session('success'))
    <div role="alert" id="flash-alert"
      class="alert alert-success shadow-lg absolute bottom-4 left-1/2 -translate-x-1/2 w-1/2 z-50">
      <i class="mdi mdi-information-outline text-xl"></i>
      <span>{{ session('success') }}</span>
    </div>
  @endif

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
      <tbody id="songs-table">
        @foreach ($songs as $song)
          <tr id="artist-row-{{ $song['id'] }}">
            <th class="w-15">{{ $song['id'] }}</th>
            <td>{{ $song['name'] }}</td>
            <td>
              @foreach ($song['artists'] as $artist)
                <div>{{ $artist['name'] }}</div>
              @endforeach
            </td>
            <td class="w-30">
              <div class="flex items-center justify-around">
                <x-song-edit-form :id="$song['id']" :name="$song['name']" :artists="$artists" :selected="$song['artists']" />

                <x-song-delete-form :id="$song['id']" />
              </div>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>

  {{ $songs->links() }}
@endsection
