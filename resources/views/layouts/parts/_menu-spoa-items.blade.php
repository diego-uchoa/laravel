 @foreach($items as $item)

  @if($item->hasChildren())  
    <li class="">
      <a class="dropdown-toggle" href="#">
  
  @else
    <li class="">
      <a href="{!! $item->url() !!}">
        
  @endif

  @if($item->icon)
  <i class="{!! $item->icon!!}"></i>
  @else
  <i class="menu-icon fa fa-caret-right"></i>
  @endif

  <span class="menu-text">{!! $item->title !!}</span>

  @if($item->hasChildren())
  <b class="arrow fa fa-angle-down"></b>
  @endif

</a>

<b class="arrow"></b>

@if($item->hasChildren())
<ul class="submenu">
  @include('layouts.parts._menu-spoa-items', array('items' => $item->children()))
</ul>     
@endif

</li>

@endforeach