@props(['id'])

<form id="artist_delete_form_{{ $id }}" action="{{ route('artist.delete', $id) }}" method="POST">
  @csrf
  @method('DELETE')

  <button type="submit" class="btn btn-error btn-sm btn-circle">
    <i class="mdi mdi-delete text-lg"></i>
  </button>
</form>

@push('scripts')
  <script>
    document.addEventListener('DOMContentLoaded', () => {
      const id = {{ $id }};

      initDeleteForm({
        id: id,
        entity: 'artist',
        apiUrl: window.routes.artistDelete.replace(':id', id),
        onDelete: () => {
          const tableRow = document.getElementById(`artist_row_${id}`);
          tableRow.remove();
        }
      })
    })
  </script>
@endpush
