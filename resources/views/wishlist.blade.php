<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Wishlist - NetBiblio</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
   
   @include('layouts.header')

   <section class="heading">
      <h3>your wishlist</h3>
      <p> <a href="{{ route('home') }}">home</a> / wishlist </p>
   </section>

   <section class="wishlist">

      <h1 class="title">products added</h1>

      <div class="box-container">

      @if($wishlistItems->count() > 0)
         @foreach($wishlistItems as $item)
            <form action="{{ route('add.cart') }}" method="POST" class="box">
               @csrf

               <a href="{{ route('wishlist.delete', $item->id) }}" class="fas fa-times" onclick="return confirm('delete this from wishlist?');"></a>
               
               <a href="{{ url('view_page', $item->product_id) }}" class="fas fa-eye"></a>
               
               <img src="{{ asset('uploaded_img/' . $item->image) }}" alt="" class="image">
               
               <div class="name">{{ $item->name }}</div>
               <div class="price">₹{{ $item->price }}/-</div>

               <input type="hidden" name="product_id" value="{{ $item->product_id }}">
               <input type="hidden" name="product_quantity" value="1">
               
               <input type="submit" value="add to cart" class="btn">
            </form>
         @endforeach
      @else
         <p class="empty">your wishlist is empty</p>
      @endif

      </div>

      <div class="wishlist-total">
         <p>grand total : <span>₹{{ $grandTotal }}/-</span></p>
         <a href="{{ route('shop') }}" class="option-btn">continue shopping</a>
         
         <a href="{{ route('wishlist.delete.all') }}" class="delete-btn {{ ($grandTotal > 0)?'':'disabled' }}" onclick="return confirm('delete all from wishlist?');">delete all</a>
      </div>

   </section>

   @include('layouts.footer')

   <script src="{{ asset('js/script.js') }}"></script>

</body>
</html>