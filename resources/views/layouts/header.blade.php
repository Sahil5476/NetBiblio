@if(session('message'))
   @foreach(session('message') as $msg)
      <div class="message">
         <span>{{ $msg }}</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
   @endforeach
@endif

@if(session('success'))
   <div class="message">
      <span>{{ session('success') }}</span>
      <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
   </div>
@endif  <header class="header" style="position: relative; z-index: 1000;">

   <div class="flex">

      <a href="{{ route('home') }}" class="logo" style="position: relative;">
         <img src="{{ asset('images/logo.png') }}" alt="NetBiblio" 
              style="height: 120px; position: absolute; top: -60px; left: 0;">
      </a>

      <nav class="navbar" style="margin-left: 130px;">
         <ul>
            <li><a href="{{ route('home') }}">home</a></li>
            <li><a href="#">pages +</a>
               <ul>
                  <li><a href="{{ route('about') }}">about</a></li>
                  <li><a href="{{ route('contact') }}">contact</a></li>
               </ul>
            </li>
            <li><a href="{{ route('shop') }}">shop</a></li>
            <li><a href="{{ url('orders') }}">orders</a></li>
            <li><a href="#">account +</a>
               <ul>
                  <li><a href="{{ route('login') }}">login</a></li>
                  <li><a href="{{ route('register') }}">register</a></li>
               </ul>
            </li>
         </ul>
      </nav>

      <div class="icons">
         <div id="menu-btn" class="fas fa-bars"></div>
         <a href="{{ url('search') }}" class="fas fa-search"></a>
         <div id="user-btn" class="fas fa-user"></div>

         @php
            $wishlist_count = 0;
            $cart_count = 0;
            if(Auth::check()){
               $wishlist_count = \App\Models\Wishlist::where('user_id', Auth::id())->count();
               $cart_count = \App\Models\Cart::where('user_id', Auth::id())->count();
            }
         @endphp

         <a href="{{ url('wishlist') }}"><i class="fas fa-heart"></i><span>({{ $wishlist_count }})</span></a>
         <a href="{{ url('cart') }}"><i class="fas fa-shopping-cart"></i><span>({{ $cart_count }})</span></a>
      </div>

      <div class="account-box">
         @auth
            <p>username : <span>{{ Auth::user()->name }}</span></p>
            <p>email : <span>{{ Auth::user()->email }}</span></p>
            <form action="{{ route('logout') }}" method="POST">
               @csrf
               <button type="submit" class="delete-btn">logout</button>
            </form>
         @else
            <p>Please login first</p>
            <a href="{{ route('login') }}" class="btn">Login</a>
         @endauth
      </div>
   </div>
</header>