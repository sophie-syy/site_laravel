<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">

        <a class="navbar-brand" href="{{ url('/') }}">L'instant Thé</a>

        <button 
            class="navbar-toggler" 
            type="button" 
            data-bs-toggle="collapse" 
            data-bs-target="#menuNavigation" 
            aria-controls="menuNavigation" 
            aria-expanded="false" 
            aria-label="Ouvrir le menu" 
        > 
            <span class="navbar-toggler-icon"></span> 
        </button>

        <div class="collapse navbar-collapse" id="menuNavigation">
            <div class="navbar-nav ms-auto">
                <a class="nav-link" href="{{ url('/') }}">Accueil</a>
                <a class="nav-link" href="{{ url('/menu') }}">Menu</a>
                <a class="nav-link" href="{{ url('/panier') }}">Panier</a>
                <a class="nav-link" href="{{ url('/compte') }}">Compte</a>

                @if(session('parcel_id'))

                @php
                    $parcel = \App\Models\Parcel::find(session('parcel_id'));
                @endphp

                @if($parcel && $parcel->role === 'admin')
                    <a class="nav-link text-warning" href="{{ url('/admin') }}">Admin</a>
                @endif

            @endif
            </div> 
        </div>
    </div>
</nav>

