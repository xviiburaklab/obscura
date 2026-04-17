<?php

namespace App\Http\Controllers;

use App\Models\MenuItem;
use Illuminate\Http\Request;

class AdminMenuController extends Controller
{
    public function index()
    {
        $menuItems = MenuItem::orderBy('sort_order')->get();
        return view('admin.menu.index', compact('menuItems'));
    }

    public function create()
    {
        return view('admin.menu.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:200',
            'description' => 'required|string',
            'course' => 'required|integer|min:1',
            'is_active' => 'boolean',
            'sort_order' => 'required|integer',
        ]);
        
        $validated['is_active'] = $request->has('is_active');

        MenuItem::create($validated);

        return redirect()->route('admin.menu.index')->with('success', 'Menu item added.');
    }

    public function edit(MenuItem $menu)
    {
        return view('admin.menu.edit', ['menuItem' => $menu]);
    }

    public function update(Request $request, MenuItem $menu)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:200',
            'description' => 'required|string',
            'course' => 'required|integer|min:1',
            'is_active' => 'boolean',
            'sort_order' => 'required|integer',
        ]);
        
        $validated['is_active'] = $request->has('is_active');

        $menu->update($validated);

        return redirect()->route('admin.menu.index')->with('success', 'Menu item updated.');
    }

    public function destroy(MenuItem $menu)
    {
        $menu->delete();
        return redirect()->route('admin.menu.index')->with('success', 'Menu item deleted.');
    }
}
