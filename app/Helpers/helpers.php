<?php

if (!function_exists('getMenuOptions')) {
    function getMenuOptions($parentId = 0, $prefix = '', $selectedId='') {
        $menus = DB::table('menus as m')
                ->select('m.*')
                ->where('parent_id', $parentId)
                ->where('status', 'P')
                ->orderByRaw('title asc' )
                ->get();
        
        $html = '';

        foreach ($menus as $menu) {
            $html .= "<option value='{$menu->id}' " . ($selectedId == $menu->id ? "selected" : "") . " >{$prefix}{$menu->title}</option>";
            $html .= getMenuOptions($menu->id, $prefix . '&nbsp;&nbsp; |__ ', $selectedId);
        }
        return $html;
    }
}

if (!function_exists('getContentMenuOptions')) {
    function getContentMenuOptions($parentId = 0, $prefix = '', $selectedId = '', $menus = null, $menuChildren = []) {
        // Fetch all menus only once (if not already provided)
        if ($menus === null) {
            $menus = DB::table('menus')
                ->select('id', 'title', 'parent_id')
                ->where('status', 'P')
                ->orderBy('title', 'asc')
                ->get();
            
            // Build an array to check which menus have children
            $menuChildren = [];
            foreach ($menus as $menu) {
                $menuChildren[$menu->parent_id][] = $menu->id;
            }
        }

        $html = '';

        // Get menus for the current parentId
        if (isset($menuChildren[$parentId])) {
            foreach ($menuChildren[$parentId] as $menuId) {
                // Find the menu object
                $menu = $menus->firstWhere('id', $menuId);

                // Check if this menu has children
                $hasChildren = isset($menuChildren[$menu->id]);

                // Disable option if it has children
                $disabled = $hasChildren ? 'disabled' : '';

                // Generate the option
                $html .= "<option value='{$menu->id}' " . ($selectedId == $menu->id ? "selected" : "") . ">{$prefix}{$menu->title}</option>";

                // Recursively call for submenus
                $html .= getMenuOptions($menu->id, $prefix . '&nbsp;&nbsp; |__ ', $selectedId, $menus, $menuChildren);
            }
        }

        return $html;
    }
}

if (!function_exists('redirectURL')) {
    function redirectURL($request_b, $route)
    {
        if(isset($request_b) && $request_b != '' ){
            $redirect_url = base64_decode($request_b);
        } else {
            $redirect_url = $route;
        }

        return $redirect_url;
    }
}


if (!function_exists('loadSiteMainMenus')) {
    function loadSiteMainMenus($parentId = 0, $allMenus = null)
    {
        // Fetch all menus only once
        if ($allMenus === null) {
            $allMenus = DB::table('menus as m')
                ->select('m.*')
                ->where('m.status', 'P')
                ->orderByRaw('m.displayorder asc')
                ->get()
                ->groupBy('parent_id'); // Group by parent_id for easy lookup
        }

        // Get menus for the current parentId
        $menus = $allMenus[$parentId] ?? collect(); // Default to empty collection if no children exist
        $menuList = [];
        foreach ($menus as $menu) {
            // Check if this menu has children
            $menu->children = loadSiteMainMenus($menu->id, $allMenus);

            // Add menu to the list
            $menuList[] = $menu;
        }
        return $menuList;
    }
}

if (!function_exists('loadMainMenuStyleName')) {
    function loadMainMenuStyleName() {
        $configval =  DB::table('site_configurations')->where('config_name', 'Site_Menu_Style_Name')->first();
        $Site_Menu_Style_Name = json_decode(trim($configval->config_value), true);
        return $Site_Menu_Style_Name;
    }
}

//loadContentStyleName
if (!function_exists('loadContentStyleName')) {
    function loadContentStyleName() {
        $configval =  DB::table('site_configurations')->where('config_name', 'Site_Content_Style_Name')->first();
        $Site_Content_Style_Name = json_decode(trim($configval->config_value), true);
        return $Site_Content_Style_Name;
    }
}

if (!function_exists('loadSiteConfiguration')) {
    function loadSiteConfiguration($config_name)
    {
        $configval =  DB::table('site_configurations as sc')->where('sc.config_name', '=', $config_name)->get();
        return $configval[0];
    }
}

if (!function_exists('getSiteConfiguration')) {
    function getSiteConfiguration()
    {
        $configval =  DB::table('site_configurations as sc')->get();
        return $configval;
    }
}



use App\Models\Admin\MediaManager;
if (!function_exists('getMediaList')) {
    function getMediaList($search = null, $paginate = 12)
    {
        $query = MediaManager::query();

        if ($search) {
            $query->where('tag', 'like', "%{$search}%");
        }

        return $query->orderBy('file_path', 'asc')->latest()->paginate($paginate);
    }
}
