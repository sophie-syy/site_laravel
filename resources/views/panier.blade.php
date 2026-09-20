<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon panier - L'instant Thé</title>

    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    @include('_navbar')
    <div class="container py-5">
        
        @if(count($panier) > 0)
            @php
                $total = 0;
            @endphp

            <div class="row">
                <div class="col-md-8">
                    @if(session('parcel_id'))

                        @foreach($panier as $ligne)

                            @php
                                $produit = $ligne->produit;

                                $sousTotal =
                                    $produit->prix *
                                    $ligne->quantite;

                                $total += $sousTotal;
                            @endphp

                            <div class="card shadow mb-3">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-md-2">
                                            @if($produit->image)
                                                <img
                                                    src="{{ asset('images/' . $produit->image) }}"
                                                    alt="{{ $produit->nom }}"
                                                    class="img-fluid rounded">
                                            @endif
                                        </div>

                                        <div class="col-md-4">
                                            <h5>{{ $produit->nom }}</h5>
                                            <p class="text-muted mb-0">{{ number_format($produit->prix, 2, ',' ,' ') }}€</p>
                                        </div>

                                        <div class="col-md-2">
                                            Quantité : <strong>{{ $ligne->quantite }}</strong>
                                        </div>

                                        <div class="col-md-2">
                                            <strong>{{ number_format($sousTotal,2,',',' ') }}€</strong>
                                        </div>

                                        <div class="col-md-2">
                                            <form action="{{ url('/panier/supprimer/' . $ligne->id) }}"method="POST">

                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">X</button>

                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        @endforeach

                    @else

                        @foreach($panier as $id => $produit)

                            @php
                                $sousTotal =
                                    $produit['prix'] *
                                    $produit['quantite'];

                                $total += $sousTotal;
                            @endphp


                            <div class="card shadow mb-3">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-md-2">

                                            @if($produit['image'])
                                                <img src="{{ asset('images/' . $produit['image']) }}" alt="{{ $produit['nom'] }}" class="img-fluid rounded">
                                            @endif

                                        </div>

                                        <div class="col-md-4">
                                            <h5>{{ $produit['nom'] }}</h5>
                                            <p class="text-muted mb-0">{{ number_format($produit['prix'],2,',',' ') }}€</p>
                                        </div>

                                        <div class="col-md-2">
                                            Quantité :<strong>{{ $produit['quantite'] }}</strong>
                                        </div>

                                        <div class="col-md-2">
                                            <strong>{{ number_format($sousTotal,2,',',' ') }}€</strong>
                                        </div>

                                        <div class="col-md-2">
                                            <form action="{{ url('/panier/supprimer/' . $id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit" class="btn btn-danger btn-sm"> X</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif

                </div>

                <div class="col-md-4">
                    <div class="card shadow">
                        <div class="card-body">

                            <div class="d-flex justify-content-between">
                                <span>Total</span>
                                <strong>{{ number_format($total,2,',',' ') }}€</strong>
                            </div>
                        
                            <hr>

                            <button type="button" class="btn btn-success w-100 mb-2"  data-bs-toggle="modal" data-bs-target="#confirmationCommande"> Commander </button>
                            
                            <form action="{{ url('/panier/vider') }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger w-100">  Vider le panier </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="confirmationCommande" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">

                        <div class="modal-header">
                            <h5 class="modal-title"> Confirmer votre commande </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"> </button>
                        </div>

                        <div class="modal-body text-center">

                            <p> Vous êtes sur le point de confirmer votre commande. </p>
                            <p> Total : <strong> {{ number_format( $total, 2, ',', ' ' ) }} € </strong></p>

                            @if(!session('parcel_id'))
                                <div class="alert alert-warning">Vous devez être connecté pour passer une commande. </div>
                            @endif

                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary"  data-bs-dismiss="modal"> Annuler </button>

                            <form action="{{ url('/commande') }}" method="POST">

                                @csrf

                                <button type="submit" class="btn btn-success">

                                    @if(session('parcel_id'))
                                        Confirmer l'achat
                                    @else
                                        Se connecter
                                    @endif

                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        @else
            <div class="text-center">
                <div class="card shadow p-5">
                    <h2> Votre panier est vide </h2>
                    <p class="text-muted mt-3"> Vous n'avez encore ajouté aucun produit. </p>
                    <a href="{{ url('/menu') }}" class="btn btn-primary"> Voir le menu </a>
                </div>
            </div>
        @endif

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

