@extends('layouts.app')

@section('title', 'Edit Postingan')

@section('content')
  <div class="container mt-4">
    <h1 class="mb-4">Ubah Postingan</h1>

    <!-- Edit Form -->
    <form method="POST" action="{{ url("posts/$post->id") }}" class="mb-4">
      @method('PATCH')
      @csrf
      <div class="mb-3">
        <label for="title" class="form-label">Judul</label>
        <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $post->title) }}" required>
      </div>
      <div class="mb-3">
        <label for="content" class="form-label">Konten</label>
        <textarea class="form-control" id="content" name="content" rows="5" required>{{ old('content', $post->content) }}</textarea>
      </div>
      <button type="submit" class="btn btn-primary">Simpan</button>
    </form>

    <!-- Delete Form -->
    <form method="POST" action="{{ url("posts/$post->id") }}" class="d-inline">
      @method('DELETE')
      @csrf
      <button type="submit" class="btn btn-danger">Hapus</button>
    </form>

  </div>
@endsection
