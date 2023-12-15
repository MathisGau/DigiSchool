<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>DigiSchool</title>
</head>

<body>
    <div id="app">
        @section('menu')
            <nav>
                <ul>
                    <li><a href="{{ route('login') }}">Connexion</a></li>
                    <li><a href="{{ route('notes') }}">Notes</a></li>
                    <li><a href="{{ route('compte') }}">Compte</a></li>
                </ul>
            </nav>
        @show

        <main>
            @yield('content')
        </main>
    </div>
</body>

</html>
