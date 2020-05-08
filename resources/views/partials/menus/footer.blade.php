<ul class="ftco-footer-social list-unstyled float-md-left float-lft mt-5">
    @foreach($items as $menu_item)
        <li class="ftco-animate"><a href="{{ $menu_item->link() }}"><span class="{{ $menu_item->title }}"></span></a></li>
    @endforeach
</ul>