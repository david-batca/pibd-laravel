@props(['artist', 'index'])

<tr id="artist_row_{{ $artist['id'] }}">
  <th class="w-15">{{ $index }}</th>
  <td class="">{{ $artist['name'] }}</td>
  <td>
    @foreach ($artist['songs'] as $song)
      <div>{{ $song['name'] }}</div>
    @endforeach
  </td>
  <td class="w-30">
    <div class="flex items-center justify-around">
      <x-artist-edit-form :id="$artist['id']" :name="$artist['name']" />

      <x-artist-delete-form :id="$artist['id']" />
    </div>
  </td>
</tr>
