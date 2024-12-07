<!DOCTYPE html>
<html>
<head>
    <title>Modifier Caisse</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <h1>Modifier Caisse</h1>
    <form action="{{ route('caisses.update',  ['caiss' => $caiss->id]) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="facture_id">Facture:</label>
        <select name="facture_id" id="facture_id" required>
            @foreach ($factures as $facture)
                <option value="{{ $facture->id }}" {{ $facture->id == $caiss->facture_id ? 'selected' : '' }}>
                    {{ $facture->id }} 
                </option>
            @endforeach
        </select>
        <br>
        <label for="date_facture">Date de Facture:</label>
        <input type="date" name="date_facture" id="date_facture" value="{{ $caiss->date_facture }}" required>
        <br>
        <label for="status">Status:</label>
        <select name="status" id="status" required>
            <option value="Avance" {{ $caiss->status == 'Avance' ? 'selected' : '' }}>Avance</option>
            <option value="Réglé" {{ $caiss->status == 'Réglé' ? 'selected' : '' }}>Réglé</option>
            <option value="Non Réglé" {{ $caiss->status == 'Non Réglé' ? 'selected' : '' }}>Non Réglé</option>
        </select>
        <br>
        <label for="client_id">Client:</label>
        <select name="client_id" id="client_id" required>
            @foreach ($clients as $client)
                <option value="{{ $client->id }}" {{ $client->id == $caiss->client_id ? 'selected' : '' }}>
                    {{ $client->nom }} {{ $client->prenom }}
                </option>
            @endforeach
        </select>
        <br>
        <label for="paiement">Paiement:</label>
        <input type="number" name="paiement" id="paiement" value="{{ $caiss->paiement }}" step="0.01" required>
        <br>
        <button type="submit">Modifier</button>
    </form>
    <a href="{{ route('caisses.index') }}"><i class="fa-solid fa-arrow-left"></i></a>
</body>
</html>
