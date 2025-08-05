@props(['id', 'name', 'selected', 'artists'])

<label class="btn btn-success btn-sm btn-circle" for="song-edit-modal-{{ $id }}">
  <i class="mdi mdi-pencil text-lg"></i>
</label>

<input type="checkbox" id="song-edit-modal-{{ $id }}" class="modal-toggle" />
<div class="modal">
  <div class="modal-box">
    <h3 class="font-bold text-lg mb-4">Editeaza melodia</h3>
    <form id="song-edit-form-{{ $id }}" action="{{ route('song.update', $id) }}" method="POST">
      @csrf
      @method('PATCH')

      <label>Nume</label>
      <input id="song-edit-form-input-{{ $id }}" name="name" type="text" class="input w-full mb-4"
        value="{{ $name }}" required />

      <label>Selecteaza artistii</label>
      <x-select-multiple-artists :artists="$artists" :selected="$selected" />

      <div class="modal-action">
        <button type="submit" class="btn btn-success">Salvează</button>
        <label for="song-edit-modal-{{ $id }}" class="btn btn-error">Anulează</label>
      </div>
    </form>
  </div>
</div>
