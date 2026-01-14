<section class="footer">

   <div class="box-container">

      <div class="box">
         <h3>quick links</h3>
         <a href="{{ route('home') }}">home</a>
         <a href="{{ url('about') }}">about</a>
         <a href="{{ url('contact') }}">contact</a>
         <a href="{{ url('shop') }}">shop</a>
      </div>

      <div class="box">
         <h3>extra links</h3>
         <a href="{{ route('login') }}">login</a>
         <a href="{{ route('register') }}">register</a>
         <a href="{{ url('orders') }}">my orders</a>
         <a href="{{ url('cart') }}">my cart</a>
      </div>

      <div class="box">
         <h3>contact info</h3>
         <p> <i class="fas fa-phone"></i> +91 7620795110 </p>
         <p> <i class="fas fa-phone"></i> +91 8459545347 </p>
         <p> <i class="fas fa-envelope"></i> shekhsahil@gmail.com </p>
         <p> <i class="fas fa-map-marker-alt"></i> Gondal, India </p>
      </div>

      <div class="box">
         <h3>follow us</h3>
         <a href="#"><i class="fab fa-facebook-f"></i>facebook</a>
         <a href="#"><i class="fab fa-twitter"></i>twitter</a>
         <a href="#"><i class="fab fa-instagram"></i>instagram</a>
         <a href="#"><i class="fab fa-linkedin"></i>linkedin</a>
      </div>

   </div>

   <div class="credit">&copy; copyright @ {{ date('Y') }} by <span>Shekh Sahil</span> </div>

</section>