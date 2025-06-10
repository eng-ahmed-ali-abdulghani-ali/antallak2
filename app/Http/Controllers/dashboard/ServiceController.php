<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\dashboard\service\CreateServiceRequest;
use App\ResponseApi\ResponseApi;
use App\Services\api\client\ServiceService;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class ServiceController extends Controller
{
  //
  use ResponseApi;
  //
  protected $service;

  public function __construct(ServiceService $service)
  {
    $this->service = $service;
  }

  public function index()
  {
    $serv = $this->service->getAll();
    if ($serv) {
      return $this->success($serv, "All Services", 200);
    } else {

      return $this->error("No Services Available", 400, null);
    }
  }


  public function store(CreateServiceRequest $request)
  {
    try {
      DB::beginTransaction();
      $serv = $this->service->create($request->validated());
      DB::commit();
      return $this->success($serv, "Service has been created successfully", 200);
    } catch (QueryException $e) {
      DB::rollBack();
      return $this->error($e->getMessage());
    } catch (\Exception $e) {
      DB::rollBack();
      return $this->error($e->getMessage(), 400, null);
    }
  }


  public function update(CreateServiceRequest $request, $id)
  {

    try {
      DB::beginTransaction();
      $serv =  $this->service->update($request->validated(), $id);
      DB::commit();
      return $this->success($serv, "All Categories", 200);
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


    $this->service->delete($id);

    return $this->success(null, "Service deleted successfuly", 200);
  }
}
