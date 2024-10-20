<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  @vite('resources/css/app.css')
  @yield('librarycss')
</head>

<body>

  @yield('content')

  <script src="../path/to/flowbite/dist/flowbite.min.js"></script>
  @vite('resources/js/app.js')
  @yield('libraryjs')
</body>

</html>