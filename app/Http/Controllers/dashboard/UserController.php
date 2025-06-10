<?php

namespace App\Http\Controllers\dashboard;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class UserController extends Controller
{
  //
  public function index()
  {
    // Logic to retrieve all users
    $users = User::paginate(10); // Example pagination

    return view('pages.User.index', compact('users'));
  }
  public function create(Request $request)
  {
    // Logic to show the user creation form
    $role = $request->query('role');
    $allowedRoles = ['driver', 'admin', 'leader', 'user'];
    if (!in_array($role, $allowedRoles)) {
      return redirect()->back()->with('error', 'Invalid role specified.');
    }
    return view('pages.User.partials.' . $role, compact('role'));
  }
}
