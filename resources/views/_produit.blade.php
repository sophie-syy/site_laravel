<div class="card shadow">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Description</th>
                        <th>Prix</th>
                        <th>Catégories</th>
                        <th>Image</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($produits as $produit)
                        <tr>
                            <td>{{ $produit->id }}</td>
                            <td>{{ $produit->nom }}</td>
                            <td>{{ $produit->description }}</td>
                            <td> {{ number_format($produit->prix, 2, ',', ' ') }} € </td>
                            <td>
                                @forelse($produit->categories as $categorie)
                                    <span class="badge bg-secondary"> {{ $categorie->nom }} </span>
                                @empty
                                    <span class="text-muted"> Aucune catégorie </span>
                                @endforelse
                            </td>
                            <td>{{ $produit->image }}</td>
                            <td>
                                <button type="button" class="btn btn-warning btn-sm" onclick="modifierProduit({{ $produit->id }})" > Modifier </button>
                                <form action="{{ url('/admin/produit/' . $produit->id) }}" method="POST" class="d-inline" >
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Supprimer ce produit ?')" > Supprimer </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">
                                Aucun produit trouvé.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>