@extends('layouts.app')

@section('title' , 'login')

@section('content')
  <div class="row">
    <div class="col-md-4"></div>

    <div class="card col-md-4">
      <div class="card-body">
        <h1 class="text-center">Login</h1>

        @if(session()->has('error_message'))
          <div class="alert alert-danger">
            {{ session()->get('error_message') }}
          </div>
        @endif

        <form method="POST" action="{{ url('login') }}" class="form-control">
          @csrf

          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email">
          </div>

          <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password">
          </div>

          <!-- Tambahkan Dropdown untuk Role -->
          <div class="mb-3">
            <label for="role" class="form-label">Role</label>
            <select class="form-control" id="role" name="role">
              <option value="">Pilih Role</option>
              <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
              <option value="author" {{ old('role') == 'author' ? 'selected' : '' }}>Author</option>
            </select>
            @if($errors->has('role'))
              <span class="text-danger">{{ $errors->first('role') }}</span>
            @endif
          </div>

          <div class="mb-3">
              <button type="submit" class="btn btn-primary">Login</button>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection