@extends("layouts.app")

@section("content")
  <div class="flex items-center justify-between p-5 bg-slate-800 rounded-2xl mb-10">
    <h1 class="text-2xl">Melodii</h1>

    <button class="btn btn-primary">Adauga o melodie noua</button>
  </div>

  {{ $songs }}

  <div class="overflow-x-auto p-5 bg-slate-800 rounded-2xl">
    <table class="table">
      <thead>
        <tr>
          <th></th>
          <th>Nume</th>
          <th>Artisti</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        @foreach ($songs as $index => $song)
          <tr>
            <th class="w-15">{{ $index + 1 }}</th>
            <td>{{ $song["name"] }}</td>
            <td>
              @foreach ($song["artists"] as $artist)
                <div>{{ $artist["name"] }}</div>
              @endforeach
            </td>
            <td class="w-30">
              <div class="flex items-center justify-around">
                <button class="btn btn-success btn-sm btn-circle">
                  <i class="mdi mdi-pencil text-lg"></i>
                </button>

                <button class="btn btn-error btn-sm btn-circle">
                  <i class="mdi mdi-delete text-lg"></i>
                </button>
              </div>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
@endsection
