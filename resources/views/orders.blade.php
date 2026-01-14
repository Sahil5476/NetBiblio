<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Orders - NetBiblio</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
   
   @include('layouts.header')

   <section class="heading">
      <h3>your orders</h3>
      <p> <a href="{{ route('home') }}">home</a> / order </p>
   </section>

   <section class="placed-orders">

      <h1 class="title">placed orders</h1>

      <div class="box-container">

      @if($orders->count() > 0)
         @foreach($orders as $order)
            <div class="box">
               <p> placed on : <span>{{ $order->placed_on }}</span> </p>
               <p> name : <span>{{ $order->name }}</span> </p>
               <p> number : <span>{{ $order->number }}</span> </p>
               <p> email : <span>{{ $order->email }}</span> </p>
               <p> address : <span>{{ $order->address }}</span> </p>
               <p> payment method : <span>{{ $order->method }}</span> </p>
               <p> your orders : <span>{{ $order->total_products }}</span> </p>
               <p> total price : <span>₹{{ $order->total_price }}/-</span> </p>
               <p> payment status : 
                  <span style="color:{{ $order->payment_status == 'pending' ? 'tomato' : 'green' }};">
                     {{ $order->payment_status }}
                  </span> 
               </p>
            </div>
         @endforeach
      @else
         <p class="empty">no orders placed yet!</p>
      @endif

      </div>

   </section>

   @include('layouts.footer')

   <script src="{{ asset('js/script.js') }}"></script>

</body>
</html>