<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        // Get all users
        return User::all();
    }

    public function show($id)
    {
        // Get a single user
        return User::findOrFail($id);
    }

    public function store(Request $request)
    {
        // Validate and create a new user
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
        ]);

        $validated['password'] = bcrypt($validated['password']); // Encrypt password
        return User::create($validated);
    }

    public function update(Request $request, $id)
    {
        // Validate and update user
        $user = User::findOrFail($id);
        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|email|unique:users,email,' . $id,
            'password' => 'sometimes|required|string|min:6',
        ]);

        if (isset($validated['password'])) {
            $validated['password'] = bcrypt($validated['password']); // Encrypt password
        }

        $user->update($validated);
        return $user;
    }

    public function destroy($id)
    {
        // Delete user
        $user = User::findOrFail($id);
        $user->delete();
        return response()->json(['message' => 'User deleted successfully']);
    }
}
