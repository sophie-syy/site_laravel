<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - L'instant Thé</title>

    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    @include('sous_partie\navbar')
    <div class="container mt-5">
        <ul class="nav nav-pills justify-content-center mb-4">

            <li class="nav-item">
                <button
                    class="nav-link {{ session('onglet', 'produits') === 'produits' ? 'active' : '' }}"
                    data-bs-toggle="pill"
                    data-bs-target="#produits"
                    type="button"
                >
                    Produits
                </button>
            </li>

            <li class="nav-item">
                <button
                    class="nav-link {{ session('onglet') === 'categories' ? 'active' : '' }}"
                    data-bs-toggle="pill"
                    data-bs-target="#categories"
                    type="button"
                >
                    Catégories
                </button>
            </li>

            <li class="nav-item">
                <button
                    class="nav-link {{ session('onglet') === 'clients' ? 'active' : '' }}"
                    data-bs-toggle="pill"
                    data-bs-target="#clients"
                    type="button"
                >
                    Clients
                </button>
            </li>

        </ul>

        <div class="tab-content">

            @if (session('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif   
            
            <div
                class="tab-pane fade {{ session('onglet', 'produits') === 'produits' ? 'show active' : '' }}"
                id="produits"
            >
                <div id="formAjout">
                    @include('sous_partie\ajproduit') 
                </div>

                @include('sous_partie\modiproduit')

                @include('sous_partie\produit')
            </div>

            <div 
                class="tab-pane fade {{ session('onglet') === 'categories' ? 'show active' : '' }}"
                id="categories" 
            >
                @include('sous_partie\categorie')
            </div>

            <div 
                class="tab-pane fade {{ session('onglet') === 'clients' ? 'show active' : '' }}"
                id="clients" 
            >
                @include('sous_partie\client')   
            </div>
        </div>
    </div>
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const produits = @json($produits);

        function modifierProduit(id)
        {
            const produit = produits.find( produit => produit.id === id);
            const selectCategories = document.getElementById('modifierCategories'); 

            if (!produit) {return;}
            
            document.getElementById('formAjout').style.display = 'none';// Cacher le formulaire AJOUTER
            document.getElementById('formModification').style.display = 'block'; // Afficher le formulaire MODIFIER
            document.getElementById('modifierNom').value = produit.nom;// Remplir le nom
            document.getElementById('modifierPrix').value = produit.prix;// Remplir le prix
            document.getElementById('modifierImage').value = produit.image ?? '';// Remplir l'image
            document.getElementById('modifierDescription').value = produit.description ?? '';// Remplir la description
            
            // Tout désélectionner
            selectCategories.querySelectorAll('option').forEach(option => {option.selected = false;});

            // Sélectionner les catégories du produit
            produit.categories.forEach(categorie => {
                const option = selectCategories.querySelector('option[value="' + categorie.id + '"]');
                if (option) { option.selected = true;}
            });

            // URL du formulaire
            document.getElementById('formModifier').action = '/admin/produit/' + produit.id;

            // Remonter en haut
            window.scrollTo({ top: 0, behavior: 'smooth'});
        }


        function fermerModification()
        {
            // Cacher Modifier
            document.getElementById('formModification').style.display ='none';

            // Réafficher Ajouter
            document.getElementById('formAjout').style.display = 'block';
        }

    </script>
</body>
</html>





