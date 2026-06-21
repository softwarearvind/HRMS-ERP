<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Menu;
use App\Events\MenuCreated;

class MenuController extends Controller
{
    public function index()
    {
        $menus = Menu::latest()->get();
        return view('superadmin.menu.index',compact('menus'));
    }

   public function store(Request $request)
{
    $menu = Menu::create([
        'name' => $request->name,
        'route' => $request->route,
        'icon' => $request->icon,
        'role' => $request->role,
        'parent_id' => $request->parent_id ?? 0,
        'sort_order' => $request->sort_order ?? 0,
    ]);
      event(new MenuCreated($menu));

    return back()->with('success', 'Menu created successfully');
}
}
