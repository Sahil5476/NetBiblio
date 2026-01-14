<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Checkout - NetBiblio</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
   
   @include('layouts.header')

   <section class="heading">
      <h3>checkout order</h3>
      <p> <a href="{{ route('home') }}">home</a> / checkout </p>
   </section>

   <section class="display-order">
      @if($cartItems->count() > 0)
         @foreach($cartItems as $item)
            <p> {{ $item->name }} <span>(₹{{ $item->price }}/- x {{ $item->quantity }})</span> </p>
         @endforeach
      @else
         <p class="empty">your cart is empty</p>
      @endif
      <div class="grand-total">grand total : <span>₹{{ $grand_total }}/-</span></div>
   </section>

   <section class="checkout">

      <form action="{{ route('place.order') }}" method="POST">
         @csrf
         <h3>place your order</h3>

         <div class="flex">
            <div class="inputBox">
               <span>your name :</span>
               <input type="text" name="name" value="{{ Auth::user()->name }}" placeholder="enter your name" required>
            </div>
            <div class="inputBox">
               <span>your number :</span>
               <input type="number" name="number" min="0" placeholder="enter your number" required>
            </div>
            <div class="inputBox">
               <span>your email :</span>
               <input type="email" name="email" value="{{ Auth::user()->email }}" placeholder="enter your email" required>
            </div>
            <div class="inputBox">
               <span>payment method :</span>
               <select name="method">
                  <option value="cash on delivery">cash on delivery</option>
                  <option value="credit card">credit card</option>
                  <option value="paypal">paypal</option>
                  <option value="paytm">paytm</option>
               </select>
            </div>
            <div class="inputBox">
               <span>address line 01 :</span>
               <input type="text" name="flat" placeholder="e.g. flat no." required>
            </div>
            <div class="inputBox">
               <span>address line 02 :</span>
               <input type="text" name="street" placeholder="e.g. street name" required>
            </div>
            <div class="inputBox">
               <span>city :</span>
               <input type="text" name="city" placeholder="e.g. mumbai" required>
            </div>
            <div class="inputBox">
               <span>state :</span>
               <input type="text" name="state" placeholder="e.g. maharashtra" required>
            </div>
            <div class="inputBox">
               <span>country :</span>
               <input type="text" name="country" placeholder="e.g. india" required>
            </div>
            <div class="inputBox">
               <span>pin code :</span>
               <input type="number" min="0" name="pin_code" placeholder="e.g. 123456" required>
            </div>
         </div>

         <input type="submit" name="order" value="order now" class="btn">

      </form>

   </section>

   @include('layouts.footer')

   <script src="{{ asset('js/script.js') }}"></script>

</body>
</html>