<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Admin Products</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link rel="stylesheet" href="{{ asset('css/admin_style.css') }}">
</head>
<body>
   
   @include('layouts.admin_header')

   <section class="add-products">

      <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
         @csrf
         <h3>add new product</h3>
         <input type="text" class="box" required placeholder="enter product name" name="name">
         <input type="number" min="0" class="box" required placeholder="enter product price" name="price">
         <textarea name="details" class="box" required placeholder="enter product details" cols="30" rows="10"></textarea>
         <input type="file" accept="image/jpg, image/jpeg, image/png" required class="box" name="image">
         <input type="submit" value="add product" name="add_product" class="btn">
      </form>

   </section>

   <section class="show-products">

      <div class="box-container">

         @if($products->count() > 0)
            @foreach($products as $product)
               <div class="box">
                  <div class="price">₹{{ $product->price }}/-</div>
                  <img class="image" src="{{ asset('uploaded_img/' . $product->image) }}" alt="">
                  <div class="name">{{ $product->name }}</div>
                  <div class="details">{{ $product->details }}</div>
                  
                  <a href="{{ url('admin/products/update/'.$product->id) }}" class="option-btn">update</a>
                  
                  <a href="{{ route('admin.products.delete', $product->id) }}" class="delete-btn" onclick="return confirm('delete this product?');">delete</a>
               </div>
            @endforeach
         @else
            <p class="empty">no products added yet!</p>
         @endif

      </div>

   </section>

   <script src="{{ asset('js/admin_script.js') }}"></script>

</body>
</html>