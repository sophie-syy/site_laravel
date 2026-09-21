<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>L'instant Thé</title>

    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    
</head>
<body>
    @include('sous_partie\navbar')

    <div class="container mt-5" style="color: rgb(195 195 195)">
        <h1>L'instant Thé</h1>
        <p>Bienvenue chez L'instant Thé. Une pause gourmande, une gorgée de bonheur.</p>
    </div>

        <div class="container mt-5 mb-5"> 
        <h2 class="text-center mb-4" style="color: rgb(195 195 195)" >
            Découvrez nos top produits !!!
        </h2> 

        <div class="row g-4"> 
            @foreach($produits as $produit) 
                <div class="col-12 col-md-6 col-lg-4"> 
                    <div class="card h-100 shadow">

                        <img src="{{ asset('images/' . $produit->image) }}" class="card-img-top" 
                            style="height: 200px; object-fit: cover;" alt="{{ $produit->nom }}" > 

                        <div class="card-body d-flex flex-column"> 

                            <h3 class="card-title">{{ $produit->nom }}</h3>
                            <div class="mb-2">
                                @foreach($produit->categories as $categorie)
                                    <span class="badge bg-secondary"> {{ $categorie->nom }}</span>
                                @endforeach
                            </div>

                            <p class="fw-bold fs-5 mt-auto">{{ number_format($produit->prix,2,',',' ') }} €</p>

                            <form action="{{ url('/panier/ajouter/' . $produit->id) }}" method="POST" >
                                @csrf
                                <input type="hidden" name="quantite" value="1">
                                <button type="submit" class="btn btn-success w-100">Ajouter au panier</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="text-center mt-5">
            <a href="{{ url('/menu') }}" class="btn btn-success btn-lg px-5" > Voir le menu </a>
            <a href="{{ url('/compte') }}" class="btn btn-primary btn-lg px-5" > Mon compte</a>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>




