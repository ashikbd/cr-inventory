<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\User;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.adminview', ['page' => 'user.index', 'title' => 'Admin Management', 'users'=>  $users]);
    }

    public function create()
    {
        return view('admin.adminview', ['page' => 'user.create', 'title' => 'Admin Create']);
    }

    public function edit($id)
    {
        $user = User::find($id);
        return view('admin.adminview', ['page' => 'user.edit', 'title' => 'Admin Create', 'user'=>$user]);
    }

    public function store(Request $request)
{
    // Validate the user input
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:6',
        'status' => 'required|in:active,inactive', // You can customize this validation rule
    ]);

    // Create a new user
    User::create([
        'name' => $request->input('name'),
        'email' => $request->input('email'),
        'password' => bcrypt($request->input('password')),
        'status' => $request->input('status'),
    ]);

    // Redirect to the user list with a success message
    return redirect()->route('users.index')->with('cmsStatus', 'success');
}

public function update(Request $request, $id)
{
    // Validate the user input
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users,email,' . $id, // Exclude the current user's email from unique validation
        'password' => 'nullable|string|min:6', // Password is optional for updates
        'status' => 'required|in:active,inactive', // You can customize this validation rule
    ]);

    // Find the user by ID
    $user = User::find($id);

    if (!$user) {
        return redirect()->route('users.index')->with('cmsStatus', 'fail');
    }

    // Update user data
    $user->name = $request->input('name');
    $user->email = $request->input('email');
    
    if ($request->has('password')) {
        $user->password = bcrypt($request->input('password'));
    }

    $user->status = $request->input('status');
    $user->save();

    // Redirect to the user list with a success message
    return redirect()->route('users.index')->with('cmsStatus', 'success');
}

    public function delete($id){
        User::find($id)->delete();
        return redirect('admin/users')->with('cmsStatus', 'success');
    }
}
