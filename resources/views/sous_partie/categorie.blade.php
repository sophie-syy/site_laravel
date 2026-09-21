<div class="card mb-4">
    <div class="card-body">
        <h3>Ajouter une catégorie</h3>
        <form action="{{ url('/admin/categorie') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label"> Nom de la catégorie  </label> 
                <input type="text" name="nom"  class="form-control"  required >
            </div>
            <button type="submit" class="btn btn-success"> Ajouter </button>
        </form>
    </div>
</div>

<div class="card shadow">
    <div class="card-body">
        <h3 class="mb-4"> Catégories </h3>

        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($categories as $categorie)
                        <tr>
                            <td> {{ $categorie->id }} </td> 
                            <td> {{ $categorie->nom }} </td> 
                            <td>
                                {{-- MODIFIER --}}
                                <form action="{{ url('/admin/categorie/' . $categorie->id) }}" method="POST" class="d-inline" >
                                    @csrf
                                    @method('PUT')
                                    <input  
                                        type="text" name="nom" value="{{ $categorie->nom }}"
                                        class="form-control d-inline-block" style="width: 200px;" required
                                    >
                                    <button type="submit" class="btn btn-warning btn-sm">Modifier</button>
                                </form>

                                <form action="{{ url('/admin/categorie/' . $categorie->id) }}" method="POST" class="d-inline">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Supprimer cette catégorie ?')">
                                        Supprimer
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center"> Aucune catégorie trouvée.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>