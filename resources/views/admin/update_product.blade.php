<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Update Product</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link rel="stylesheet" href="{{ asset('css/admin_style.css') }}">
</head>
<body>
   
   @include('layouts.admin_header')

   <section class="update-product">

      <form action="{{ route('admin.products.update', $product->id) }}" method="post" enctype="multipart/form-data">
         @csrf
         
         <img src="{{ asset('uploaded_img/' . $product->image) }}" class="image" alt="">
         
         <input type="text" class="box" value="{{ $product->name }}" required placeholder="update product name" name="name">
         
         <input type="number" min="0" class="box" value="{{ $product->price }}" required placeholder="update product price" name="price">
         
         <textarea name="details" class="box" required placeholder="update product details" cols="30" rows="10">{{ $product->details }}</textarea>
         
         <input type="file" accept="image/jpg, image/jpeg, image/png" class="box" name="image">
         
         <input type="submit" value="update product" name="update_product" class="btn">
         
         <a href="{{ route('admin.products') }}" class="option-btn">go back</a>
      </form>

   </section>

   <script src="{{ asset('js/admin_script.js') }}"></script>

</body>
</html>