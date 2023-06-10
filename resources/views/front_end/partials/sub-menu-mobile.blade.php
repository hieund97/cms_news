@if( $menu['child'])
<ul class="dropdown-menu sub-menu-child">
    <li class="dropdown-item btn-clone-submenu-mobile" href="#">
        <i class="fas fa-angle-left mr-2"></i>Quay lai
    </li>
    @foreach( $menu['child'] as $level1 )
    <li class="dropdown-item" href="#">
        <a class="nav-link @if( $level1['child'])btn-open-submenu-mobile @endif" href="{{ $level1['link'] }}">
             {{ $level1['label'] }}
             @if( $level1['child']) 
             <i class="ml-2 fas fa-angle-right"></i>
             @endif    
        </a>
        @include('front_end.partials.sub-menu-mobile',["menu"=>$level1])
    </li>
    @endforeach
</ul>
@endif