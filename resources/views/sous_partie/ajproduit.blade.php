<div class="card mb-4">
    <div class="card-body">
        <h3 class="mb-4"> Ajouter un produit </h3>

        <form action="{{ url('/admin') }}" method="POST" >
            @csrf

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label"> Nom </label>
                    <input type="text" name="nom" class="form-control" value="{{ old('nom') }}" required >
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label"> Prix </label>
                    <input type="number" name="prix" class="form-control" step="0.01" min="0" value="{{ old('prix') }}" required >
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Catégories</label>

                    <select name="categories[]" class="form-select" multiple required>
                        @foreach($categories as $categorie)
                            <option value="{{ $categorie->id }}">
                                {{ $categorie->nom }}
                            </option>
                        @endforeach
                    </select>

                    <small class="text-muted">
                        Maintiens Ctrl pour sélectionner plusieurs catégories.
                    </small>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label"> Image </label>
                    <input type="text" name="image" class="form-control" value="{{ old('image') }}" placeholder="ex: bubble-tea.jpg" >
                </div>

                <div class="col-12 mb-3">
                    <label class="form-label"> Description </label>
                    <textarea name="description" class="form-control" rows="3" >{{ old('description') }}</textarea>
                </div>
            </div>

            <button type="submit" class="btn btn-success" > Ajouter le produit </button>
        </form>
    </div>
</div>