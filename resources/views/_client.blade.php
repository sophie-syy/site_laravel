
<div class="card shadow"> 
    <div class="card-body"> 
        <div class="table-responsive"> 
            <table class="table table-striped table-hover align-middle"> 
                <thead class="table-dark"> 
                    <tr> 
                        <th>ID</th> 
                        <th>Nom</th> 
                        <th>Prénom</th> 
                        <th>Email</th> 
                        <th>Rôle</th> 
                        <th>Actions</th> 
                    </tr> 
                </thead> 
                <tbody> 
                    @forelse($parcels as $parcel) 
                        <tr> 
                            <td> {{ $parcel->id }} </td> 
                            <td> {{ $parcel->nom }} </td> 
                            <td> {{ $parcel->prenom }} </td> 
                            <td> {{ $parcel->email }} </td> 
                            <td> {{ $parcel->role }} </td> 
                            <td> 
                                <form action="{{ url('/admin/client/' . $parcel->id) }}"  method="POST"  class="d-inline" >
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn btn-danger btn-sm" onclick=" return confirm('Supprimer ce client ?')">
                                        Supprimer
                                    </button>
                                </form>
                            </td> 
                        </tr> 
                    @empty 
                        <tr> 
                            <td colspan="6" class="text-center" > Aucun client trouvé. </td> 
                        </tr> 
                    @endforelse 
                </tbody> 
            </table> 
        </div> 
    </div> 
</div>
