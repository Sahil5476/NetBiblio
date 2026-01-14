<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Contact - NetBiblio</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
   
   @include('layouts.header')

   <section class="heading">
      <h3>contact us</h3>
      <p> <a href="{{ route('home') }}">home</a> / contact </p>
   </section>

   <section class="contact">

      <form action="{{ route('send.message') }}" method="POST">
         @csrf <h3>send us message!</h3>
         
         <input type="text" name="name" value="{{ Auth::user()->name }}" placeholder="enter your name" class="box" required> 
         <input type="email" name="email" value="{{ Auth::user()->email }}" placeholder="enter your email" class="box" required>
         <input type="number" name="number" placeholder="enter your number" class="box" required>
         
         <textarea name="message" class="box" placeholder="enter your message" required cols="30" rows="10"></textarea>
         
         <input type="submit" value="send message" name="send" class="btn">
      </form>

   </section>

   @include('layouts.footer')

   <script src="{{ asset('js/script.js') }}"></script>

</body>
</html>