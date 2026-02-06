<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    {{-- bootstrap links --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    {{-- Css link --}}


    <link rel="stylesheet" type="text/css" href="{{ asset('style/style.css') }}">
    <title>Register</title>
</head>

<body>
    <div class="container">
        <div id="informations">
            <h1></h1>
        </div>
        <div id="registerForm">
            <h1>S'inscrire</h1>
            <form  method="POST">
                @csrf <div class="input-group">
                    <i class="bi bi-person"></i>
                    <input type="text" name="name" placeholder="Nom complet" required>
                </div>

                <div class="input-group">
                    <i class="bi bi-envelope"></i>
                    <input type="email" name="email" placeholder="Email" required>
                </div>

                <div class="input-group">
                    <i class="bi bi-lock"></i>
                    <input type="password" name="password" placeholder="Mot de passe" required>
                </div>

                <div class="input-group">
                    <i class="bi bi-shield-check"></i>
                    <input type="password" name="password_confirmation" placeholder="Confirmer le mot de passe"
                        required>
                </div>

                <button type="submit" class="btn-submit">S'inscrire</button>
            </form>
        </div>
    </div>

</body>

</html>