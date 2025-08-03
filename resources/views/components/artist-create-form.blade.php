<label for="artist_modal" class="btn btn-primary">Adauga un artist nou</label>

<input type="checkbox" id="artist_modal" class="modal-toggle" />
<div class="modal" role="dialog">
  <div class="modal-box">
    <h3 class="text-lg font-bold mb-4">Adauga un artist nou</h3>

    <form id="artist_form" action="{{ route('artist.create') }}" method="POST">
      @csrf

      <label>Nume</label>
      <input type="text" name="name" class="input w-full mb-4" placeholder="Introduceti numele" required />

      <div class="modal-action">
        <button type="submit" class="btn btn-success">Salveaza</button>
        <label for="artist_modal" class="btn btn-error">Anuleaza</label>
      </div>
    </form>
  </div>
</div>

@push('scripts')
  <script>
    document.addEventListener('DOMContentLoaded', () => {
      initCreateForm({
        entity: 'artist',
        apiUrl: '{{ route('artist.create') }}',
        onAdd: (artist) => {
          const table = document.getElementById('artists_table');

          table.insertAdjacentHTML('beforeend', artist.html);

          const id = artist.id;
          initEditForm({
            id: id,
            entity: 'artist',
            apiUrl: window.routes.artistUpdate.replace(':id', id),
            onUpdate: (artist) => {
              const row = document.getElementById(`artist_row_${artist.id}`);
              row.children[1].textContent = artist.name;

              document.getElementById(`artist_edit_modal_${artist.id}`).checked = false;
            }
          });

          initDeleteForm({
            id: id,
            entity: 'artist',
            apiUrl: window.routes.artistDelete.replace(':id', id),
            onDelete: () => {
              const tableRow = document.getElementById(`artist_row_${id}`);
              tableRow.remove();
            }
          })
        }
      })
    })
  </script>
@endpush
