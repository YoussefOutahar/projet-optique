<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Vente</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }
        .container {
            margin-top: 50px;
            max-width: 700px;
            background-color: #ffffff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        h1 {
            text-align: center;
            margin-bottom: 30px;
            font-size: 24px;
            color: #333333;
        }
        label {
            font-weight: bold;
            color: #555555;
        }
        .form-control, .form-select {
            margin-bottom: 15px;
        }
        .btn-primary, .btn-secondary {
            padding: 10px;
            font-size: 16px;
            width: 100%;
        }
        .btn-container {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }
        .back-link {
            display: block;
            text-align: center;
            margin-top: 5px;
            color: #34269d;
            text-decoration: none;
        }
        .back-link i {
            margin-right: 8px;
        }
        .back-link:hover {
            text-decoration: underline;
            color: #007bff;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="d-flex justify-content-between mb-4">
        <h1>Modifier Vente</h1>
        <a href="{{ route('ventes.index') }}" class="back-link" style="text-align: center; font-weight: bold;">
            <i class="fa-solid fa-arrow-left"></i> Retour
        </a>
    </div>
    <form action="{{ route('ventes.update', $vente->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="row">
            <div class="col-md-6">
                <label for="numero_vente" class="form-label">N° Vente:</label>
                <input type="text" name="numero_vente" id="numero_vente" class="form-control" value="{{ $vente->numero_vente }}" readonly>
            </div>            
            <div class="col-md-6">
                <label for="date_facture" class="form-label">Date de Vente:</label>
                @php
                    $dateFacture = $vente->date_facture instanceof \Carbon\Carbon ? $vente->date_facture->format('Y-m-d') : $vente->date_facture;
                @endphp
                <input type="date" name="date_facture" id="date_facture" class="form-control" value="{{ $dateFacture }}" required>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <label for="client_id" class="form-label">Client:</label>
                <select name="client_id" id="client_id" class="form-select" required>
                    @foreach ($clients as $client)
                        <option value="{{ $client->id }}" {{ $vente->client_id == $client->id ? 'selected' : '' }}>
                            {{ $client->nom }} {{ $client->prenom }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6">
                <label for="status" class="form-label">Status:</label>
                <select name="status" id="status" class="form-select" required>
                    <option value="Réglé" {{ $vente->status == 'Réglé' ? 'selected' : '' }}>Réglé</option>
                    <option value="Non Réglé" {{ $vente->status == 'Non Réglé' ? 'selected' : '' }}>Non Réglé</option>
                </select>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <label for="total" class="form-label">Total:</label>
                <input type="number" name="total" id="total" class="form-control" value="{{ $vente->total }}" required>
            </div>
            <div class="col-md-6">
                <label for="remise" class="form-label">Remise:</label>
                <input type="number" name="remise" id="remise" class="form-control" value="{{ $vente->remise }}" required>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <label for="avance" class="form-label">Avance:</label>
                <input type="number" name="avance" id="avance" class="form-control" value="{{ $vente->avance }}" required>
            </div>
            <div class="col-md-6">
                <label for="reste_a_payer" class="form-label">Reste à Payer:</label>
                <input type="number" name="reste_a_payer" id="reste_a_payer" class="form-control" value="{{ $vente->reste_a_payer }}" required readonly>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <label for="responsable" class="form-label">Responsable:</label>
                <input type="text" name="responsable" id="responsable" class="form-control" value="{{ $vente->responsable }}" required>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-6 text-center">
                <button type="submit" class="btn btn-primary btn-sm" style="padding: 10px 20px; font-size: 14px; border-radius: 20px;">
                    <i class="fa-solid fa-check"></i> Mettre à Jour
                </button>
            </div>
            <div class="col-md-6 text-center">
                <a href="{{ route('ventes.editCategorieReference', $vente->id) }}" class="btn btn-secondary btn-sm" style="padding: 10px 20px; font-size: 14px; border-radius: 20px;">
                    <i class="fa-solid fa-edit"></i> Modifier Référence/Catégorie
                </a>
            </div>
        </div>        
    </form>
</div>

<script>
    function calculateResteAPayer() {
        const total = parseFloat(document.getElementById('total').value) || 0;
        const remise = parseFloat(document.getElementById('remise').value) || 0;
        const avance = parseFloat(document.getElementById('avance').value) || 0;
        const resteAPayer = total - remise - avance;
        document.getElementById('reste_a_payer').value = resteAPayer.toFixed(2);
    }

    document.getElementById('total').addEventListener('input', calculateResteAPayer);
    document.getElementById('remise').addEventListener('input', calculateResteAPayer);
    document.getElementById('avance').addEventListener('input', calculateResteAPayer);
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>
