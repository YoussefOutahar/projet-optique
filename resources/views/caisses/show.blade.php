<!DOCTYPE html>
<html>
<head>
    <title>Détails Caisse</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">

</head>
<body>
<div class="container">
    <h1>Détails de la Caisse</h1>

    <div>
        <p>ID : {{ $caisse->id }}</p>
        <p>Facture ID : {{ $caisse->facture_id }}</p>
        <p>Date Facture : {{ $caisse->date_facture }}</p>
        <p>Status : {{ $caisse->status }}</p>
        <p>Client ID : {{ $caisse->client_id }}</p>
        <p>Paiement : {{ $caisse->paiement }}</p>
    </div>

    <div>
        <a href="{{ route('caisses.edit', ['caiss' => $caisse->id]) }}" class="btn btn-primary">Modifier</a>
        <a href="{{ route('caisses.index') }}" class="btn btn-primary">Retour à la liste</a>
    </div>
</div>
</body>
</html>
