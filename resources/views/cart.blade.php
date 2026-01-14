<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Shopping Cart - NetBiblio</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
   
   @include('layouts.header')

   <section class="heading">
      <h3>shopping cart</h3>
      <p> <a href="{{ route('home') }}">home</a> / cart </p>
   </section>

   <section class="shopping-cart">

      <h1 class="title">products added</h1>

      <div class="box-container">

      @php $grand_total = 0; @endphp

      @if($cartItems->count() > 0)
         @foreach($cartItems as $item)
            <div class="box">
               <a href="{{ route('cart.delete', $item->id) }}" class="fas fa-times" onclick="return confirm('delete this from cart?');"></a>
               
               <a href="{{ route('view_page', $item->product_id) }}" class="fas fa-eye"></a>
               
               <img src="{{ asset('uploaded_img/' . $item->image) }}" alt="" class="image">
               
               <div class="name">{{ $item->name }}</div>
               <div class="price">₹{{ $item->price }}/-</div>

               <form action="{{ route('cart.update') }}" method="post">
                  @csrf
                  <input type="hidden" value="{{ $item->id }}" name="cart_id">
                  <input type="number" min="1" value="{{ $item->quantity }}" name="cart_quantity" class="qty">
                  <input type="submit" value="update" class="option-btn" name="update_quantity">
               </form>

               @php $sub_total = ($item->price * $item->quantity); @endphp
               <div class="sub-total"> sub-total : <span>₹{{ $sub_total }}/-</span> </div>
            </div>
            
            @php $grand_total += $sub_total; @endphp
         @endforeach
      @else
         <p class="empty">your cart is empty</p>
      @endif

      </div>

      <div class="more-btn">
         <a href="{{ route('cart.delete.all') }}" class="delete-btn {{ ($grand_total > 0)?'':'disabled' }}" onclick="return confirm('delete all from cart?');">delete all</a>
      </div>

      <div class="cart-total">
         <p>grand total : <span>₹{{ $grand_total }}/-</span></p>
         <a href="{{ route('shop') }}" class="option-btn">continue shopping</a>
         <a href="{{ route('checkout') }}" class="btn {{ ($grand_total > 0)?'':'disabled' }}">proceed to checkout</a>
      </div>

   </section>

   @include('layouts.footer')

   <script src="{{ asset('js/script.js') }}"></script>

</body>
</html>