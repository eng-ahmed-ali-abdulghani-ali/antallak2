@extends('layouts.app')

@section('title')
  اضافة مستخدم جديد
@endsection

@section('content')
  <div class="container">
    <form class="edit_category main_form" method="POST" action="{{ route('category.update', $category['id']) }}"
    enctype="multipart/form-data">
    @csrf
    @method('PUT') <!-- Use the PUT method for updating -->
    <div class="mb-3 w-100">
      <label for="name" class="form-label">Category Name</label>
      <input type="text" class="form-control" id="name" name="name" value="{{ $category['name'] }}">
      <span class="error-message text-danger" id="nameError" style="display:none;">Name is
      required.</span>
    </div>
    <div class="mb-3 w-100">
      <label for="percentage" class="form-label">Real Exam Percentage</label>
      <input step="0.01" type="number" class="form-control" id="percentage" name="percentage"
      value="{{ $category['percentage'] }}">
      <span class="error-message text-danger" id="percentageError" style="display:none;">Real Exam Percentage is
      required To Show The Questions in this Category.</span>
    </div>
    <div class="mb-3 w-100">
      <label for="score" class="form-label">Analysis Monthly Score</label>
      <input step="0.01" type="number" class="form-control" id="score" name="month_score"
      value="{{ $category['month_score'] }}">
      <span class="error-message text-danger" id="scoreError" style="display:none;">Monthly Score is
      required To Show The Category Score in a Analysis.</span>
    </div>

    <div class="mb-3 w-100">
      <label for="categoryPhoto" class="form-label">Choose Photo</label>
      <input type="file" class="form-control" id="categoryPhoto" name="photo">
      @if ($category['photo'])
      <p>Current photo: <img src="{{ $category['photo'] }}" alt="category image" width="100"></p>
    @endif
      <span class="error-message text-danger" id="photo-error" style="display:none;">Photo is required.</span>
    </div>

    <div class="d-flex justify-content-center">
      <button type="submit" class="btn btn-outline-success">Update</button>
    </div>
    </form>
    <x-back-button />
  </div>
@endsection

@push('scripts')
  <script>
    document.addEventListener('DOMContentLoaded', function () {
    const form = document.querySelector('.edit_category');
    const name = document.querySelector('#name');
    const percentage = document.querySelector('#percentage');
    const score = document.querySelector('#score');

    const photo = document.querySelector('#categoryPhoto');
    const nameError = document.getElementById('nameError');
    const percentageError = document.getElementById('percentageError');
    const scoreError = document.getElementById('scoreError');

    const photoError = document.getElementById('photo-error');

    form.addEventListener('submit', function (e) {
      let valid = true;

      // Validate Name
      if (name.value.trim() === '') {
      nameError.style.display = 'block';
      valid = false;
      } else {
      nameError.style.display = 'none';
      }
      if (percentage.value.trim() === '') {
      percentageError.style.display = 'block';
      valid = false;
      } else {
      const percentageValue = parseFloat(percentage.value);
      if (isNaN(percentageValue) || percentageValue < 0 || percentageValue > 100) {
        percentageError.style.display = 'block';
        percentageError.textContent = 'Percentage must be between 0 and 100.';
        valid = false;
      } else {
        percentageError.style.display = 'none';
      }
      }

      if (score.value.trim() === '') {
      scoreError.style.display = 'block';
      valid = false;
      } else {
      const scoreValue = parseFloat(score.value);
      if (isNaN(scoreValue) || scoreValue < 0 || scoreValue > 100) {
        scoreError.style.display = 'block';
        scoreError.textContent = 'Score must be between 0 and 100.';
        valid = false;
      } else {
        scoreError.style.display = 'none';
      }
      }


      // Photo is not required for editing, only validate if present
      if (photo.files.length === 0 && !document.querySelector('img')) {
      photoError.style.display = 'block';
      valid = false;
      } else {
      photoError.style.display = 'none';
      }

      // Prevent form submission if validation fails
      if (!valid) {
      e.preventDefault();
      }
    });

    // Hide error message when user starts typing
    name.addEventListener('input', function () {
      if (name.value.trim() !== '') {
      nameError.style.display = 'none';
      }
    });
    percentage.addEventListener('input', function () {
      if (percentage.value.trim() !== '') {
      const percentageValue = parseFloat(percentage.value);
      if (!isNaN(percentageValue) && percentageValue >= 0 && percentageValue <= 100) {
        percentageError.style.display = 'none';
      }
      }
    });
    score.addEventListener('input', function () {
      if (score.value.trim() !== '') {
      const scoreValue = parseFloat(score.value);
      if (!isNaN(scoreValue) && scoreValue >= 0 && scoreValue <= 100) {
        scoreError.style.display = 'none';
      }
      }
    });
    photo.addEventListener('input', function () {
      if (photo.files.length > 0) {
      photoError.style.display = 'none';
      }
    });
    });
  </script>
@endpush