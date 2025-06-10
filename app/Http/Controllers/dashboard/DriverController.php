<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Requests\dashboard\users\CreateDriverRequest;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Models\Nationality;
use App\Services\dashboard\users\DriverService;
use Illuminate\Http\Request;

class DriverController extends Controller
{
  protected $driverService;

  public function __construct(DriverService $driverService)
  {
    $this->driverService = $driverService;
  }

  public function index()
  {
    return redirect()->route('users.index')->with('error', 'This page is deprecated. Please use the Users page to manage drivers.');
  }

  public function create(Request $request)
  {
    $nationalities = Nationality::all()->pluck('name');
    $role = $request->query('role');
    $allowedRoles = ['driver', 'admin', 'leader', 'user'];
    if (!in_array($role, $allowedRoles)) {
      return redirect()->back()->with('error', 'Invalid role specified.');
    }

    return view('pages.User.partials.' . $role, compact('role', 'nationalities'));
  }

  public function store(CreateDriverRequest $request)
  {
    $this->driverService->create($request);
    return redirect()->route('users.index')->with('success', 'Driver created successfully.');
  }
}
