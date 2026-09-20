<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>L'instant Thé</title>

    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    
</head>
<body>
    @include('_navbar')

    <div class="container text-center mt-5" style="color: rgb(195 195 195)">
        <h1>L'instant Thé</h1>

        <p>Bienvenue chez L'instant Thé.</p>
        <p>Une pause gourmande, une gorgée de bonheur.</p>

        <img src="/images/fond.jpg" width="50%" class="img-fluid rounded shadow" alt="page de gare">

    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
