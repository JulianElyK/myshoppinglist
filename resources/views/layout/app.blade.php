<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Shopping List</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
    <style>
      #ShoppingItems::-webkit-scrollbar {
        display: none;
      }

      #ShoppingItems {
        -ms-overflow-style: none; 
        scrollbar-width: none;
      }
    </style>
  </head>
  <body class="p-3 h-screen bg-gray-200">
    <nav class="flex justify-between">
      <ul class="flex space-x-4 items-center">
        <li class="p-2 bg-white ">
          <a href="{{ route('Home') }}" class="p-3">Shopping Lists</a>
        </li>
        <li class="p-2 bg-white ">
          <a href="{{ route('FormAdd') }}" class="p-3">Add New List</a>
        </li>
      </ul>
    </nav>
    @yield('content')
  </body>
</html>