<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bienvenido</title>
</head>

<body>
    <h3>Hola {{$user->name}}!</h3>
    <p>
        Yu usuario en el sistema ha sido creado, puede acceder cuando desees usando las siguientes credenciales:
    </p>
    <ul>
        <li>Usuario: {{ $user->email }}</li>
        <li>Contraseña: {{ $user->email }}</li>
    </ul>
    <p>
        Recomendamos que cambies tu contraseña lo antes posible
    </p>
</body>

</html>
