@if(session('message'))
   @foreach(session('message') as $msg)
      <div class="message">
         <span>{{ $msg }}</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
   @endforeach
@endif

<header class="header">

   <div class="flex">

      <a href="{{ route('admin.page') }}" class="logo">Admin<span>Panel</span></a>

      <nav class="navbar">
         <a href="{{ route('admin.page') }}">home</a>
         <a href="{{ route('admin.products') }}">products</a>
         <a href="{{ route('admin.orders') }}">orders</a>
         <a href="{{ route('admin.users') }}">users</a>
         <a href="{{ route('admin.messages') }}">messages</a>
      </nav>

      <div class="icons">
         <div id="menu-btn" class="fas fa-bars"></div>
         <div id="user-btn" class="fas fa-user"></div>
      </div>

      <div class="account-box">
         <p>username : <span>{{ Auth::user()->name }}</span></p>
         <p>email : <span>{{ Auth::user()->email }}</span></p>
         
         <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="delete-btn">logout</button>
         </form>
         
         <div>new <a href="{{ route('login') }}">login</a> | <a href="{{ route('register') }}">register</a> </div>
      </div>

   </div>

</header>