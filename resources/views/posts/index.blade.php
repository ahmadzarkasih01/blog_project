@extends('layouts.app')

@section('title', 'Blog')

@section('content')
  <div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h1 class="mb-0">Blog Lumut.id</h1>
      <a href="{{ url('posts/create') }}" class="btn btn-success">+ Buat Postingan</a>
    </div>

    @foreach ($posts as $post)
      <div class="card mb-4 shadow-sm">
        <div class="card-body">
          <h5 class="card-title">{{ $post->title }}</h5>
          <p class="card-text">{{ Str::limit($post->content, 150, '...') }}</p>
          <p class="card-text">
            <small class="text-muted">Diperbarui pada {{ date('d M Y H:i', strtotime($post->created_at)) }}</small>
          </p>
          <div class="d-flex justify-content-between">
            <a href="{{ url("posts/$post->id") }}" class="btn btn-primary">Selengkapnya</a>
            <a href="{{ url("posts/$post->id/edit") }}" class="btn btn-warning">Edit</a>
          </div>
        </div>
      </div>
    @endforeach
  </div>
@endsection
