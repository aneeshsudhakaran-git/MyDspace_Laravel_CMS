<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\SiteEnquiry;
use App\Models\Admin\SiteConfiguration;

use Illuminate\Http\Request;

class SiteEnquiryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    { 
        
        $page= $request->page;
        $subject= $request->subject;
        $status= $request->status;
        $search = $request->search;

        $enquiry = SiteEnquiry::latest();

        if ($status > 0) {
            $enquiry->where('status', $status);
        }
        if (!empty($search)) {
            $enquiry->where(function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%')
                ->orWhere('email', 'like', '%' . $search . '%')
                ->orWhere('description', 'like', '%' . $search . '%');
            });
        }
        
        $enquiry = $enquiry->paginate(10)->withQueryString();
        
        return view('admin.site_enquiry.index', compact('enquiry', 'status', 'page', 'search'))
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
    public function show(SiteEnquiry $siteEnquiry)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $enq = SiteEnquiry::find($id);

        if($enq->status == 'U'){
            $enq->status = 'R';
            $enq->save();
        }
        return view('admin.site_enquiry.edit', compact('enq'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SiteEnquiry $siteEnquiry)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id, Request $request)
    {
        $SiteEnquiry = SiteEnquiry::find($id);

        if(isset($SiteEnquiry->id) && $SiteEnquiry->id != null ){
            $SiteEnquiry->delete();
            
            // get redirect URL
            $redirect_url = redirectURL($request->b, route('admin.site_enquiry'));
            return redirect($redirect_url)
                         ->with('success', 'Site Enquiry Deleted Successfully.');
        }
        return redirect()->route('admin.site_enquiry');
    }
}
