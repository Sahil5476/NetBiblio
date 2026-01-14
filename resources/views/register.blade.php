<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Register - NetBiblio</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <link rel="stylesheet" href="{{ asset('css/style.css') }}">

</head>
<body>

{{-- Display Validation Errors (User already exists, password mismatch, etc.) --}}
@if($errors->any())
   @foreach($errors->all() as $error)
      <div class="message">
         <span>{{ $error }}</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
   @endforeach
@endif
   
<section class="form-container">

   <form action="{{ route('register.submit') }}" method="post">
      @csrf
        
      <img src="{{ asset('images/logo.png') }}" alt="Logo" style="width: 300px; display: block; margin: 0 auto 15px auto;">

      <h3>register now</h3>
      
      <input type="text" name="name" class="box" placeholder="enter your username" required value="{{ old('name') }}">
      
      <input type="email" name="email" class="box" placeholder="enter your email" required value="{{ old('email') }}">
      
      <input type="password" name="password" class="box" placeholder="enter your password" required>
      
      <input type="password" name="password_confirmation" class="box" placeholder="confirm your password" required>
      
      <input type="submit" class="btn" name="submit" value="register now">
      
      <p>already have an account? <a href="{{ route('login') }}">login now</a></p>
   </form>

</section>

</body>
</html>