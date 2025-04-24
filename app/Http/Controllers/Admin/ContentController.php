<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Admin\Controller;
use App\Models\Admin\Content;
use App\Models\Admin\Category;
use App\Models\Admin\Menu;
use App\Models\Admin\SiteConfiguration;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;
use Illuminate\Validation\Rule;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class ContentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    { 
        $catid = $request->catid;
        $menuid = $request->menuid;
        $search = $request->search;
        $contentsection = $request->contentsection;
        
        $page= $request->page;

        $category =  Category::where('status', 'P')->orderby('category', 'asc')->pluck('category', 'id');
        
        //dd($catid, $menuid, $page);
         
        $contents = Content::orderBy('displayorder', 'asc');
        if ($catid) {
            $contents->where('category', $catid);
        }
        if ($menuid) {
            $contents->where('menu', $menuid);
        }
        if ($contentsection) {
            $contents->where('content_section', $contentsection);
        }
        if (!empty($search)) {
            $contents->where(function ($query) use ($search) {
                $query->where('title', 'like', '%' . $search . '%')
                      ->orWhere('short_description', 'like', '%' . $search . '%')
                      ->orWhere('description', 'like', '%' . $search . '%');
            });
        }
        
        $contents = $contents->paginate(10)->withQueryString(); // pagination - 10 default
        
        return view('admin.content.index', compact('contents', 'category', 'catid', 'menuid', 'page', 'search', 'contentsection'))
                    ->with('i', (request()->input('page', 1) - 1) * 10);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $category =  Category::where('status', 'P')->orderby('category', 'asc')->pluck('category', 'id');
        $classnames = SiteConfiguration::getContentStyleName(); // SiteConfiguration::getContentStyleName();
        $media = getMediaList($request->input('search'));

        $menu = DB::table('menus as menu')
                ->leftjoin('menus as parent_menu', 'parent_menu.id', '=', 'menu.parent_id')
                ->select('menu.*', 'parent_menu.name as parent_menu_name', 'parent_menu.title as parent_menu_title')
                ->orderby('menu.displayorder', 'asc')
                ->where('menu.status', 'P')
                ->get();

        return view('admin.content.create', compact('category', 'menu', 'classnames', 'media'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {   
        if (!Storage::disk('public')->exists('contentimages/')) {
            Storage::disk('public')->makeDirectory('contentimages/', 0777, true);
        }

        if (!Storage::disk('public')->exists('content_files/')) {
            Storage::disk('public')->makeDirectory('content_files/', 0777, true);
        }
        
        $messages = [
            'menu.gt' => 'Please select a valid menu option.',
            'menu.unique' => 'This menu has already been assigned. Please choose a different one.',
        ];
        
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'short_description' => 'max:550',
            'status' => 'required',
            'content_section' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:5000',
            'download_file' => 'file|mimes:pdf|max:12288', // 12mb
            'menu' => [
                'required',
                'numeric',
                'gt:0',
                Rule::unique('contents', 'menu'), // Assuming you want to ensure `menu` is unique in the `pages` table
            ],
        ], $messages);
        
        $image = $request->file('image');
        if (isset($image) && $request->file('image')->isValid()) {
            $fileid = time();
            $filename = time()."." .$request['image']->extension();

            $filesystem = Storage::disk('public');
            $path = $filesystem->putFileAs(
                'contentimages/', $request->file('image'), $filename
            ); 
        }

        $download_file = $request->file('download_file');
        if (isset($download_file) && $request->file('download_file')->isValid()) {
            $fileid = time();
            $download_filename = time()."." .$request['download_file']->extension();

            $filesystem = Storage::disk('public');
            $path = $filesystem->putFileAs(
                'content_files/', $request->file('download_file'), $download_filename
            ); 
        }

        $content = new Content;
        $content->title = $request->title;
        $content->category = $request->category;
        $content->menu = $request->menu;
        $content->short_description = $request->short_description;
        $content->description = $request->description;
        $content->displayorder = $request->displayorder;
        if(isset($filename) && $filename != '') $content->image = $filename;
        if(isset($download_filename) && $download_filename != '') $content->download_file = $download_filename;
        $content->download_file_title = $request->download_file_title;
        $content->featured = ($request->featured) ? $request->featured : 0;
        $content->content_section = $request->content_section;
        $content->status = $request->status;
        $content->classname = $request->classname;

        $content->save();
        
        // get redirect URL
        $redirect_url = redirectURL($request->b, route('admin.content'));
        return redirect(  $redirect_url )
                                ->with('success', 'Content Created Successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Content $cat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id, Request $request)
    {
        $media = getMediaList($request->input('search'));

        $content = Content::find($id);
        $category =  Category::where('status', 'P')->orderby('category', 'asc')->pluck('category', 'id');
        $classnames = SiteConfiguration::getContentStyleName(); // SiteConfiguration::getContentStyleName();

        $menu = DB::table('menus as menu')
                ->leftjoin('menus as parent_menu', 'parent_menu.id', '=', 'menu.parent_id')
                ->select('menu.*', 'parent_menu.name as parent_menu_name', 'parent_menu.title as parent_menu_title')
                ->orderby('menu.displayorder', 'asc')
                ->where('menu.status', 'P')
                ->get();
        return view('admin.content.edit', compact('content' , 'category', 'menu', 'classnames', 'media'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($id, Request $request)
    {
        if (!Storage::disk('public')->exists('contentimages/')) {
            Storage::disk('public')->makeDirectory('contentimages/', 0777, true);
        }
        if (!Storage::disk('public')->exists('content_files/')) {
            Storage::disk('public')->makeDirectory('content_files/', 0777, true);
        }

        $old_content = Content::find($id);
        $old_image = $old_content->image;
        $old_content_file = $old_content->download_file;

        $messages = [
            'menu.gt' => 'Please select a valid menu option.',
            'menu.unique' => 'This menu has already been assigned. Please choose a different one.',
        ];
        
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'short_description' => 'max:550',
            'status' => 'required',
            'content_section' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:5000',
            'download_file' => 'file|mimes:pdf|max:12288', // 12mb
            'menu' => [
                'required',
                'numeric',
                'gt:0',
                Rule::unique('contents', 'menu')->ignore($id ?? null),
            ],
        ], $messages);

        // image
        $image = $request->file('image');
        if (isset($image) && $request->file('image')->isValid()) {
            $fileid = time();
            $filename = time()."." .$request['image']->extension();

            $filesystem = Storage::disk('public');
            $path = $filesystem->putFileAs(
                'contentimages/', $request->file('image'), $filename
            );
        }

        $del_image = $request->del_image; 
        if ((isset($del_image) && $del_image != '') || (isset($image) && $request->file('image')->isValid()) ) {
            // delete old image
            if( Storage::disk('public')->exists('contentimages/'.$old_image) ){
                Storage::disk('public')->delete('contentimages/'.$old_image);
            }
        }

        // file 
        $download_file = $request->file('download_file');
        if (isset($download_file) && $request->file('download_file')->isValid()) {
            $fileid = time();
            $download_filename = time()."." .$request['download_file']->extension();

            $filesystem = Storage::disk('public');
            $path = $filesystem->putFileAs(
                'content_files/', $request->file('download_file'), $download_filename
            );
        }

        $del_file = $request->del_file; 
        if ((isset($del_file) && $del_file != '') || (isset($download_file) && $request->file('download_file')->isValid()) ) {
            // delete old file
            if( Storage::disk('public')->exists('content_files/'.$old_content_file) ){
                Storage::disk('public')->delete('content_files/'.$old_content_file);
            }
        }

        $content = Content::find($id);
        $content->title = $request->title;
        $content->category = $request->category;
        $content->menu = $request->menu;
        $content->short_description = $request->short_description;
        $content->description = $request->description;
        if(isset($filename) && $filename != '')  
            $content->image = $filename;
        if(isset($del_image) && $del_image != '')  
            $content->image = '';

        if(isset($download_filename) && $download_filename != '')  
            $content->download_file = $download_filename;
        if(isset($del_file) && $del_file != '')  
            $content->download_file = '';
        $content->download_file_title = $request->download_file_title;
        $content->displayorder = $request->displayorder;
        $content->featured = ($request->featured) ? $request->featured : 0;
        $content->status = $request->status;
        $content->content_section = $request->content_section;
        $content->classname = $request->classname;
        $content->save();
 
        // get redirect URL
        $redirect_url = redirectURL($request->b, route('admin.content'));
        return redirect(  $redirect_url )
                                ->with('success', 'Content Updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id, Request $request)
    {
        $content = Content::find($id);
        if(isset($content->id) && $content->id != null ){

            if (isset($content->image) && $content->image != '') {
                // delete image
                if( Storage::disk('public')->exists('contentimages/'.$content->image) ){
                    Storage::disk('public')->delete('contentimages/'.$content->image);
                }
            }

            if (isset($content->download_file) && $content->download_file != '') {
                // delete file
                if( Storage::disk('public')->exists('content_files/'.$content->download_file) ){
                    Storage::disk('public')->delete('content_files/'.$content->download_file);
                }
            }

            $content->delete();

            // get redirect URL
            $redirect_url = redirectURL($request->b, route('admin.content'));
            return redirect(  $redirect_url )
                ->with('success', 'Content Deleted Successfully.');
        }
        return redirect()->route('admin.content');
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
            DB::table('contents')->where('id', $id)->update(['displayorder' => $order]);
        }

        return redirect()->back()->with('success', 'Display order(s) updated successfully.');
    }
}
