<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer mon compte - L'instant Thé</title>

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

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            
            <h3 class="text-center mb-3"> Créer un compte </h3>

            <form action="{{ url('/creer') }}" method="POST">
                @csrf

                <label for="nom">Nom : </label><br>
                <input type="text" name="nom" class="form-control" placeholder="Nom"><br>

                <label for="prenom">Prénom : </label><br>
                <input type="text" name="prenom" class="form-control" placeholder="Prénom"><br>
                
                <label for="email">Email : </label><br>
                <input type="text" name="email" class="form-control" placeholder="exemple@email.com"><br>
                
                <label class="mb-2" for="password">Mot de passe : </label><br>
                <input type="password" name="password" class="form-control" placeholder="Minimum 8 caractères"><br>

                <label class="mb-2" for="password">Confirmer le mot de passe : </label><br>
                <input type="password" name="password2" class="form-control" placeholder="Répétez le mot de passe"><br>

                <div class=""> 
                    <button type="submit" class="btn btn-primary btn-lg flex-fill"> Créer </button> 
                    <a href="{{ url('/connecter') }}" class="btn btn-secondary btn-lg flex-fill">Aller connecter </a> 
                    <a href="{{ url('/') }}" class="btn btn-secondary btn-lg flex-fill"> Retour </a> 
                </div>
            </form>
        </div>    
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

