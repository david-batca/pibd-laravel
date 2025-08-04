@props(['id', 'name'])

<label class="btn btn-success btn-sm btn-circle" for="song_edit_modal_{{ $id }}">
  <i class="mdi mdi-pencil text-lg"></i>
</label>

<input type="checkbox" id="song_edit_modal_{{ $id }}" class="modal-toggle" />
<div class="modal">
  <div class="modal-box">
    <h3 class="font-bold text-lg mb-4">Editează song</h3>
    <form id="song_edit_form_{{ $id }}" action="{{ route('song.update', $id) }}" method="POST">
      @csrf
      @method('PATCH')

      <label>Nume</label>
      <input name="name" type="text" class="input w-full mb-4" value="{{ $name }}" required />
      <div class="modal-action">
        <button type="submit" class="btn btn-success">Salvează</button>
        <label for="song_edit_modal_{{ $id }}" class="btn btn-error">Anulează</label>
      </div>
    </form>
  </div>
</div>

@push('scripts')
  <script>
    document.addEventListener('DOMContentLoaded', () => {
      const id = {{ $id }};

      initEditForm({
        id: id,
        entity: 'song',
        apiUrl: window.routes.songUpdate.replace(':id', id),
        onUpdate: (song) => {
          const tableRow = document.getElementById(`song_row_${song.id}`);
          tableRow.children[1].textContent = song.name;

          document.getElementById(`song_edit_modal_${song.id}`).checked = false;
        }
      })
    })
  </script>
@endpush
