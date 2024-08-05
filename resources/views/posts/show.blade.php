@extends('layouts.app')

@section('title', "Judul: $post->title")

@section('content')
  <div class="container mt-4">
    <article class="blog-post">
      <!-- Title -->
      <h2 class="display-4 mb-3">{{ $post->title }}</h2>

      <!-- Meta Info -->
      <p class="text-muted mb-4">
        <i class="bi bi-calendar"></i> {{ date('d M Y H:i', strtotime($post->created_at)) }}
      </p>

      <!-- Content -->
      <div class="mb-4">
        <p>{{ $post->content }}</p>
      </div>

      <!-- Comments Count -->
      <div class="mb-4">
        <small class="text-muted">
          <i class="bi bi-chat-dots"></i> {{ $tot_comments }} Komentar
        </small>
      </div>

      <!-- Comments Section -->
      @foreach ($comments as $comment)
        <div class="card mb-3 shadow-sm">
          <div class="card-body">
            <p class="mb-0" style="font-size: 14px;">{{ $comment->comment }}</p>
          </div>
        </div>
      @endforeach
    </article>

    <!-- Back Link -->
    <a href="{{ url('posts') }}" class="btn btn-primary mt-4">
      <i class="bi bi-arrow-left-circle"></i> Kembali
    </a>
  </div>
@endsection
