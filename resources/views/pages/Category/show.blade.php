@extends('layouts.app')

@section('title')
  {{ $category->name }}
@endsection

@section('content')
  <div class="container">
    <div class="header-cont d-flex justify-content-between align-items-center mb-4">
    <h2>Category: {{ $category->name }}</h2>
    <a class="btn btn-success" href="{{ route('admin.chapters.create', $category->id) }}">
      Add New Chapter
    </a>
    </div>

    <div class="card mb-5 p-3">
    <h4 class="mb-3">Category Info</h4>
    <ul class="list-group list-group-flush">
      <li class="list-group-item"><strong>ID:</strong> {{ $category->id }}</li>
      <li class="list-group-item"><strong>Name:</strong> {{ $category->name }}</li>
      <li class="list-group-item">
      <strong>Image:</strong><br>
      @if($category->image_url)
      <img src="{{ $category->image_url }}" alt="Category Image" class="img-thumbnail" style="max-width: 200px;">
    @else
      <span class="text-muted">No image</span>
    @endif
      </li>
    </ul>
    </div>
    <a href="{{ url()->previous() }}" class="btn btn-secondary">
    <i class="fa fa-arrow-left"></i> Back
    </a>
  </div>
@endsection