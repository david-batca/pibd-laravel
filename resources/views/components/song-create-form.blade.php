@props(['artists'])

<label for="song_modal" class="btn btn-primary">Adauga o melodie noua</label>

<input type="checkbox" id="song_modal" class="modal-toggle" />
<div class="modal" role="dialog">
  <div class="modal-box">
    <h3 class="text-lg font-bold mb-4">Adauga o melodie noua</h3>

    <form id="song_form" action="{{ route('song.create') }}" method="POST">
      @csrf

      <fieldset class="fieldset">
        <legend class="fieldset-legend">Nume</legend>
        <input type="text" name="name" class="input w-full mb-4" placeholder="Introduceti numele" required />
      </fieldset>

      <fieldset class="fieldset">
        <legend class="fieldset-legend">Artisti</legend>
        <x-select-multiple-artists :artists="$artists" />
      </fieldset>

      <div class="modal-action">
        <button type="submit" class="btn btn-success">Salveaza</button>
        <label for="song_modal" class="btn btn-error">Anuleaza</label>
      </div>
    </form>
  </div>
</div>

@push('scripts')
  <script>
    document.addEventListener('DOMContentLoaded', () => {
      initCreateForm({
        entity: 'song',
        apiUrl: '{{ route('song.create') }}',
        onAdd: (song) => {
          const table = document.getElementById('songs_table');

          table.insertAdjacentHTML('beforeend', song.html);

          const id = song.id;

          initEditForm({
            id: id,
            entity: 'song',
            apiUrl: window.routes.songUpdate.replace(':id', id),
            onUpdate: (song) => {
              const row = document.getElementById(`song_row_${song.id}`);
              row.children[1].textContent = song.name;

              document.getElementById(`song_edit_modal_${song.id}`).checked = false;
            }
          });

          initDeleteForm({
            id: id,
            entity: 'song',
            apiUrl: window.routes.songDelete.replace(':id', id),
            onDelete: () => {
              const tableRow = document.getElementById(`song_row_${id}`);
              tableRow.remove();
            }
          })
        }
      })
    })
  </script>
@endpush
