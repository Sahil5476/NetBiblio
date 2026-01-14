<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Admin Orders</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link rel="stylesheet" href="{{ asset('css/admin_style.css') }}">
</head>
<body>
   
   @include('layouts.admin_header')

   <section class="placed-orders">

      <h1 class="title">placed orders</h1>

      <div class="box-container">

         @if($orders->count() > 0)
            @foreach($orders as $order)
               <div class="box">
                  <p> user id : <span>{{ $order->user_id }}</span> </p>
                  <p> placed on : <span>{{ $order->placed_on }}</span> </p>
                  <p> name : <span>{{ $order->name }}</span> </p>
                  <p> number : <span>{{ $order->number }}</span> </p>
                  <p> email : <span>{{ $order->email }}</span> </p>
                  <p> address : <span>{{ $order->address }}</span> </p>
                  <p> total products : <span>{{ $order->total_products }}</span> </p>
                  <p> total price : <span>₹{{ $order->total_price }}/-</span> </p>
                  <p> payment method : <span>{{ $order->method }}</span> </p>
                  
                  <form action="{{ route('admin.orders.update') }}" method="post">
                     @csrf
                     <input type="hidden" name="order_id" value="{{ $order->id }}">
                     
                     <select name="update_payment">
                        <option disabled selected>{{ $order->payment_status }}</option>
                        <option value="pending">pending</option>
                        <option value="completed">completed</option>
                     </select>
                     
                     <input type="submit" name="update_order" value="update" class="option-btn">
                     <a href="{{ route('admin.orders.delete', $order->id) }}" class="delete-btn" onclick="return confirm('delete this order?');">delete</a>
                  </form>
               </div>
            @endforeach
         @else
            <p class="empty">no orders placed yet!</p>
         @endif

      </div>

   </section>

   <script src="{{ asset('js/admin_script.js') }}"></script>

</body>
</html>