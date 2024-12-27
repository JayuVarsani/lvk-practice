<div class="menu menu-column menu-rounded menu-sub-indention fw-semibold fs-6"
     id="kt_app_sidebar_menu"
     data-kt-menu="true"
     data-kt-menu-expand="false">
    @foreach($modules as $module)

        @if($module['unique_name']=="admin.moderator"
            && Auth::user()->type!=="admin"
            )
            @continue;
        @endif

        @if(count($module['children']))
            <div data-kt-menu-trigger="click" @class([
    'menu-item',
    'menu-accordion',
    'show'=>in_array(request()->route()->getName(),$child->pluck('sub_routes')->flatten()->toArray())
    ])>
                <span class="menu-link">
                    <span class="menu-icon">{!! $module['icon'] !!}</span>
                    <span class="menu-title">{{ucwords($module['name'])}}</span>
                    <span class="menu-arrow"></span>
                </span>
                <div class="menu-sub menu-sub-accordion">
                    @foreach($module['children'] as $childModule)
                        <div class="menu-item">
                            <a @class(['menu-link','active'=>in_array(request()->route()->getName(),$childModule['sub_routes'])])
                               href="{{$childModule['index_route']?route($childModule['index_route']):"javascript:void()"}}">
                                <span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                                <span class="menu-title">{{$childModule['name']}}</span>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        @else
            <div class="menu-item">
                <a @class(['menu-link','active'=>in_array(request()->route()->getName(),$module['sub_routes']??[])])
                   href="{{$module['index_route']?route($module['index_route']):"javascript:void()"}}">
                    <span class="menu-icon">{!! $module['icon'] !!}</span>
                    <span class="menu-title">{{ucwords($module['name'])}}</span>
                </a>
            </div>
        @endif
    @endforeach
    <div class="menu-item">
        <a class="menu-link"
           href="javascript:void(0);"
           onclick="document.getElementById('logout-user').submit();">
                        <span class="menu-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                <path
                                    d="M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z"/>
                            </svg>
                        </span>
            <span class="menu-title">Logout</span>
        </a>
    </div>
</div>

