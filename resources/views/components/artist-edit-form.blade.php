@props(['id', 'name', 'selected', 'songs'])

<label class="btn btn-success btn-sm btn-circle" for="artist-edit-modal-{{ $id }}">
  <i class="mdi mdi-pencil text-lg"></i>
</label>

<input type="checkbox" id="artist-edit-modal-{{ $id }}" class="modal-toggle" />
<div class="modal">
  <div class="modal-box">
    <h3 class="font-bold text-lg mb-4">Editeaza artistul</h3>
    <form id="artist-edit-form-{{ $id }}" action="{{ route('artist.update', $id) }}" method="POST">
      @csrf
      @method('PATCH')

      <label>Nume</label>
      <input id="artist-edit-form-input-{{ $id }}" name="name" type="text" class="input w-full mb-4"
        value="{{ $name }}" required />

      <label>Selecteaza melodiile</label>
      <x-select-multiple-songs :songs="$songs" :selected="$selected" />

      <div class="modal-action">
        <button type="submit" class="btn btn-success">Salvează</button>
        <label for="artist-edit-modal-{{ $id }}" class="btn btn-error">Anulează</label>
      </div>
    </form>
  </div>
</div>
