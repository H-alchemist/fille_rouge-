<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CheckArena - @yield('title')</title>
  {{-- <script src="https://cdn.tailwindcss.com"></script> --}}
</head>
<body class="bg-gray-900 text-white min-h-screen flex flex-col">
  @include('partials.header')

  <!-- Chess piece decoration -->
  <div class="absolute opacity-20 text-9xl z-0 top-5 right-10">♞</div>
  <div class="absolute opacity-20 text-9xl z-0 bottom-5 left-10">♜</div>

  <main class="flex-1">
    @yield('content')
  </main>

  @include('partials.footer')

  @stack('scripts')
</body>
</html>