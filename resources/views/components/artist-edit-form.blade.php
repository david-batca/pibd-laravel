@props(['id', 'name'])

<button class="btn btn-success btn-sm btn-circle" type="button" onclick="openEditForm('artist', {{ $id }})">
  <i class="mdi mdi-pencil text-lg"></i>
</button>

<input type="checkbox" id="artist_edit_modal_{{ $id }}" class="modal-toggle" />
<div class="modal">
  <div class="modal-box">
    <h3 class="font-bold text-lg mb-4">Editează artist</h3>
    <form id="artist_edit_form_{{ $id }}" action="{{ route('artist.update', $id) }}" method="POST">
      @csrf
      @method('PATCH')

      <label>Nume</label>
      <input name="name" type="text" class="input w-full mb-4" value="{{ $name }}" required />
      <div class="modal-action">
        <button type="submit" class="btn btn-success">Salvează</button>
        <label for="artist_edit_modal_{{ $id }}" class="btn btn-error">Anulează</label>
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
        entity: 'artist',
        apiUrl: window.routes.artistUpdate.replace(':id', id),
        onUpdate: (artist) => {
          const tableRow = document.getElementById(`artist_row_${artist.id}`);
          tableRow.children[1].textContent = artist.name;

          document.getElementById(`artist_edit_modal_${artist.id}`).checked = false;
        }
      })
    })
  </script>
@endpush
