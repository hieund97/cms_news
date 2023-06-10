@if( $menu['child'])
<ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu">
    @foreach( $menu['child'] as $level1 )
    <li class="@if( $level1['child']) dropdown-submenu @endif">
        <a class="dropdown-item d-block position-relative" href="{{ $level1['link'] }}">
            {{ $level1['label'] }} @if($level1['child']) <i class="fas fa-angle-right position-absolute" style="right: 5px"></i> @endif
        </a>
        @include('front_end.partials.sub-menu-pc',["menu"=>$level1])
    </li>
    @endforeach
</ul>
@endif
