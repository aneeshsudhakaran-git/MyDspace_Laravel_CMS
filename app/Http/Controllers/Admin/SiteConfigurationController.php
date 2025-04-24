<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\SiteConfiguration;
use Illuminate\Http\Request;

class SiteConfigurationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->search;

        $siteconfig = SiteConfiguration::orderBy('config_title', 'asc');

        if (!empty($search)) {
            $siteconfig->where(function ($query) use ($search) {
                $query->where('config_title', 'like', '%' . $search . '%')
                      ->orWhere('config_value', 'like', '%' . $search . '%');
            });
        }
        $siteconfig = $siteconfig->latest()->paginate(10);
        
        return view('admin.site_configuration.index', compact('siteconfig', 'search'))
                    ->with('i', (request()->input('page', 1) - 1) * 10);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(SiteConfiguration $siteConfiguration)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $config = SiteConfiguration::find($id);

        if (!$config) {
            return redirect()->route('admin.siteconfiguration')->with('error', 'Configuration not found.');
        }

        return view('admin.site_configuration.edit', compact('config'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($id, Request $request)
    {
        $request->validate([
            'config_title' => 'required|string|max:255'
        ]);

        //dd($request);

        $config = SiteConfiguration::find($id);
        $config->config_title = $request->config_title;
        $config->config_value = $request->config_value;
        $config->save();
        
        // get redirect URL
        $redirect_url = redirectURL($request->b, route('admin.siteconfiguration'));
        return redirect(  $redirect_url )
                         ->with('success', 'Site Configuration Updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SiteConfiguration $siteConfiguration)
    {
        //
    }
}
