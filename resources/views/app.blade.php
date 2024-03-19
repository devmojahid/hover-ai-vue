<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title inertia>{{ config('app.name', 'Laravel') }}</title>
        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        <link rel="stylesheet" href="{{ asset("backend/css/font-awesome-pro.css") }}">
        
        @routes
        @vite(['resources/js/app.js', "resources/js/Pages/{$page['component']}.vue"])
        @inertiaHead
    </head>
    <body class="hold-transition sidebar-mini layout-fixed">
      <script src="{{ asset("backend/js/jquery.min.js") }}"></script>
      <script src="{{ asset("backend/js/main.js") }}"></script>  
      @inertia
    </body>
</html>
