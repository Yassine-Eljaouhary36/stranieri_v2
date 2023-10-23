@foreach($items as $menu_item)
    <li class="@if(!$menu_item->children->isEmpty()) dropdown @endif">
        <a href="{{ url($menu_item->link()) }}" class="@if(!$menu_item->children->isEmpty()) dropdown-toggle @endif" data-toggle="dropdown" >{{ $menu_item->title }}</a>
        @if(!$menu_item->children->isEmpty())
            <ul class="dropdown-menu">
                @foreach ($menu_item->children as $children)
                    <li><a href="{{url($children->link()) }}">{{$children->title}}</a></li>
                @endforeach
            </ul>
        @endif
    </li>
@endforeach
