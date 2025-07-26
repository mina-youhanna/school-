<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();
        
        // Filter by name
        if ($request->has('name')) {
            $query->where('full_name', 'like', '%' . $request->name . '%');
        }
        
        // Filter by role
        if ($request->has('role')) {
            $query->where('role', $request->role);
        }
        
        // Filter by class
        if ($request->has('class')) {
            $query->where('my_class', $request->class);
        }
        
        $users = $query->paginate(15);
        
        return view('admin.users.index', compact('users'));
    }
} 