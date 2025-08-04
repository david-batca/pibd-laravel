@props(['song'])

<tr id="artist_row_{{ $song['id'] }}">
  <th class="w-15">{{ $song['id'] }}</th>
  <td class="">{{ $song['name'] }}</td>
  <td>
    @foreach ($song['artists'] as $artist)
      <div>{{ $artist['name'] }}</div>
    @endforeach
  </td>
  <td class="w-30">
    <div class="flex items-center justify-around">
      <x-song-edit-form :id="$song['id']" :name="$song['name']" />

      <x-song-delete-form :id="$song['id']" />
    </div>
  </td>
</tr>
