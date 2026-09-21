<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu - L'instant Thé</title>

    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    @include('sous_partie\navbar')

    <div class="container py-5">
        <div class="text-center mb-5">
            @foreach($categories as $categorie)
                <a href="#{{ Str::slug($categorie->nom) }}" class="btn btn-outline-primary m-1">{{ $categorie->nom }}</a>
            @endforeach
        </div>

        @foreach($categories as $categorie)
            <section id="{{ Str::slug($categorie->nom) }}" class="mb-5">
                <h2 class="mb-4"> {{ $categorie->nom }} </h2>

                <div class="row g-4">
                    @foreach($categorie->produits as $produit)
                        <div class="col-md-4">
                            <div class="card shadow h-100">
                                @if($produit->image)
                                    <img src="{{ asset('images/' . $produit->image) }}" class="card-img-top" alt="{{ $produit->nom }}" style="height: 220px; object-fit: cover;">
                                @endif

                                <div class="card-body text-center">
                                    <h3 class="card-title">{{ $produit->nom }}</h3>
                                    <p class="card-text">
                                        @forelse($produit->categories as $categorie)
                                            <span class="badge bg-secondary">
                                                {{ $categorie->nom }}
                                            </span>
                                        @empty
                                            <span class="text-muted">Aucune catégorie</span>
                                        @endforelse
                                    </p>
                                    <p class="card-text">{{ $produit->description }}</p>
                                    <p class="fw-bold fs-5">{{ number_format($produit->prix, 2, ',', ' ') }} €</p>

                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalProduit{{ $produit->id }}">+</button>

                                    <div class="modal fade" id="modalProduit{{ $produit->id }}" tabindex="-1">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title"> {{ $produit->nom }} </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"> </button>
                                                </div>

                                                <div class="modal-body">
                                                    <div class="text-center mb-3">
                                                        @if($produit->image)
                                                            <img src="{{ asset('images/' . $produit->image) }}" alt="{{ $produit->nom }}" style="max-width: 150px;" class="img-fluid rounded">
                                                        @endif
                                                    </div>

                                                    <h4 class="text-center"> {{ number_format($produit->prix, 2, ',', ' ') }} € </h4>

                                                    <form action="{{ url('/panier/ajouter/' . $produit->id) }}" method="POST">
                                                        @csrf
                                                        <div class="mb-3">
                                                            <label class="form-label"> Quantité </label>
                                                            <input type="number" name="quantite" value="1" min="1" class="form-control">
                                                        </div>

                                                        <button type="submit" class="btn btn-success w-100"> Confirmer </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
        @endforeach
        

        @if(session('produit_ajoute'))
            <div class="modal fade show" style="display: block; background: rgba(0,0,0,0.5);" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title"> Produit ajouté </h5>
                        </div>

                        <div class="modal-body text-center">
                            <p><strong>{{ session('produit_ajoute') }}</strong>  a été ajouté au panier. </p>
                            <p> Que souhaitez-vous faire ? </p>
                        </div>

                        <div class="modal-footer">
                            <a href="{{ url('/menu') }}" class="btn btn-secondary"> Continuer mes achats</a>
                            <a href="{{ url('/panier') }}" class="btn btn-primary"> Passer au paiement </a>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>




