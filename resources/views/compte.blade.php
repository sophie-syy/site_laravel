<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon compte - L'instant Thé</title>

    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    @include('sous_partie\navbar')

    <div class="container mt-5">

        @if(session('message'))
            <div class="alert alert-success text-center">
                {{ session('message') }}
            </div>
        @endif


        <div class=" card-body p-5" style="color: rgb(195 195 195)">

            <h1 class="text-center mb-4">
                Bienvenue chez L'instant Thé 
            </h1>

            @if(isset($parcel))

                <h3 class="text-center mb-4"> Bonjour {{ $parcel->prenom }} !</h3>

                <div class="mb-3">
                    <strong>Nom :</strong>{{ $parcel->nom }}
                </div>

                <div class="mb-3">
                    <strong>Prénom :</strong>
                    {{ $parcel->prenom }}
                </div>

                <div class="mb-4">
                    <strong>Email :</strong>
                    {{ $parcel->email }}
                </div>

                <div class="d-flex gap-2">
                    <form action="{{ url('/compte') }}" method="POST" class="flex-fill">
                        @csrf
                        <button type="submit" class="btn btn-secondary w-100">Se déconnecter</button>
                    </form>

                    <form action="{{ url('/compte') }}" method="POST" class="flex-fill"
                        onsubmit="return confirm('Voulez-vous vraiment supprimer votre compte ?');">

                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn btn-danger w-100"> Supprimer mon compte </button>

                    </form>
                </div>

            @else

                <div class="text-center">

                    <p> Vous n'êtes pas connecté.</p>

                    <a href="{{ url('/connecter') }}" class="btn btn-secondary btn-lg flex-fill"> Se connecter </a> 
                    <a href="{{ url('/creer') }}" class="btn btn-secondary btn-lg flex-fill"> Créer un compte </a> 
                </div>

            @endif

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
