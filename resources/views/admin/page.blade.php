<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Admin Dashboard</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   
   <link rel="stylesheet" href="{{ asset('css/admin_style.css') }}">
</head>
<body>
   
   @include('layouts.admin_header')

   <section class="dashboard">

      <h1 class="title">dashboard</h1>

      <div class="box-container">

         <div class="box">
            <h3>₹{{ $total_pendings }}/-</h3>
            <p>total pendings</p>
         </div>

         <div class="box">
            <h3>₹{{ $total_completes }}/-</h3>
            <p>completed payments</p>
         </div>

         <div class="box">
            <h3>{{ $number_of_orders }}</h3>
            <p>orders placed</p>
         </div>

         <div class="box">
            <h3>{{ $number_of_products }}</h3>
            <p>products added</p>
         </div>

         <div class="box">
            <h3>{{ $number_of_users }}</h3>
            <p>normal users</p>
         </div>

         <div class="box">
            <h3>{{ $number_of_admins }}</h3>
            <p>admin users</p>
         </div>

         <div class="box">
            <h3>{{ $total_accounts }}</h3>
            <p>total accounts</p>
         </div>

         <div class="box">
            <h3>{{ $number_of_messages }}</h3>
            <p>new messages</p>
         </div>

      </div>

   </section>

   <script src="{{ asset('js/admin_script.js') }}"></script>

</body>
</html>