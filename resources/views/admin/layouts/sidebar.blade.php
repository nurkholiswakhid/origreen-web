@foreach(config('admin-menu') as $menu)
<a href="{{ route($menu['route']) }}"
   class="flex items-center px-4 py-3 text-gray-700 hover:bg-primary hover:text-white rounded-lg {{ request()->routeIs($menu['route'].'*') ? 'bg-primary text-white' : '' }}">
    <i class="fas {{ $menu['icon'] }} w-5"></i>
    <span class="ml-3">{{ $menu['title'] }}</span>
</a>
@endforeach
