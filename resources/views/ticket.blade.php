<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket - L'instant Thé</title>

    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    @include('_navbar')

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-7">
                <div class="card shadow">
                    <div class="card-body p-5">
                        <div class="text-center">
                            <h1> L'instant Thé</h1>
                            <h2 class="text-success mt-4">Achat confirmé !</h2>
                            <p class="text-muted">Merci pour votre commande.</p>
                        </div>

                        <hr>

                        <div class="text-center mb-4">
                            <p class="mb-1">Ticket électronique</p>
                            <h4>{{ $commande->numero_ticket }}</h4>
                            <small class="text-muted">{{ $commande->created_at->format('d/m/Y H:i') }}</small>
                        </div>

                        <hr>

                        @foreach($commande->produits as $produit)
                            @php
                                $sousTotal =
                                    $produit->pivot->prix *
                                    $produit->pivot->quantite;
                            @endphp

                            <div class="d-flex justify-content-between mb-3">
                                <div>
                                    <strong>{{ $produit->nom }}</strong><br>
                                    <small class="text-muted">Quantité :{{ $produit->pivot->quantite }}</small>
                                </div>
                                <strong>{{ number_format($sousTotal, 2, ',', ' ') }} €</strong>
                            </div>
                        @endforeach

                        <hr>

                        <div class="d-flex justify-content-between">
                            <h4>Total</h4>
                            <h4>{{ number_format($commande->total, 2, ',', ' ') }} €</h4>
                        </div>

                        <div class="text-center mt-5">
                            <a href="{{ url('/menu') }}" class="btn btn-primary"> Continuer mes achats </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

