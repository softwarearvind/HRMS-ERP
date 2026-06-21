<ul>

@php
$menus = \App\Models\Menu::where('role', auth()->user()->getRoleNames()->first())
        ->orderBy('sort_order')
        ->get();
@endphp

@foreach($menus as $menu)
    <li>
        <a href="{{ $menu->route }}">
            <i class="{{ $menu->icon }}"></i>
            {{ $menu->name }}
        </a>
    </li>
@endforeach

</ul>
