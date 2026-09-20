<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connecter mon compte - L'instant Thé</title>

    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div style="color: rgb(195 195 195)">

            <h1 class="mb-4">L'instant Thé</h1>

            @if (session('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif

            <h3 class="text-center mb-3">Se connecter</h3>

            <form action="{{ url('/connecter') }}" method="POST">
                @csrf

                <label for="email">Email : </label><br>
                <input type="text" name="email" class="form-control" placeholder="Votre email"><br>

                <label class="mb-2" for="password">Mot de passe : </label><br>
                <input type="password" name="password" class="form-control" placeholder="Votre mot de passe"><br>
                <div class="text-center mb-3"> 
                    <a href="{{ url('/mot-de-passe-oublie') }}"> Mot de passe oublié ? </a> 
                </div>
                
                <div class=""> 
                    <button type="submit" class="btn btn-primary btn-lg flex-fill"> Se connecter </button> 
                    <a href="{{ url('/creer') }}" class="btn btn-secondary btn-lg flex-fill"> Aller créer</a> 
                    <a href="{{ url('/') }}" class="btn btn-secondary btn-lg flex-fill"> Retour </a> 
                </div>
        </div>    
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

