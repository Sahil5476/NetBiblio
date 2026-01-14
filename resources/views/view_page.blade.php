<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Quick View - NetBiblio</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
   
   @include('layouts.header')

   <section class="quick-view">

      <h1 class="title">product details</h1>

      @if($product)
         <form action="{{ route('add.cart') }}" method="POST">
            @csrf
            
            <img src="{{ asset('uploaded_img/' . $product->image) }}" alt="" class="image">
            
            <div class="name">{{ $product->name }}</div>
            <div class="price">₹{{ $product->price }}/-</div>
            
            <div class="details">{{ $product->details }}</div>
            
            <input type="number" name="product_quantity" value="1" min="1" class="qty">
            
            <input type="hidden" name="product_id" value="{{ $product->id }}">
            
            <button type="submit" formaction="{{ route('add.wishlist') }}" class="option-btn">add to wishlist</button>
            <button type="submit" class="btn">add to cart</button>

         </form>
      @else
         <p class="empty">no products details available!</p>
      @endif

      <div class="more-btn">
         <a href="{{ route('home') }}" class="option-btn">go to home page</a>
      </div>

   </section>

   @include('layouts.footer')

   <script src="{{ asset('js/script.js') }}"></script>

</body>
</html>