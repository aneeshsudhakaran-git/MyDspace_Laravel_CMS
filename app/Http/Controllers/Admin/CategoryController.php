<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Controller;
use App\Models\Admin\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->search;
        $categories = Category::orderByRaw('displayorder asc, category asc');

        if (!empty($search)) {
            $categories->where(function ($query) use ($search) {
                $query->where('category', 'like', '%' . $search . '%')
                      ->orWhere('description', 'like', '%' . $search . '%');
            });
        }

        $categories = $categories->latest()->paginate(10);
          
        return view('admin.category.index', compact('categories', 'search'))
                    ->with('i', (request()->input('page', 1) - 1) * 10);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        
        $request->validate([
            'category' => 'required|string|max:255',
            'displayorder' => 'required|integer|between:0,255',
            'status' => 'required'
        ]);

        //dd($request);

        $cat = new Category;
        $cat->category = $request->category;
        $cat->status = $request->status;
        $cat->description = $request->description;
        $cat->displayorder = $request->displayorder;
        $cat->save();

        // get redirect URL
        $redirect_url = redirectURL($request->b, route('admin.category'));
        return redirect(  $redirect_url )
                    ->with('success', 'Category Created Successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $cat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $category = Category::find($id);
        return view('admin.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($id, Request $request)
    {
        $request->validate([
            'category' => 'required|string|max:255',
            'displayorder' => 'required|integer|between:0,255',
            'status' => 'required'
        ]);

        $cat = Category::find($id);
        $cat->category = $request->category;
        $cat->status = $request->status;
        $cat->description = $request->description;
        $cat->displayorder = $request->displayorder;
        $cat->save();

        // get redirect URL
        $redirect_url = redirectURL($request->b, route('admin.category'));
        return redirect(  $redirect_url )
                    ->with('success', 'Category Updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id, Request $request)
    {
        $category = Category::find($id);
        $pagination = Category::paginate($id);
        if(isset($category->id) && $category->id != null ){
            $category->delete();
        }
        
        // get redirect URL
        $redirect_url = redirectURL($request->b, route('admin.category'));
        return redirect(  $redirect_url )
                    ->with('success', 'Category Deleted Successfully.');
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
            DB::table('categories')->where('id', $id)->update(['displayorder' => $order]);
        }

        return redirect()->back()->with('success', 'Display order(s) updated successfully.');
    }
}
