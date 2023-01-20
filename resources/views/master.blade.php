@include('components.nav')


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    @vite('resources/css/app.css')
    <title>Laravel Blog</title>
</head>
<body class="dark:bg-gray-900 text-white">
    @yield('nav')
    @yield('contenue')
</body>
</html>