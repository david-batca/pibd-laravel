@props(['artists'])

<label for="song-modal" class="btn btn-primary">Adauga o melodie noua</label>

<input type="checkbox" id="song-modal" class="modal-toggle" />
<div class="modal" role="dialog">
  <div class="modal-box">
    <h3 class="text-lg font-bold mb-4">Adauga o melodie noua</h3>

    <form id="song-form" action="{{ route('song.create') }}" method="POST">
      @csrf

      <label for="song-form-input">Nume <em class="text-error">*</em></label>
      <input id="song-form-input" type="text" name="name" class="input w-full mb-4"
        placeholder="Introduceti numele" required />

      <label for="combo-input-artists">Artisti</label>
      {{-- <x-select-multiple-artists :artists="$artists" /> --}}

      <x-select-multiple-field :entities="['values' => $artists]" />

      <div class="modal-action">
        <button type="submit" class="btn btn-success">Salveaza</button>
        <label for="song-modal" class="btn btn-error">Anuleaza</label>
      </div>
    </form>
  </div>
</div>
