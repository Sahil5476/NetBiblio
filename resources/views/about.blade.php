<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>About Us - NetBiblio</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
   
   @include('layouts.header')

   <section class="heading">
      <h3>about us</h3>
      <p> <a href="{{ route('home') }}">home</a> / about </p>
   </section>

   <section class="about">

      <div class="flex">
         <div class="image">
            <img src="{{ asset('images/about-image1.jpg') }}" alt="">
         </div>
         <div class="content">
            <h3>why choose us?</h3>
            <p>Our point is to give significant, charming, and animating substance to youngsters who go much past their normal course books. With this point of view, we treat each book as a work of adoration.</p>
            <a href="{{ url('shop') }}" class="btn">shop now</a>
         </div>
      </div>

      <div class="flex">
         <div class="content">
            <h3>what we provide?</h3>
            <p>The wide scope of books offered by us incorporates fantasies, moral stories, showed storybooks, reference books, general learning books, sentence structure books, shading books, action books, sticker books, and more.</p>
            <a href="{{ url('contact') }}" class="btn">contact us</a>
         </div>
         <div class="image">
            <img src="{{ asset('images/about-image2.jpg') }}" alt="">
         </div>
      </div>

      <div class="flex">
         <div class="image">
            <img src="{{ asset('images/about-image3.jpg') }}" alt="">
         </div>
         <div class="content">
            <h3>who we are?</h3>
            <p>This BookStore is a meta-search engine for comparing books prices and know availability across all popular Indian book stores.</p>
            <a href="#reviews" class="btn">clients reviews</a>
         </div>
      </div>

   </section>

   <section class="reviews" id="reviews">

      <h1 class="title">client's reviews</h1>

      <div class="box-container">

         <div class="box">
            <img src="{{ asset('images/profile.png') }}" alt="">
            <p></p> <div class="stars">
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star-half-alt"></i>
            </div>
            <h3>USER 1</h3>
         </div>

         <div class="box">
            <img src="{{ asset('images/profile.png') }}" alt="">
            <p></p>
            <div class="stars">
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star-half-alt"></i>
            </div>
            <h3>USER 2</h3>
         </div>

         <div class="box">
            <img src="{{ asset('images/profile.png') }}" alt="">
            <p></p>
            <div class="stars">
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star-half-alt"></i>
            </div>
            <h3>USER 3</h3>
         </div>

         <div class="box">
            <img src="{{ asset('images/profile.png') }}" alt="">
            <p></p>
            <div class="stars">
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star-half-alt"></i>
            </div>
            <h3>USER 4</h3>
         </div>

         <div class="box">
            <img src="{{ asset('images/profile.png') }}" alt="">
            <p></p>
            <div class="stars">
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star-half-alt"></i>
            </div>
            <h3>USER 5</h3>
         </div>

         <div class="box">
            <img src="{{ asset('images/profile.png') }}" alt="">
            <p></p>
            <div class="stars">
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star-half-alt"></i>
            </div>
            <h3>USER 6</h3>
         </div>

      </div>

   </section>

   @include('layouts.footer')

   <script src="{{ asset('js/script.js') }}"></script>

</body>
</html>