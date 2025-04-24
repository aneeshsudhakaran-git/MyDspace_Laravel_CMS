<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Admin\Controller;
use App\Models\Admin\Menu;
use App\Models\Admin\SiteConfiguration;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $menutype = $request->menutype;
        $search = $request->search;

        $menus = DB::table('menus as menu')
                ->leftjoin('menus as parent_menu', 'parent_menu.id', '=', 'menu.parent_id')
                ->select('menu.*', 'parent_menu.name as parent_menu_name', 'parent_menu.title as parent_menu_title' )
                ->orderByRaw('menu.displayorder, parent_menu.displayorder  asc');

        if (!empty($search)) {
            $menus->where(function ($query) use ($search) {
                $query->where('menu.title', 'like', '%' . $search . '%')
                        ->orWhere('menu.description', 'like', '%' . $search . '%')
                        ->orWhere('menu.name', 'like', '%' . $search . '%');
            });
        }
        
        if ($menutype) {
            $menus->where('menu.menutype', $menutype);
        }     
        $menus = $menus->paginate(10)->withQueryString();

        return view('admin.menu.index', compact('menus', 'menutype', 'search'))
                    ->with('i', (request()->input('page', 1) - 1) * 10);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $classnames = SiteConfiguration::getMenuStyleName(); // SiteConfiguration::getMenuStyleName();
       
        return view('admin.menu.create', compact('classnames'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        
        $request->validate([
            'name' => 'required|string|alpha_dash|max:255',
            'title' => 'required|string|max:255',
            'displayorder' => 'required|integer|between:0,255',
            'link_type' => 'required|in:S,N,T',
            'status' => 'required'
        ], [
            'link_type.in' => 'Please select a valid link type.',
        ]);

        //dd($request);

        $menu = new Menu;
        $menu->parent_id = $request->parent_id ? $request->parent_id : 0;
        $menu->title = $request->title;
        $menu->name = $request->name;
        $menu->classname = $request->classname;
        $menu->status = $request->status;
        $menu->description = $request->description;
        $menu->displayorder = $request->displayorder;
        $menu->link_type = $request->link_type;
        
        $menu->menutype = (!isset($request->menutype) && $request->menutype == null) ? 0 : $request->menutype;
        
        $menu->save();
        
        // get redirect URL
        $redirect_url = redirectURL($request->b, route('admin.menu'));
        return redirect(  $redirect_url )
                         ->with('success', 'Menu Created Successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $classnames = SiteConfiguration::getMenuStyleName(); // SiteConfiguration::getMenuStyleName();

        //$parent_menu =  Menu::where('status', 'P')->orderby('title', 'asc')->pluck('title', 'id');
        $parent_menu = DB::table('menus as menu')
                        ->select('menu.*')
                        ->orderby('menu.displayorder', 'asc')
                        ->get();

        $menu = Menu::find($id);
        return view('admin.menu.edit', compact('menu', 'parent_menu', 'classnames'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($id, Request $request)
    {
        $request->validate([
            'name' => 'required|string|alpha_dash|max:255',
            'title' => 'required|string|max:255',
            'displayorder' => 'required|integer|between:0,255',
            'link_type' => 'required|in:S,N,T',
            'status' => 'required'
        ], [
            'link_type.in' => 'Please select a valid link type.',
        ]);

        //dd($request);

        $menu = menu::find($id);
        $menu->parent_id = $request->parent_id;
        $menu->title = $request->title;
        $menu->name = $request->name;
        $menu->classname = $request->classname;
        $menu->description = $request->description;
        $menu->displayorder = $request->displayorder;
        $menu->menutype = (!isset($request->menutype) && $request->menutype == null) ? 0 : $request->menutype;
        $menu->status = $request->status;
        $menu->link_type = $request->link_type;
        $menu->save();

        // get redirect URL
        $redirect_url = redirectURL($request->b, route('admin.menu'));
        return redirect(  $redirect_url )
                                 ->with('success', 'Menu Updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id, Request $request)
    {
        $menu = menu::find($id);
        if(isset($menu->id) && $menu->id != null ){
            $menu->delete();
        }

        // get redirect URL
        $redirect_url = redirectURL($request->b, route('admin.menu'));
        return redirect(  $redirect_url )
                    ->with('success', 'Menu Deleted Successfully.');
    }

    // updateOrder
    public function updateOrder(Request $request)
    {
        $rules = [];
    
        foreach ($request->input('orders', []) as $id => $value) {
            $rules["orders.$id"] = 'required|integer|min:1';
        }

        $messages = [
            'orders.*.required' => 'The display order for each menu item is required.',
            'orders.*.integer' => 'The display order must be a valid number.',
            'orders.*.min' => 'The display order must be at least 1.',
        ];

        // Validate the request with custom messages
        $validated = $request->validate($rules, $messages);

        // Update the display order in the database
        foreach ($validated['orders'] as $id => $order) {
            DB::table('menus')->where('id', $id)->update(['displayorder' => $order]);
        }

        return redirect()->back()->with('success', 'Display order(s) updated successfully.');
    }
}
