<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;


use App\Models\Admin\SiteConfiguration;
use App\Models\Admin\SiteEnquiry;


use Illuminate\Support\Facades\View as ViewFacade;


class SitePageController extends Controller
{
    /**
     * Display the home page.
     */
    public function index(Request $request): View
    {
        ViewFacade::share('pageTitle', 'Home');
        
        $site_page = DB::table('menus as m')
                        ->leftJoin('contents as c', 'm.id', '=', 'c.menu')
                        ->select('c.*','m.id as menu_id', 'm.name as menu_name', 'm.title as menu_title', 'm.classname as menu_classname', 'm.menutype as menutype', 'm.link_type as m_link_type')
                        ->where('m.status', 'P')
                        ->where('c.status', 'P')
                        ->orderByRaw('m.displayorder asc, c.displayorder asc')
                        ->get();
        //dd($site_page);

        $og_details = $site_page->toArray();
        $og_title = (isset($og_details[0]) && $og_details[0] != '') ?  $og_details[0]->title : '';
        $og_description = (isset($og_details[0]) && $og_details[0] != '') ? strip_tags( $og_details[0]->short_description) : ''; // short_description
        $og_image = (isset($og_details[0]) && $og_details[0] != '') ? asset('storage/contentimages/'.$og_details[0]->image) : '';
        $og_url = url()->current();
        //  dd($og_image);

        return view('sitepages.home', compact(
            'site_page', 'og_title', 'og_description', 'og_image', 'og_url'
        ));
    }

    /**
     * Display the content page.
     */
    public function showpage(Request $request): View
    {
        $page_id = $request->page_id;

        $sitepages = DB::table('contents as c')
                    ->leftJoin('menus as m', 'c.menu', '=', 'm.id')
                    ->select('c.*', 'm.id as m_id', 'm.name as m_name', 'm.title as m_title', 'm.classname as m_classname', 'm.menutype as m_menutype', 'm.link_type as m_link_type')
                    ->where('m.name', $page_id)
                    ->where('m.status', 'P')
                    ->where('c.status', 'P')
                    ->orderByRaw('c.displayorder asc' )
                    ->get();

        $footer_sitepages = DB::table('contents as c')
                    ->leftJoin('menus as m', 'c.menu', '=', 'm.id')
                    ->select('c.*', 'm.id as m_id', 'm.name as m_name', 'm.title as m_title', 'm.classname as m_classname', 'm.menutype as m_menutype', 'm.link_type as m_link_type')
                    ->where('m.menutype', '2') // m_menutype == 2
                    ->where('m.status', 'P')
                    ->where('c.status', 'P')
                    ->orderByRaw('c.displayorder asc' )
                    ->get();

        //dd($sitepages);

        $og_details = $sitepages->toArray();
        $og_title = (isset($og_details[0]) && $og_details[0] != '') ? strip_tags( $og_details[0]->title) : '';
        $og_description = (isset($og_details[0]) && $og_details[0] != '') ? strip_tags( $og_details[0]->short_description) : ''; // short_description
        $og_image = (isset($og_details[0]) && $og_details[0] != '') ? asset('storage/contentimages/'.$og_details[0]->image) : '';
        $og_url = url()->current();

        ViewFacade::share('pageTitle', $og_title);

        return view('sitepages.showpage', compact(
            'sitepages', 'footer_sitepages', 'og_title', 'og_description', 'og_image', 'og_url'
        ));
    }
    
    // saveContact
    public function saveContact(Request $request)
    {
        $request->validate([
            'cname' => 'required|string|max:255',
            'cemail' => 'required|email|max:255',
            'cphone' => 'required|digits_between:7,15',
            'csubject' => 'required|string|max:255',
            'cdescription' => 'required|string|max:500',
        ]);

        SiteEnquiry::create([
            'name' => $request->cname,
            'email' => $request->cemail,
            'phone' => $request->cphone,
            'subject' => $request->csubject,
            'description' => $request->cdescription,
            'status' => 'U',
        ]);

        return response()->json(['success' => true, 'message' => 'Thanks for contacting us!']);
    }

}
