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
            <h3 class="text-center mb-3"> Mot de passe oublié ?</h3>
            
            <p class="text-center mb-4">
                Entrez votre adresse e-mail.
                Nous vous enverrons un lien pour
                créer un nouveau mot de passe.
            </p>

            @if(session('message'))
                <div class="alert alert-info text-center">
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

            <form action="{{ url('/mdpOublie') }}"  method="POST">

                @csrf
                <div class="mb-4">
                    <label for="email" class="form-label fw-semibold" > Adresse e-mail</label>
                    <input type="email" id="email" name="email" class="form-control form-control-lg"
                        placeholder="exemple@email.com" value="{{ old('email') }}" required>
                </div>

                <button type="submit" class="btn btn-primary btn-lg w-100">
                    Envoyer le lien
                </button>
            </form>

            <div class="text-center mt-4">
                <a href="{{ url('/connecter') }}" class="text-decoration-none">
                    ← Retour à la connexion
                </a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>

