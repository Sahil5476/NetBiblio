<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Admin Users</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link rel="stylesheet" href="{{ asset('css/admin_style.css') }}">
</head>
<body>
   
   @include('layouts.admin_header')

   <section class="users">

      <h1 class="title">users account</h1>

      <div class="box-container">
         @if($users->count() > 0)
            @foreach($users as $user)
               <div class="box">
                  <p>user id : <span>{{ $user->id }}</span></p>
                  <p>username : <span>{{ $user->name }}</span></p>
                  <p>email : <span>{{ $user->email }}</span></p>
                  
                  <p>user type : 
                     <span style="color:{{ $user->user_type == 'admin' ? 'var(--orange)' : '' }}">
                        {{ $user->user_type }}
                     </span>
                  </p>
                  
                  <a href="{{ route('admin.users.delete', $user->id) }}" onclick="return confirm('delete this user?');" class="delete-btn">delete</a>
               </div>
            @endforeach
         @else
            <p class="empty">no users found!</p>
         @endif
      </div>

   </section>

   <script src="{{ asset('js/admin_script.js') }}"></script>

</body>
</html>