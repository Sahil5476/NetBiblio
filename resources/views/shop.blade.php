<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Shop - NetBiblio</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
   
   @include('layouts.header')

   <section class="heading">
      <h3>our shop</h3>
      <p> <a href="{{ route('home') }}">home</a> / shop </p>
   </section>

   <section class="products">

      <h1 class="title">latest products</h1>

      <div class="box-container">

         @if($products->count() > 0)
            @foreach($products as $product)
               <form action="{{ route('add.cart') }}" method="POST" class="box">
                  @csrf
                  
                  <a href="{{ url('view_page', $product->id) }}" class="fas fa-eye"></a>
                  
                  <div class="price">₹{{ $product->price }}/-</div>
                  
                  <img src="{{ asset('uploaded_img/' . $product->image) }}" alt="" class="image">
                  
                  <div class="name">{{ $product->name }}</div>
                  
                  <input type="number" name="product_quantity" value="1" min="1" class="qty">
                  
                  <input type="hidden" name="product_id" value="{{ $product->id }}">

                  <button type="submit" formaction="{{ route('add.wishlist') }}" class="option-btn">add to wishlist</button>
                  
                  <button type="submit" class="btn">add to cart</button>
               </form>
            @endforeach
         @else
            <p class="empty">no products added yet!</p>
         @endif

      </div>

   </section>

   @include('layouts.footer')

   <script src="{{ asset('js/script.js') }}"></script>

</body>
</html>