@props(['artists', 'selected' => []])

@php
  $artistsJson = collect($artists)
      ->map(function ($artist) {
          return ['id' => $artist['id'], 'name' => $artist['name']];
      })
      ->toJson();

  $selectedJson = collect($selected)
      ->map(function ($artist) {
          return ['id' => $artist['id'], 'name' => $artist['name']];
      })
      ->toJson();
@endphp

<div id="combobox-multi-artists" data-artists="{{ $artistsJson }}" data-selected="{{ $selectedJson }}">
  <div class="tags-wrapper-artists flex flex-wrap items-center gap-1 p-2 border rounded">
    <template id="tag-template-artists">
      <span class="tag-artist px-2 py-1 bg-blue-500 text-white rounded-full flex items-center gap-1 text-sm">
        <span class="tag-artist-name"></span>
        <button type="button" class="tag-artist-remove">
          <i class="mdi mdi-close text-lg"></i>
        </button>
      </span>
    </template>

    <input type="text" id="combo-input-artists" placeholder="Caută artisti" class="flex-1 outline-none"
      autocomplete="off" />
  </div>

  <ul id="combo-list-artists"
    class="dropdown-content menu p-2 shadow bg-base-100 rounded-box w-full max-h-28 overflow-auto mt-1 hidden"></ul>
</div>
