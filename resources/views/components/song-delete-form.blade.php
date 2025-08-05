@props(['id'])

<form id="song-delete-form-{{ $id }}" action="{{ route('song.delete', $id) }}" method="POST">
  @csrf
  @method('DELETE')

  <button type="submit" class="btn btn-error btn-sm btn-circle">
    <i class="mdi mdi-delete text-lg"></i>
  </button>
</form>
