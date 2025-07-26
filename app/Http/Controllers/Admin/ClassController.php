<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class ClassController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();
        
        // Filter by class
        if ($request->has('class')) {
            $query->where('my_class', $request->class);
        }
        
        // Filter by gender
        if ($request->has('gender')) {
            $query->where('gender', $request->gender);
        }
        
        $classes = $query->select('my_class')
            ->distinct()
            ->pluck('my_class');
            
        $students = $query->paginate(15);
        
        return view('admin.classes.index', compact('classes', 'students'));
    }
} 