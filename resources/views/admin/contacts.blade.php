<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Admin Messages</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link rel="stylesheet" href="{{ asset('css/admin_style.css') }}">
</head>
<body>
   
   @include('layouts.admin_header')

   <section class="messages">

      <h1 class="title">messages</h1>

      <div class="box-container">

         @if($messages->count() > 0)
            @foreach($messages as $msg)
               <div class="box">
                  <p>user id : <span>{{ $msg->user_id }}</span> </p>
                  <p>name : <span>{{ $msg->name }}</span> </p>
                  <p>number : <span>{{ $msg->number }}</span> </p>
                  <p>email : <span>{{ $msg->email }}</span> </p>
                  <p>message : <span>{{ $msg->message }}</span> </p>
                  
                  <a href="{{ route('admin.messages.delete', $msg->id) }}" onclick="return confirm('delete this message?');" class="delete-btn">delete</a>
               </div>
            @endforeach
         @else
            <p class="empty">you have no messages!</p>
         @endif

      </div>

   </section>

   <script src="{{ asset('js/admin_script.js') }}"></script>

</body>
</html>