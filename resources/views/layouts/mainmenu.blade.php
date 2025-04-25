<nav id="navmenu" class="navmenu">
    <ul>
        @forelse ($menulist as $menu)
            @php
                if ($menu->link_type == 'S') {
                    $linkurl = url('/') . '#' . $menu->name;
                    $link_target = '_self';
                } elseif ($menu->link_type == 'N') {
                    $linkurl = route('page.showpage', ['page_id' => $menu->name]);
                    $link_target = '_self';
                } elseif ($menu->link_type == 'T') {
                    $linkurl = route('page.showpage', ['page_id' => $menu->name]);
                    $link_target = '_blank';
                } else {
                    $linkurl = url('/');
                     $link_target = '_self';
                }
            @endphp

            @if($menu->menutype == 1 && !$menu->classname)

                <li>
                    <a class="{{ $menu->name == 'Home' ? 'active' : '' }}" href="{{ $linkurl }}"  >{{ $menu->title }}</a> 
                </li>
            @endif

            @if (isset($menu->children) && !empty($menu->children))
                @if($menu->menutype == 1 && isset($Site_Menu_Style_Name[$menu->classname]) && $Site_Menu_Style_Name[$menu->classname] == 'dropdown')
                    <li class="dropdown">
                        <a class="" href="{{ $linkurl }}"  >
                            <span>{{ $menu->title }}</span><i class="bi bi-chevron-down toggle-dropdown"></i>
                        </a>
                        <ul>
                            @foreach ($menu->children as $children)
                                @php
                                    if ($children->link_type == 'S') {
                                        $c_linkurl = url('/') . '#' . $children->name;
                                        $c_link_target = '_self';
                                    } elseif ($children->link_type == 'N') {
                                        $c_linkurl = route('page.showpage', ['page_id' => $children->name]);
                                        $c_link_target = '_self';
                                    } elseif ($children->link_type == 'T') {
                                        $c_linkurl = route('page.showpage', ['page_id' => $children->name]);
                                        $c_link_target = '_blank';
                                    } else {
                                        $c_linkurl = url('/');
                                        $c_link_target = '_self';
                                    }
                                @endphp
                                
                                <li>
                                    <a class="" href="{{ $c_linkurl }}" target="{{ $c_link_target }}">{{ $children->title }}</a>
                                </li>
                                
                            @endforeach
                        </ul>
                    </li>
                @endif
            @endif
        @empty
            <li class="nav-item">
                There are no data.
            </li>
        @endforelse
    </ul>
    <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
</nav>

@foreach ($menulist as $menu)
    @if($menu->classname && isset($Site_Menu_Style_Name[$menu->classname])  && $Site_Menu_Style_Name[$menu->classname] != 'dropdown')
        @php
            if ($menu->link_type == 'S') {
                $linkurl = url('/') . '#' . $menu->name;
                $link_target = '_self';
            } elseif ($menu->link_type == 'N') {
                $linkurl = route('page.showpage', ['page_id' => $menu->name]);
                $link_target = '_self';
            } elseif ($menu->link_type == 'T') {
                $linkurl = route('page.showpage', ['page_id' => $menu->name]);
                $link_target = '_blank';
            } else {
                $linkurl = url('/');
                    $link_target = '_self';
            }
        @endphp
    
        <a class="{{ $Site_Menu_Style_Name[$menu->classname] }} ms-3 mainmenu_btns" href="{{ $linkurl }}" target="{{ $link_target }}">{{ $menu->title }}</a> 
    @endif
@endforeach
