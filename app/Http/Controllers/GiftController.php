<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gift;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class GiftController extends Controller
{
    use AuthorizesRequests;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // عرض كل الهدايا
        return response()->json(Gift::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // if (!auth()->user() || !auth()->user()->is_admin) {
        //     abort(403, 'Unauthorized');
        // }
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'points' => 'required|integer|min:0',
            'quantity' => 'required|integer|min:0',
        ]);
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('gifts', 'public');
        }
        $gift = Gift::create($data);
        return response()->json($gift, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $gift = Gift::findOrFail($id);
        return response()->json($gift);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // if (!auth()->user() || !auth()->user()->is_admin) {
        //     abort(403, 'Unauthorized');
        // }
        $gift = Gift::findOrFail($id);
        $data = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'points' => 'sometimes|required|integer|min:0',
            'quantity' => 'sometimes|required|integer|min:0',
        ]);
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('gifts', 'public');
        }
        $gift->update($data);
        return response()->json($gift);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // if (!auth()->user() || !auth()->user()->is_admin) {
        //     abort(403, 'Unauthorized');
        // }
        $gift = Gift::findOrFail($id);
        $gift->delete();
        return response()->json(['message' => 'Gift deleted']);
    }
}
