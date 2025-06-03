<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\dashboard\admin\CreateCategoryRequest;
use App\ResponseApi\ResponseApi;
use App\Services\api\client\CategoryService;

use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
  use ResponseApi;
  //

  protected $service;

  public function __construct(CategoryService $service)
  {
    $this->service = $service;
  }

  public function index()
  {
    $categories = $this->service->getAll();
    if ($categories) {
      return $this->success($categories, "All Categories", 200);
    } else {

      return $this->error("", 400, null);
    }
  }



  public function store(CreateCategoryRequest $request)
  {
    try {
      DB::beginTransaction();
      $category = $this->service->create($request->validated());
      DB::commit();
      return $this->success($category, "Category has been created successfully", 200);
    } catch (QueryException $e) {
      DB::rollBack();
      return $this->error($e->getMessage());
    } catch (\Exception $e) {
      DB::rollBack();
      return $this->error($e->getMessage(), 400, null);
    }
  }


  public function update(CreateCategoryRequest $request, $id)
  {

    try {
      DB::beginTransaction();
      $category =  $this->service->update($request->validated(), $id);
      DB::commit();
      return $this->success($category, "All Categories", 200);
    } catch (QueryException $e) {
      DB::rollBack();
      return $this->error($e->getMessage());
    } catch (\Exception $e) {
      DB::rollBack();
      return $this->error($e->getMessage(), 400, null);
    }
  }
  public function delete($id)
  {

    try {
      DB::beginTransaction();
      $this->service->delete($id);
      DB::commit();
      return $this->success(null, "All Categories", 200);
    } catch (QueryException $e) {
      DB::rollBack();
      return $this->error($e->getMessage());
    } catch (\Exception $e) {
      DB::rollBack();
      return $this->error($e->getMessage(), 400, null);
    }
  }
}
