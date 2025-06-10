<?php

namespace App\Services\api\client;

use App\Http\Requests\dashboard\admin\CreateCategoryRequest;
use App\Models\Category;

class CategoryService
{
  public function getAll()
  {
    return  Category::all();
  }

  public function getById($id)
  {
    return Category::findOrFail($id);
  }

  public function create(array $data)
  {
    $category = Category::create([
      'name' => $data['name'],
    ]);
    if (isset($data['image'])) {
      $category->addMedia($data['image'])->toMediaCollection('image');
    }
    return $category;
  }

  public function update(array $data, $id)
  {
    $category = Category::findOrFail($id);
    $category->update([
      'name' => $data['name'],
    ]);

    if (isset($data['image'])) {
      $category->clearMediaCollection('image');

      $category->addMedia($data['image'])->toMediaCollection('image');
    }
  }
  public function delete($id)
  {
    $category = Category::findOrFail($id);
    return ($category->delete());
  }
}
