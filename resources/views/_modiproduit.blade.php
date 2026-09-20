<div id="formModification" class="card mb-4" style="display: none;" >
    <div class="card-body">
        <h3> Modifier le produit </h3>
        <form id="formModifier" method="POST" >

            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">  Nom </label>
                    <input type="text" id="modifierNom" name="nom" class="form-control" required >
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label"> Prix</label>
                    <input type="number" id="modifierPrix" name="prix" class="form-control" step="0.01" required >
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Catégories</label>
                    <select id="modifierCategories" name="categories[]" class="form-select" multiple required>
                        @foreach($categories as $categorie)
                            <option value="{{ $categorie->id }}">{{ $categorie->nom }}</option>
                        @endforeach
                    </select>
                    <small class="text-muted">
                        Maintiens Ctrl pour sélectionner plusieurs catégories.
                    </small>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label"> Image </label>
                    <input type="text" id="modifierImage" name="image" class="form-control" >
                </div>

                <div class="col-12 mb-3">
                    <label class="form-label"> Description </label>
                    <textarea id="modifierDescription" name="description" class="form-control" rows="3" ></textarea>
                </div>
            </div>

            <button type="submit" class="btn btn-success">  Enregistrer </button>
            <button type="button" class="btn btn-secondary" onclick="fermerModification()" > Annuler </button>
        </form>
    </div>
</div>