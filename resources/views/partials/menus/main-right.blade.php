<ul class="navbar-nav ml-auto">
    @guest
    <li class="nav-item"><a href="{{ route('register') }}" class="nav-link">Sign Up</a></li>
    <li class="nav-item"><a href="{{ route('login') }}" class="nav-link">Login</a></li>
    @else
    <li class="nav-item">
    <a class="nav-link" href="{{ route('logout') }}"
        onclick="event.preventDefault();
        document.getElementById('logout-form').submit();">
        {{ __('Logout') }}
    </a>
    </li>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
    @endguest
    <li class="nav-item cta cta-colored"><a href="{{ route('cart.index') }}" class="nav-link">Cart
    @if (Cart::instance('default')->count() > 0)
    <span class="icon-shopping_cart">[{{ Cart::instance('default')->count() }}]</span>
    @endif
    <li class="nav-item cta cta-colored"><a href="{{ route('wishlist.index') }}" class="nav-link">Wishlist
    </a>
    </li>
</ul>