<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\dashboard\category\CreateCategoryRequest;
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
      return view("pages.Category.index", compact("categories"));
    } else {

      return $this->error("No Categories Found", 400, null);
    }
  }
  public function create()
  {
    return view("pages.Category.create");
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
      return $this->success($category, "Category added successfuly", 200);
    } catch (QueryException $e) {
      DB::rollBack();
      return $this->error($e->getMessage());
    } catch (\Exception $e) {
      DB::rollBack();
      return $this->error($e->getMessage(), 400, null);
    }
  }
  public function destroy($id)
  {


    if ($this->service->delete($id)) {

      return $this->success(null, "Category deleted successfully", 200);
    }
    return $this->error("pls try again there is an erroe");
  }
}
