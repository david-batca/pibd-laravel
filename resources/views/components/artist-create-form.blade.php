@props(['songs'])

<label for="artist-modal" class="btn btn-primary">Adauga un artist nou</label>

<input type="checkbox" id="artist-modal" class="modal-toggle" />
<div class="modal" role="dialog">
  <div class="modal-box">
    <h3 class="text-lg font-bold mb-4">Adauga un artist nou</h3>

    <form id="artist-create-form" action="{{ route('artist.create') }}" method="POST">
      @csrf

      <label>Nume <em class="text-error">*</em></label>
      <input id="artist-create-form-input" type="text" name="name" class="input w-full mb-4"
        placeholder="Introduceti numele" required />

      <label>Melodii</label>
      <x-select-multiple-songs :songs="$songs" />

      <div class="modal-action">
        <button type="submit" class="btn btn-success">Salveaza</button>
        <label for="artist-modal" class="btn btn-error">Anuleaza</label>
      </div>
    </form>
  </div>
</div>
