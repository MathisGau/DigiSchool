<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your App Title</title>
</head>

<body>

    <div class="flex">
        <div class="w-1/4 bg-blue-500 p-4">
            @include('components.menu')
        </div>

        <div class="w-3/4 p-4">
            @yield('content')
        </div>
    </div>

</body>

</html>
