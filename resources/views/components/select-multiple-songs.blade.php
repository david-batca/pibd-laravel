@props(['songs'])

@php
  $songsJson = $songs
      ->map(function ($song) {
          return ['id' => $song['id'], 'name' => $song['name']];
      })
      ->toJson();
@endphp

<div id="combobox-multi-songs" data-songs="{{ $songsJson }}">
  {{-- wrapper-ul pentru tag-uri + input --}}
  <div class="tags-wrapper-songs flex flex-wrap items-center gap-1 p-2 border rounded">
    <template id="tag-template-songs">
      <span class="tag-song px-2 py-1 bg-blue-500 text-white rounded-full flex items-center gap-1 text-sm">
        <span class="tag-name-song"></span>
        <button type="button" class="tag-song-remove">&times;</button>
      </span>
    </template>
    <input type="text" id="combo-input-songs" placeholder="Caută melodii" class="flex-1 outline-none"
      autocomplete="off" />
  </div>

  <ul id="combo-list-songs"
    class="dropdown-content menu p-2 shadow bg-base-100 rounded-box w-full max-h-48 overflow-auto mt-1 hidden"></ul>
</div>
