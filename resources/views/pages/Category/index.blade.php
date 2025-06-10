@extends('layouts.app')

@section('title')
  All Categories
@endsection

@section('content')
  <div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
    <h2></h2>
    <a class="btn btn-success" style=" transition: background-color 0.3s ease;" on data-bs-toggle="modal"
      data-bs-target="#createCategoryModal">
      Create New Category
    </a>
    </div>

    <div class="table-responsive">
    <table class="table table-bordered table-striped align-middle text-center">
      <thead class="table-dark">
      <tr>
        <th>#</th>
        <th>Name</th>
        <th>Image</th>
        <th>Actions</th>
      </tr>
      </thead>
      <tbody>
      @forelse ($categories as $category)
      <tr>
        <td>{{ $category->id }}</td>
        <td>
        <a href="{{ route('category.show', $category->id) }}">
        {{ $category->name }}
        </a>
        </td>   
        <td>
        @if($category->image_url)
      <img src="{{ $category->image_url }}" alt="Image" style="width: 60px; height: 40px; object-fit: cover;">
      @else
      <span class="text-muted">No image</span>
      @endif
        </td>
        <td>
        <a class="btn btn-sm btn-primary me-2" href="{{ route('category.edit', $category->id) }}">
        <i class="fa fa-edit"></i>
        </a>
        <form action="{{ route('category.destroy', $category->id) }}" method="POST" class="d-inline"
        id="delete-form-{{ $category->id }}">
        @csrf
        @method('DELETE')
        <button type="button" class="btn btn-sm btn-danger" onclick="confirmDeletion({{ $category->id }})">
        <i class="fa fa-trash"></i>
        </button>
        </form>
        </td>
      </tr>
    @empty
      <tr>
      <td colspan="4">No categories found.</td>
      </tr>
    @endforelse
      </tbody>
    </table>
    </div>

    <a href="{{ url()->previous() }}" class="btn btn-secondary mt-3">
    <i class="fa fa-arrow-left"></i> Back
    </a>
  </div>

  {{-- Create Category Modal --}}
  <div class="modal fade" id="createCategoryModal" tabindex="-1" aria-labelledby="createCategoryModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content rounded-4 shadow">
      <div class="modal-header bg-success text-white">
      <h5 class="modal-title" id="createCategoryModalLabel">Create New Category</h5>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <form method="POST" action="{{ route('category.store') }}" enctype="multipart/form-data">
      @csrf
      <div class="modal-body">
        <div class="mb-3">
        <label for="name_en" class="form-label">Category Name (English)</label>
        <input type="text" class="form-control" id="name_en" name="name_en" value="{{ old('name_en') }}" required>
        @error('name_en')
      <small class="text-danger">{{ $message }}</small>
      @enderror
        </div>

        <div class="mb-3">
        <label for="name_ar" class="form-label">Category Name (Arabic)</label>
        <input type="text" class="form-control" id="name_ar" name="name_ar" value="{{ old('name_ar') }}" required>
        @error('name_ar')
      <small class="text-danger">{{ $message }}</small>
      @enderror
        </div>

        <div class="mb-3">
        <label for="image" class="form-label">Category Image</label>
        <input type="file" class="form-control" id="image" name="image">
        @error('image')
      <small class="text-danger">{{ $message }}</small>
      @enderror
        </div>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-success">Save Category</button>
      </div>
      </form>
    </div>
    </div>
  </div>

@endsection

@push('scripts')
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
    function confirmDeletion(id) {
    Swal.fire({
      title: 'Are you sure?',
      text: 'This will delete the category!',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#d33',
      cancelButtonColor: '#3085d6',
      confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
      if (result.isConfirmed) {
      document.getElementById('delete-form-' + id).submit();
      }
    });
    }

    @if($errors->any())
    const modal = new bootstrap.Modal(document.getElementById('createCategoryModal'));
    modal.show();
    @endif
  </script>
@endpush