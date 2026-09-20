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
        <div style="max-width: 500px; width: 100%; color: rgb(195 195 195)">
            <h1 class="text-center fw-bold"> L'instant Thé</h1>
            <h3 class="text-center mb-3"> Nouveau mot de passe</h3>

            @if(session('message'))
                <div class="alert alert-danger text-center">
                    {{ session('message') }}
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger">
                    @foreach($errors->all() as $error)
                        <div>
                            {{ $error }}
                        </div>
                    @endforeach
                </div>
            @endif

            <form action="{{ url('/reinitialiser-mot-de-passe') }}" method="POST" >

                @csrf

                <input type="hidden" name="token" value="{{ $token }}" >
                <input type="hidden" name="email" value="{{ $email }}" >

                <div class="mb-3">
                    <label for="password" class="form-label fw-semibold">Nouveau mot de passe</label>
                    <input type="password" id="password" name="password" class="form-control form-control-lg"
                        placeholder="Votre nouveau mot de passe" minlength="8" required >

                    <div class="form-text"> Minimum 8 caractères. </div>
                </div>

                <div class="mb-4">

                    <label  for="password_confirmation"  class="form-label fw-semibold" >
                        Confirmer le mot de passe
                    </label>

                    <input  type="password" id="password_confirmation" name="password_confirmation"  class="form-control form-control-lg"
                        placeholder="Confirmez votre mot de passe"  minlength="8" required>
                </div>

                <button type="submit" class="btn btn-success btn-lg w-100" > Réinitialiser mon mot de passe </button>
            </form>

            <div class="text-center mt-4">
                <a href="{{ url('/connecter') }}" class="text-decoration-none" > ← Retour à la connexion</a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>

