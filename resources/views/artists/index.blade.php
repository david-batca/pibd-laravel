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
    <h1 class="text-2xl">Artisti</h1>

    <x-artist-create-form :songs="$songs" />
  </div>

  <div class="overflow-x-auto p-5 bg-slate-800 rounded-2xl mb-10">
    <table class="table">
      <thead>
        <tr>
          <th>Id</th>
          <th>Nume</th>
          <th>Melodii</th>
          <th></th>
        </tr>
      </thead>
      <tbody id="artists-table">
        @foreach ($artists as $artist)
          <tr id="artist-row-{{ $artist['id'] }}">
            <th class="w-15">{{ $artist['id'] }}</th>
            <td>{{ $artist['name'] }}</td>
            <td>
              @foreach ($artist['songs'] as $song)
                <div>{{ $song['name'] }}</div>
              @endforeach
            </td>
            <td class="w-30">
              <div class="flex items-center justify-around">
                <x-artist-edit-form :id="$artist['id']" :name="$artist['name']" :songs="$songs" :selected="$artist['songs']" />

                <x-artist-delete-form :id="$artist['id']" />
              </div>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>

  {{ $artists->links() }}
@endsection
